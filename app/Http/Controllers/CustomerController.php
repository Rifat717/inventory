<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Customer;

class CustomerController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('add_cutomer');
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 //Inssert Customer....................................   
    public function store(Request $request)
    {

        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:customers|max:255',
        'phone' => 'required|unique:customers|max:13',
        'address' => 'required',
        'photo' => 'required',
        'city' => 'required',
        
        
    ]);



        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shopname']=$request->shopname;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['bank_branch']=$request->bank_branch;
        $data['city']=$request->city;
        

        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/customer/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $customer=DB::table('customers')->insert($data);

                if ($customer) {
                    $notification=array(
                        'message'=>'Successfuly customer inserted',
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

            }else{
                return Redirect()->back();
            }

                
        }else{
            return Redirect()->back();
        }

       /* echo "<pre>";
        print_r($data);
        exit();*/


    }
//View All Customer....................................
    public function AllCustomer()
    {
        $customer=DB::table('customers')->get();
        return view('all_customer')->with('customer',$customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//View Single Customer......................................    
    public function ViewCustomer($id)
    {
        $single=Db::table('customers')
                ->where('id', $id)
                ->first();
        return view('view_customer')->with('single',$single);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//Edit Customer.................................................    
    public function EditCustomer($id)
    {
        $edit=DB::table('customers')
                ->where('id', $id)
                ->first();
        return view ('edit_customer',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//Update Customer...............................................
    public function UpdateCustomer(Request $request, $id)
    {
        

        $data=array();
        
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shopname']=$request->shopname;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['bank_branch']=$request->bank_branch;
        $data['city']=$request->city;

        $image=$request->photo;
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/customer/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('customers')->where('id',$id)->first();
                $image_path= $img->photo;
                $done=unlink($image_path);
            $user=DB::table('customers')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.customer')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }

            }else{

                $oldphoto=$request->old_photo;
                if ($oldphoto) {
                $data['photo']=$oldphoto;
                
            $user=DB::table('customers')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.customer')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//Delete Customer..............................................    
    public function DeleteCustomer($id)
    {
        $delete=DB::table('customers')
                ->where('id',$id)
                ->first();

        $photo=$delete->photo;

       /* print_r($photo);*/

       unlink($photo);
       $dltuser=DB::table('customers')
                ->where('id',$id)
                ->delete();

        if ($dltuser) {
                    $notification=array(
                        'message'=>'Successfuly customer Deleted!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.customer')->with($notification);
                }else{
                    $notification=array(
                        'message'=>'Error',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
                }
    }
}
