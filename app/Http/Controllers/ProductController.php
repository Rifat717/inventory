<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
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

    public function AddProduct()
    {
        return view('add_product');
    }

    public function InsertCategory(Request $request)
    {
        $validatedData = $request->validate([
        'product_name' => 'required|max:255',
        'cat_id' => 'required|max:255',
        'sup_id' => 'required|max:13',
        'buy_date' => 'required',
        'expire_date' => 'required',
        'buying_price' => 'required',
        'selling_price' => 'required',
        
        
    ]);

        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;


    /*    echo "<pre>";
        print_r($data);
        exit();*/

        $image=$request->file('product_image');
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/product/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['product_image']=$image_url;
                $product=DB::table('products')->insert($data);

                if ($product) {
                    $notification=array(
                        'message'=>'Successfuly product inserted',
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
    }

    public function AllProduct()
    {
        $product=DB::table('products')->get();

        return view('all_product',compact('product'));
    }

    public function DeleteProduct($id)
    {
        $delete=DB::table('products')
                ->where('id',$id)
                ->first();

        $photo=$delete->product_image;

       /* print_r($photo);*/

       unlink($photo);
       $dltproduct=DB::table('products')
                ->where('id',$id)
                ->delete();

        if ($dltproduct) {
                    $notification=array(
                        'message'=>'Successfuly Product Deleted!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.product')->with($notification);
                }else{
                    $notification=array(
                        'message'=>'Error',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
                }

    }


    public function ViewProduct($id)
    {
        $prod=DB::table('products')
                ->join('categories','products.cat_id','categories.id')
                ->join('suppliers','products.sup_id','suppliers.id')
                ->select('categories.cate_name','products.*','suppliers.name')
                ->where('products.id', $id)
                ->first();
        return view('view_product',compact('prod'));

        /*echo "<pre>";
        print_r($prod);
        exit();*/
    }

    public function EditProduct($id)
    {
        $edit=DB::table('products')
            ->where('id',$id)
            ->first();
        return view('edit_product',compact('edit'));
    }

    public function UpdateProduct(Request $request, $id)
    {
        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;

        $image=$request->product_image;
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/product/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['product_image']=$image_url;
                $img=DB::table('products')->where('id',$id)->first();
                $image_path= $img->product_image;
                $done=unlink($image_path);
            $product=DB::table('products')->where('id',$id)->update($data);
                if ($product) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.product')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }

            }else{

                $oldphoto=$request->old_photo;
                if ($oldphoto) {
                $data['product_image']=$oldphoto;
                
            $product=DB::table('products')->where('id',$id)->update($data);
                if ($product) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.product')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }
        }
    }

// Products Import and Export Function...................................

    public function ImportProduct()
    {
        return view('import_product');
    }

    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $import=Excel::import(new ProductsImport, $request->file('import_file'));
        if ($import) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.product')->with($notification);
                }else{

                    return Redirect()->back();
                }
        
    }


}
