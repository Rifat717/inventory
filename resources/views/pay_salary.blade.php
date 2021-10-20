@extends('layouts.app')
@section('content')
 <div class="content-page">
<div class="content">
	<div class="container">

		    <!-- Page-Title -->
		    <div class="row">
		        <div class="col-sm-12">
		            <h4 class="pull-left page-title">Welcome !</h4>
		            <ol class="breadcrumb pull-right">
		                <li><a href="#">Inventory</a></li>
		                <li class="active">All Employee</li>
		            </ol>
		        </div>
		    </div>
{{-- <h3>{{ date(DATE_RFC822) }}</h3> --}}
<h3>{{ date("F j, Y, g:i a") }}</h3>
		    <!-- Start Widget -->
				   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">All Salary <span class="pull-right text-danger" >{{ date("F Y") }}</span></h3>

                                       
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Photo</th>
                                                            <th>Salary</th>
                                                            <th>Month</th>
                                                            <th>Advance</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                           {{-- Employee Advance salary show --}}         
                                        @php

                                            $month=date("F", strtotime('-1 month'));
								             $salary=DB::table('advance_salaries')
								                    ->join('employees','advance_salaries.emp_id','employees.id')
								                    ->select('advance_salaries.*', 'employees.name','employees.salary','employees.photo')
								                    ->where('month',$month)
								                    ->get();

                                        @endphp

                                             {{-- End php Code --}}
                                             
                                                    <tbody>
                                                    	@foreach($employee as $row)
                                                            <tr>
                                                                {{-- <td>{{ $row->emp_id }}</td>
                                                                
                                                                <td>{{ $row->year }}</td> --}}
                                                                
                                                                <td>{{ $row->name }}</td>
                                                                <td><img src="{{ $row->photo }}" style="height: 60px; width:60px;"></td>
                                                                <td>{{ $row->salary }}</td>
                                                                <td><span class="
                                                                	badge badge-success">{{ date("F", strtotime('-1 month')) }}</span></td>
                                                                <td></td>

                                                                <td>
                                                                	

                                                                    <a class="btn btn-sm btn-primary">Pay Now</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> <!-- End Row -->
				    	

				</div> <!-- container -->
		           
		</div> <!-- content -->
	</div>

</div>




@endsection