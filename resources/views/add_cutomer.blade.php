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
				                	<h3 class="panel-title">Add Customer</h3>
				                	
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

				                    <form role="form" action="{{ url('/insert-customer') }}" method="post" enctype="multipart/form-data">
				                    	@csrf
				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Name</label>
				                            <input type="text" name="name" class="form-control"  placeholder="Customer Name" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Email</label>
				                            <input type="email" class="form-control" name="email"  placeholder="Customer Email" required>
				                        </div>
				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Phone</label>
				                            <input type="text" name="phone" class="form-control"  placeholder="Customer Phone" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Address</label>
				                            <input type="text" name="address" class="form-control"  placeholder="Customer Address" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Shop Name</label>
				                            <input type="text" name="shopname" class="form-control"  placeholder="Shop Name" required>
				                        </div>

				                       

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Holder</label>
				                            <input type="text" name="account_holder" class="form-control"  placeholder="Enter Salary" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Account Number</label>
				                            <input type="text" name="account_number" class="form-control"  placeholder="Enter Vacation" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Bank Name</label>
				                            <input type="text" name="bank_name" class="form-control"  placeholder="Enter City" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Bank Branch</label>
				                            <input type="text" name="bank_branch" class="form-control"  placeholder="Enter City" required>
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