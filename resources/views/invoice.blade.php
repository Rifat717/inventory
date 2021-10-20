@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Invoice</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">QAPL</a></li>
                                    {{-- <li><a href="#">Pages</a></li> --}}
                                    <li class="active">Invoice</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h4 class="text-right"><img src="{{URL::to ('public/admin/images/logo_dark.png') }}" alt="velonic"></h4>
                                                
                                            </div>
                                            <div class="pull-right">
                                                <h4>Invoice # <br>
                                                    <strong>{{ date('d-m-y') }}</strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <div class="pull-left m-t-30">
                                                    <address>
                                                      <strong>Name : {{ $customer->name }}</strong><br>
                                                      <strong>Shop Name : {{ $customer->shopname }}</strong><br>
                                                      Address : {{ $customer->address }}<br>
                                                      City : {{ $customer->city }}<br>
                                                      Phone: {{ $customer->phone }}<br>
                                                      Email: {{ $customer->email }}
                                                      </address>
                                                </div>
                                                <div class="pull-right m-t-30">
                                                    <p><strong>Order Date: </strong> {{ date("l jS \of F Y ") }}</p>
                                                    <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                                    {{-- @php
                                                    	$order=DB::table('orders')->first();
                                                    @endphp --}}
                                                    <p class="m-t-10"><strong>Order ID: </strong>{{-- {{ $order++ }}  --}}1</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-h-50"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-30">
                                                        <thead>
                                                            <tr><th>#</th>
                                                            <th>Item</th>
                                                            {{-- <th>Description</th> --}}
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        	@php
                                                        		$sl=1;
                                                        	@endphp
                                                        	@foreach($contents as $cont)
                                                            <tr>
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $cont->name }}</td>
                                                                {{-- <td>Lorem ipsum dolor sit amet.</td> --}}
                                                                <td>{{ $cont->qty }}</td>
                                                                <td>{{ $cont->price }}</td>
                                                                <td>{{ $cont->price*$cont->qty }}</td>
                                                                
                                                            </tr>
                                                            
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="border-radius: 0px;">
                                            <div class="col-md-3 col-md-offset-9">
                                                <p class="text-right"><b>Sub-total:</b> {{ Cart::subtotal() }}</p>
                                                {{-- <p class="text-right">Discout: 12.9%</p> --}}
                                                <p class="text-right">VAT: {{ Cart::tax() }}</p>
                                                <hr>
                                                <h3 class="text-right">Total : {{ Cart::total() }}</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="hidden-print">
                                            <div class="pull-right">
                                                <a href="#" onclick="window.print();" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="#"  class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



            </div> <!-- container -->
                               
        </div> <!-- content -->

                

    </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



                     {{--..................... Payable Modal............... --}}

<form action="{{ url('/final-invoice') }}" method="post">
	@csrf
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title text-primary">Invoice of {{ $customer->name }}
                        	<span class="pull-right">Total : {{ Cart::total() }}</span></h4> 
                    </div> 

					@if ($errors->any())
						<div class="alert alert-danger">
						    <ul>
						        @foreach ($errors->all() as $error)
						            <li>{{ $error }}</li>
						        @endforeach
						    </ul>
						</div>
					@endif

                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                 
                            </div> 
                             
                        </div> 
                        
                        <div class="row"> 
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-4" class="control-label">Payment</label> 
                                    <select class="form-control" name="payment_status">
                                    	<option value="Hand Cash">Hand Cash</option>
                                    	<option value="Checque">Checque</option>
                                    	<option value="Due">Due</option>
                                    </select> 
                                </div> 
                            </div> 
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-5" class="control-label">Pay</label> 
                                    <input type="text" class="form-control" id="field-5" placeholder="Pay" name="pay" required> 
                                </div> 
                            </div> 
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-6" class="control-label">Due</label> 
                                    <input type="text" class="form-control" id="field-6" placeholder="Due" name="due" required> 
                                </div> 
                            </div> 
                        </div>

                        <div class="row"> 
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                     <label for="field-6" class="control-label">Due Date</label> 
                                    <input type="text" class="form-control" id="field-6" placeholder="Due Date" name="due_date"> 
                                </div> 
                            </div> 
                            
                        </div> 

                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" name="ordre_date" value="{{ date('d-m-y') }}">
                        <input type="hidden" name="order_status" value="pending">
                        <input type="hidden" name="total_products" value="{{ Cart::count() }}">
                        <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
                        <input type="hidden" name="vat" value="{{ Cart::tax() }}">
                        <input type="hidden" name="total" value="{{ Cart::total() }}">
                        

                       

                        
                         
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button> 
                    </div> 
                </div> 
            </div>
   </div><!-- /.modal -->
</form>


@endsection