<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;

class EmployeeController extends Controller
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
        return view('add_employee');
    }


//Insert Employees..................................
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:employees|max:255',
        'nid_no' => 'required|unique:employees|max:255',
        'address' => 'required',
        'phone' => 'required|max:13',
        'photo' => 'required',
        'salary' => 'required',
        
        
    ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['nid_no']=$request->nid_no;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;

        /*echo"<pre>";
        print_r($data);
        exit();*/

        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/employee/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $employee=DB::table('employees')->insert($data);

                if ($employee) {
                    $notification=array(
                        'message'=>'Successfuly employee inserted',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('home')->with($notification);
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

        /*echo"<pre>";
        print_r($image);
        exit();*/

    }

//All Employees....................
    public function AllEmployees()
    {

        $employees=Employee::all();
        return view ('all_employee',compact('employees')); //Return page name with table name
    }
//View a single Employee.....................................
    public function ViewEmployees($id)
    {
        $single=DB::table('employees')
                ->where('id',$id)
                ->first();

        /*echo"<pre>";
        print_r($single);
        exit();*/
            
        return view('view_employee', compact('single'));
    }

//Delete a single Employee.....................................
    public function DeleteEmployees($id)
    {
        $delete=DB::table('employees')
                ->where('id',$id)
                ->first();

        $photo=$delete->photo;

       /* print_r($photo);*/

       unlink($photo);
       $dltuser=DB::table('employees')
                ->where('id',$id)
                ->delete();

        if ($dltuser) {
                    $notification=array(
                        'message'=>'Successfuly employee Deleted!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.employee')->with($notification);
                }else{
                    $notification=array(
                        'message'=>'Error',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }

    }

    public function EditEmployees($id)
    {
        $edit=Db::table('employees')
                ->where('id',$id)
                ->first();
        return view ('edit_employee', compact('edit'));
    }

    //update employee............

    public function UpdateEmployee(Request $request, $id)
    {
        

        $data=array();
        
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['nid_no']=$request->nid_no;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;

        $image=$request->photo;
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/employee/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('employees')->where('id',$id)->first();
                $image_path= $img->photo;
                $done=unlink($image_path);
            $user=DB::table('employees')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Employee Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.employee')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }

            }else{

                $oldphoto=$request->old_photo;
                if ($oldphoto) {
                $data['photo']=$oldphoto;
                
            $user=DB::table('employees')->where('id',$id)->update($data);
                if ($user) {
                    $notification=array(
                        'message'=>'Customer Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->route('all.employee')->with($notification);
                }else{

                    return Redirect()->back();
                }
            }
        }
      
   }

    

}

