<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
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

    public function index()
    {
        return view('add_supplier');
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:suppliers|max:255',
        'phone' => 'required|unique:suppliers|max:13',
        'address' => 'required',
        'type' => 'required',
        'shop' => 'required',
        'photo' => 'required',
        
        
    ]);



        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['type']=$request->type;
        $data['shop']=$request->shop;
        $data['accountholder']=$request->accountholder;
        $data['accountnumber']=$request->accountnumber;
        $data['bankname']=$request->bankname;
        $data['branchname']=$request->branchname;
        $data['city']=$request->city;

        
        

        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/supplier/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $supplier=DB::table('suppliers')->insert($data);

                if ($supplier) {
                    $notification=array(
                        'message'=>'Successfuly supplier inserted',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('add.supplier')->with($notification);
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


        /*echo "<pre>";
        print_r($data);
        exit();*/
    }

    public function AllSupplier()
    {
        $supplier=DB::table('suppliers')->get();
        return view('all_supplier', compact('supplier'));
    }

    public function ViewSupplier($id)
    {
        $single=DB::table('suppliers')
                    ->where('id', $id)
                    ->first();
        return view('view_supplier')->with('single',$single);
    }  


    public function DeleteSupplier($id)
    {
        $delete=DB::table('suppliers')
                ->where('id',$id)
                ->first();

        $photo=$delete->photo;

       /* print_r($photo);*/

       unlink($photo);
       $dltuser=DB::table('suppliers')
                ->where('id',$id)
                ->delete();

        if ($dltuser) {
                    $notification=array(
                        'message'=>'Successfuly supplier Deleted!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.supplier')->with($notification);
                }else{
                    $notification=array(
                        'message'=>'Error',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
                }
    }

    public function EditSupplier($id)
    {
        $edit=DB::table('suppliers')
                ->where('id', $id)
                ->first();
        return view('edit_supplier',compact('edit'));
    }

    public function UpdateSupplier(Request $request, $id)
    {
        

        $data=array();
        
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['type']=$request->type;
        $data['shop']=$request->shop;
        $data['accountholder']=$request->accountholder;
        $data['accountnumber']=$request->accountnumber;
        $data['bankname']=$request->bankname;
        $data['branchname']=$request->branchname;
        $data['city']=$request->city;

        $image=$request->photo;
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/supplier/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('suppliers')->where('id',$id)->first();
                $image_path= $img->photo;
                $done=unlink($image_path);
            $user=DB::table('suppliers')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.supplier')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }

            }else{

                $oldphoto=$request->old_photo;
                if ($oldphoto) {
                $data['photo']=$oldphoto;
                
            $user=DB::table('suppliers')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.supplier')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }
            }

    }
}
