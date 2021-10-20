<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
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

    
    public function AddCategory()
    {
        return view('add_category');
    }

    public function InsertCategory(Request $request)
    {
        $data=array();
        $data['cate_name']=$request->cate_name;
        $cat=DB::table('categories')->insert($data);

        if ($cat) {
                    $notification=array(
                        'message'=>'Successfuly Category Inserted',
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

    public function AllCategory()
    {
        $category=DB::table('categories')->get();
        return view('all_category', compact('category'));
    }

    public function DeleteCategory($id)
    {
        $dlt=DB::table('categories')
            ->where('id', $id)
            ->delete();

        if ($dlt) {
                    $notification=array(
                        'message'=>'Successfuly Category Deleted',
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

    public function EditCategory($id)
    {
        $cat=DB::table('categories')
            ->where('id', $id)
            ->first();

        return view('edit_category')->with('cat', $cat);
    }

    public function UpdateCategory(Request $request, $id)
    {
        $data=array();
        $data['cate_name']=$request->cate_name;
        $cat_update=DB::table('categories')
            ->where('id', $id)
            ->update($data);

        if ($cat_update) {
                    $notification=array(
                        'message'=>'Successfuly Category Updated',
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
}
