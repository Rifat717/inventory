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
		                <li class="active">Dashboard</li>
		            </ol>
		        </div>
		    </div>

		    <!-- Start Widget -->
				    <div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-8">
				            <div class="panel panel-default">
				                <div class="panel-heading"><h3 class="panel-title">Customer Details</h3></div>
				                <div class="panel-body">

				                    
				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Name</label>
				                            <p>{{ $single->name }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Email</label>
				                            <p>{{ $single->email }}</p>
				                        </div>
				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Phone</label>
				                            <p>{{ $single->phone }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Address</label>
				                            <p>{{ $single->address }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Shop Name</label>
				                            @if($single->shopname == NULL)
				                            NONE
				                            @else
				                            <p>{{ $single->shopname }}</p>
				                            @endif
				                               
				                        </div>				                        

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Holder</label>
				                            <p>{{ $single->account_holder }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Number</label>
				                            <p>{{ $single->account_number }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Bank Name</label>
				                            <p>{{ $single->bank_name }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Bank Branch</label>
				                            <p>{{ $single->bank_branch }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">City</label>
				                            <p>{{ $single->city }}</p>
				                        </div>

				                        <div class="form-group">
				                        	<label for="exampleInputPassword1">Photo</label>
				                        	<img src="{{asset($single->photo)}}" style="height: 80px; width:80px;">
				                        </div>
				                        
				                        
				                    
				                </div><!-- panel-body -->
				            </div> <!-- panel -->
				        </div> <!-- col-->

				</div> <!-- container -->
		           
		</div> <!-- content -->
	</div>

</div>




@endsection