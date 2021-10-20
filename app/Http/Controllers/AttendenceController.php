<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Attendence;

class AttendenceController extends Controller
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

    public function TakeAttendence()
    {
        $employee=DB::table('employees')->get();
        return view('take_attendence', compact('employee'));
    }

    public function InsertAttendence(Request $request)
    {
        /*return $request->all();*/

        $date=$request->att_date;
        $att_date=DB::table('attendences')->where('att_date', $date)->first();
        if ($att_date) {
            $notification=array(
                    'message'=>'Today Attendence Already Taken',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
        } else {
            foreach ($request->user_id as $id) {
           $data[]=[
                "user_id"=>$id,
                "attendence"=>$request->attendence[$id],
                "att_date"=>$request->att_date,
                "att_year"=>$request->att_year,
                "month"=>$request->month,
                "edit_date"=>date("d_m_y")
           ];
       }

       $att=DB::table('attendences')->insert($data);

       if ($att) {
                $notification=array(
                    'message'=>'Successfuly Attendence Inserted',
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

    public function AllAttendence()
    {
        $all_att=DB::table('attendences')->select('edit_date')->groupBy('edit_date')->get();
        return view('all_attendence', compact('all_att'));
    }


    public function EditAttendence($edit_date)
    {
        /*return $edit_date;*/

        $date=DB::table('attendences')->where('edit_date', $edit_date)->first();

        $data=DB::table('attendences')
                ->join('employees','attendences.user_id','employees.id')
                ->select('employees.name','employees.photo','attendences.*')
                ->where('edit_date', $edit_date)
                ->get();
        return view('edit_attendence', compact('data','date'));

       /*echo "<pre>";
        print_r($data);
        exit();*/
    }


    public function UpdateAttedence(Request $request)
    {
        foreach ($request->id as $id) {
           $data=[
                "attendence"=>$request->attendence[$id],
                "att_date"=>$request->att_date,
                "att_year"=>$request->att_year,
                "month"=>$request->month
           ];

           $attendence= Attendence::where(['att_date' =>$request->att_date, 'id'=>$id])->first();
       $attendence->update($data);

           
       }
  

       if ($attendence) {
                $notification=array(
                    'message'=>'Successfuly Updated Inserted',
                    'alert-type'=>'success'
                );

                return Redirect()->route('all.attendence')->with($notification);
            }else{
                $notification=array(
                    'message'=>'error',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
    }


    public function ViewAttedence($edit_date)
    {
        $date=DB::table('attendences')->where('edit_date', $edit_date)->first();

        $data=DB::table('attendences')
                ->join('employees','attendences.user_id','employees.id')
                ->select('employees.name','employees.photo','attendences.*')
                ->where('edit_date', $edit_date)
                ->get();
        return view('view_attendence', compact('data','date'));
    }




    public function Setting()
    {
        

        $setting=DB::table('settings')->first();
        return view('setting',compact('setting'));

        /*echo "<pre>";
        print_r($setting);
        exit();*/
    }


    public function UpdateWebsite(Request $request, $id)
    {
        $validatedData = $request->validate([
        'company_name' => 'required|max:255',
        'company_address' => 'required|max:255',
        'company_email' => 'required|unique:settings|max:255',
        'company_phone' => 'required',
        'company_city' => 'required',
        'company_country' => 'required',
        'company_mobile' => 'required',
   
    ]);


        $data=array();
        
        $data['company_name']=$request->company_name;
        $data['company_address']=$request->company_address;
        $data['company_email']=$request->company_email;
        $data['company_phone']=$request->company_phone;
        $data['company_mobile']=$request->company_mobile;
        $data['company_city']=$request->company_city;
        $data['company_country']=$request->company_country;
        $data['company_zipcode']=$request->company_zipcode;

        $image=$request->company_logo;
        if ($image) {
            $image_name= str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path="public/company/";
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if ($success) {
                $data['company_logo']=$image_url;
                $img=DB::table('settings')->where('id',$id)->first();
                $image_path= $img->company_logo;
                $done=unlink($image_path);
            $company=DB::table('settings')->where('id',$id)->update($data);
                if ($company) {
                    $notification=array(
                        'message'=>'Information Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->back()->with($notification);
                }else{

                    return Redirect()->back();
                }
            }

            }else{

                $oldphoto=$request->old_photo;
                if ($oldphoto) {
                $data['company_logo']=$oldphoto;
                
            $comp=DB::table('settings')->where('id',$id)->update($data);
                if ($comp) {
                    $notification=array(
                        'message'=>'Information Update Successfuly...!',
                        'alert-type'=>'success'
                    );

                    return Redirect()->back()->with($notification);
                }else{

                    return Redirect()->back();
                }
            }
        }
    }
}
