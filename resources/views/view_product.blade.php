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
				                <div class="panel-heading">
				                	<h3 class="panel-title">Add Product</h3>
				                	
				                </div>

				                

				                <div class="panel-body">

				                	{{-- <div>
				                        	<label for="exampleInputPassword1">Image</label>
				                        	<img src="{{URL::to ($prod->product_image) }}" style="height: 60px; width:60px;" >
				                        	 
				                        </div> --}}

				                    <img src="{{ URL::to($prod->product_image) }}">

				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Product Name</label>
				                            <p>{{ $prod->product_name }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Prodcut Code</label>
				                            <p>{{ $prod->product_code }}</p>
				                        </div>
				                        

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Category</label>
				                            <p>{{ $prod->cate_name }}</p>
				                            
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Supplier's Name</label>
				                            <p>{{ $prod->name }}</p>

				                        </div>

				                       

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Product Garage</label>
				                            <p>{{ $prod->product_garage }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Product Route</label>
				                            <p>{{ $prod->product_route }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Buy Date</label>
				                            <p>{{ $prod->buy_date }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Expire Date</label>
				                            <p>{{ $prod->expire_date }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Buying Price</label>
				                            <p>{{ $prod->buying_price }}</p>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Selling Price</label>
				                            <p>{{ $prod->selling_price }}</p>
				                        </div>

				                        
				                        
				                        
				                </div><!-- panel-body -->
				            </div> <!-- panel -->
				        </div> <!-- col-->

				</div> <!-- container -->
		           
		</div> <!-- content -->
	</div>

</div>

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#image')
						.attr('src', e.target.result)
						.width(80)
						.height(80);
			};
			reader.readAsDataURL(input.files[0]); 
		}
	}
</script>


@endsection