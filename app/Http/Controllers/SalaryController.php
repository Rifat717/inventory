<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
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

    public function AddAdvancedSalary()
    {
        return view('advanced_salary');
    }

    public function AllSalary()
    {
        $salary=DB::table('advance_salaries')
                    ->join('employees','advance_salaries.emp_id','employees.id')
                    ->select('advance_salaries.*', 'employees.name','employees.salary','employees.photo')
                    ->orderBy('id','DESC')
                    ->get();

        /*echo "<pre>";
        print_r($salary);
        exit();*/
       return view('all_advanced_salary', compact('salary'));
    }

    public function InsertAdvanced(Request $request)
    {

        $month=$request->month;
        $emp_id=$request->emp_id;

        $advance=DB::table('advance_salaries')
                ->where('month', $month)
                ->where('emp_id',$emp_id)
                ->first();

              /*  echo "<pre>";
                print_r($advance);
                exit();*/

        if ($advance ===NULL) {
             $data=array();
        $data['emp_id']=$request->emp_id;
        $data['month']=$request->month;
        $data['advanced_salary']=$request->advanced_salary;
        $data['year']=$request->year;

        $advance=DB::table('advance_salaries')->insert($data);
        if ($advance) {
                    $notification=array(
                        'message'=>'Successfuly Adavanced Paid',
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
            $notification=array(
                        'message'=>'Ooops ! Already Adavance Paid In This Month',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
        }

       
    }


    public function PaySalary()
    {
        

        $employee=DB::table('employees')->get();            
        return view('pay_salary',compact('employee'));
    }
}
