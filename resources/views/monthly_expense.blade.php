@extends('layouts.app')
@section('content')
 <div class="content-page">
<div class="content">
	<div class="container">

		    <!-- Page-Title -->
		    <div class="row">
		        <div class="col-sm-12">
		            <h4 class="pull-left page-title">Welcome ! {{ date("Y") }}</h4>
		            <ol class="breadcrumb pull-right">
		                <li><a href="#">Inventory</a></li>
		                <li class="active">Monthly Expense</li>
		            </ol>
		        </div>
		    </div>

            <div>
                <a href="{{ route('january.expense') }}" class="btn btn-sm btn-info">January</a>
                <a href="{{ route('february.expense') }}" class="btn btn-sm btn-danger">February</a>
                <a href="{{ route('march.expense') }}" class="btn btn-sm btn-primary">March</a>
                <a href="{{ route('april.expense') }}" class="btn btn-sm btn-success">April</a>
                <a href="{{ route('may.expense') }}" class="btn btn-sm btn-warning">May</a>
                <a href="{{ route('june.expense') }}" class="btn btn-sm btn-info">Jun</a>
                <a href="{{ route('july.expense') }}" class="btn btn-sm btn-danger">July</a>
                <a href="{{ route('august.expense') }}" class="btn btn-sm btn-primary">August</a>
                <a href="{{ route('september.expense') }}" class="btn btn-sm btn-success">September</a>
                <a href="{{ route('octobar.expense') }}" class="btn btn-sm btn-warning">October</a>
                <a href="{{ route('november.expense') }}" class="btn btn-sm btn-info">November</a>
                <a href="{{ route('december.expense') }}" class="btn btn-sm btn-danger">December</a>
            </div>

		    

		    <!-- Start Widget -->
				   
                        <div class="row">
                            <div class="col-md-12">
                            	
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-danger">{{ date("F") }}  Month Expense
                                        	
                                    	</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Details</th>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                    	@foreach($expense as $row)
                                                            <tr>
                                                                
                                                                <td>{{ $row->details }}</td>
                                                                <td>{{ $row->date }}</td>
                                                                <td>{{ $row->amount }}</td>
 
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @php
											    	$month= date("F");
											    	$total=DB::table('expenses')->where('month', $month)->sum('amount');
											    	
											    @endphp

											    <h4 align="center">Total : {{ $total }} Taka </h4>
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