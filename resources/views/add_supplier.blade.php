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
				                	<h3 class="panel-title">Add Supplier</h3>
				                	
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

				                <div class="panel-body">

				                    <form role="form" action="{{ url('/insert-supplier') }}" method="post" enctype="multipart/form-data">
				                    	@csrf
				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Name</label>
				                            <input type="text" name="name" class="form-control"  placeholder="Supplier Name" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Email</label>
				                            <input type="email" class="form-control" name="email"  placeholder="Supplier Email" required>
				                        </div>
				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Phone</label>
				                            <input type="text" name="phone" class="form-control"  placeholder="Supplier Phone" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Address</label>
				                            <input type="text" name="address" class="form-control"  placeholder="Supplier Address" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Type</label>
				                            <select name="type" class="form-control">
				                            	<option disabled="" selected="">select option</option>
				                            	<option value="Distributor">Distributor</option>
				                            	<option value="WholeSeller">Whole Seller</option>
				                            	<option value="Broker">Broker</option>
				                            </select>
				                            
				                        </div>

				                       

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Shop</label>
				                            <input type="text" name="shop" class="form-control"  placeholder="Shop" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Holder</label>
				                            <input type="text" name="accountholder" class="form-control"  placeholder="Account Holder" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Number</label>
				                            <input type="text" name="accountnumber" class="form-control"  placeholder="Account Number" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Bank Name</label>
				                            <input type="text" name="bankname" class="form-control"  placeholder="Bank Name" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Branch Name</label>
				                            <input type="text" name="branchname" class="form-control"  placeholder="Branch Name" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">City</label>
				                            <input type="text" name="city" class="form-control"  placeholder="Enter City" required>
				                        </div>

				                        <div class="form-group">
				                        	<img id="image" src="#">
				                            <label for="exampleInputPassword1">Photo</label>
				                            <input type="file" name="photo" accept="image/*" class="upload" required onchange="readURL(this);">
				                        </div>
				                        
				                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
				                    </form>
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