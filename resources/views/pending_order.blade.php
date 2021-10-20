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

		    <!-- Start Widget -->
				   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">All Pendign Order</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Order Date</th>
                                                            <th>Total Product</th>
                                                            <th>Total Amount</th>
                                                            <th>Due Payment Date</th>
                                                            <th>Payment Status</th>
                                                            <th>Order Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                    	@foreach($pending as $row)
                                                            <tr>
                                                                <td>{{ $row->name }}</td>
                                                                <td>{{ $row->ordre_date }}</td>
                                                                <td>{{ $row->total_products }}</td>
                                                                <td>{{ $row->total }}</td>
                                                                <td>{{ $row->due_date }}</td>
                                                                <td>{{ $row->payment_status }}</td>
                                                                <td><span class="badge badge-danger">{{ $row->order_status }}</span></td>
                                                               
                                                                <td>
                                                                	

                                                                    <a href="{{ URL::to('view-order-status/'.$row->id) }}" class="btn btn-sm btn-primary">View</a>
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