<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data=array();
        $data['id']=$request->id;
        $data['name']=$request->name;
        $data['qty']=$request->qty;
        $data['price']=$request->price;
        /*$data['product_code']=$request->product_code;*/


        /*return $data;*/


        /*echo "<pre>";
        print_r($data);
        exit();*/

        $add=Cart::add($data);
        if ($add) {
                $notification=array(
                    'message'=>'Successfuly Added',
                    'alert-type'=>'success'
                );

                return Redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'message'=>'Error',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

    }


    public function CartUpdate(Request $request, $rowId)
    {       
        $qty=$request->qty;
        $update=Cart::update($rowId, $qty);

        if ($update) {
                $notification=array(
                    'message'=>'Successfuly Updated',
                    'alert-type'=>'success'
                );

                return Redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'message'=>'Error',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

    }


    public function CartRemove($rowId)
    {
        $remove=Cart::remove($rowId);
        if ($remove) {
                $notification=array(
                    'message'=>'Successfuly Remove',
                    'alert-type'=>'success'
                );

                return Redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'message'=>'Deleted',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
    }


    public function CreateInvoice(Request $request)
    {
        $request->validate([
        'cus_id' => 'required',
        ],
        [ 
            'cus_id.required' => 'Select a Customer First !'
    ]);
        $cus_id=$request->cus_id;
        $customer=DB::table('customers')->where('id',$cus_id)->first();
        $contents=Cart::content();

        return view('invoice',compact('customer','contents'));

       /* echo "<pre>";
        print_r($contents);*/
    }


    public function FinalInvoice(Request $request)
    {

        try{

            $data=array();
            $data['customer_id']=$request->customer_id;
            $data['ordre_date']=$request->ordre_date;
            if (isset($request->due_date)) {
             $data['due_date']=$request->due_date;            
            }else{
            $data['due_date']="10-02-2020";
            }
            $data['order_status']=$request->order_status;
            $data['total_products']=$request->total_products;
            $data['sub_total']=$request->sub_total;
            $data['vat']=$request->vat;
            $data['total']=$request->total;
            $data['payment_status']=$request->payment_status;
            $data['pay']=$request->pay;
            $data['due']=$request->due;
            $data['invoice_no']=generateRandomString();


            $order_id=DB::table('orders')->insertGetId($data);
            $contents=Cart::content();

            $odata=array();

            foreach($contents as $content)
            {
                $odata['order_id']=$order_id;
                $odata['product_id']=$content->id;
                $odata['quantity']=$content->qty;
                $odata['unitcoast']=$content->price;
                $odata['total']=$content->total;


                $result=DB::table('orderdetails')->insert($odata);
            }
            if ($result) {
                $notification=array(
                    'message'=>'Successfuly Invoice Created ! Please Deliverd Prdoucts and accept status ',
                    'alert-type'=>'success'
                );
                Cart::destroy();

                return Redirect()->route('pending.orders')->with($notification);
            }else{
                $notification=array(
                    'message'=>'error exception',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
}

function generateRandomString() {
    $strFast = "SOC";
    $characters =rand(000000000,99999999);
    $randomString = $strFast.$characters;
    return $randomString;
}
