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
				                <div class="panel-heading"><h3 class="panel-title">Settings</h3></div>

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

				                    <form role="form" action="{{ url('/update-website/'.$setting->id) }}" method="post" enctype="multipart/form-data">
				                    	@csrf
				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Company Name</label>
				                            <input type="text" name="company_name" class="form-control"  value="{{ $setting->company_name }}" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Company Address</label>
				                            <input type="text" class="form-control" name="company_address"  value="{{ $setting->company_address }}" required>
				                        </div>
				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company Email</label>
				                            <input type="email" name="company_email" class="form-control"  value="{{ $setting->company_email }}" >
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company Phone</label>
				                            <input type="text" name="company_phone" class="form-control"  value="{{ $setting->company_phone }}" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company Mobile</label>
				                            <input type="text" name="company_mobile" class="form-control"  value="{{ $setting->company_mobile }}" required>
				                        </div>

				                        

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company City</label>
				                            <input type="text" name="company_city" class="form-control" id="exampleInputPassword1" value="{{ $setting->company_city }}" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company Country</label>
				                            <input type="text" name="company_country" class="form-control"  value="{{ $setting->company_country }}" required>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputPassword1">Company Zipcode</label>
				                            <input type="text" name="company_zipcode" class="form-control"  value="{{ $setting->company_zipcode }}" required>
				                        </div>

				                        

				                        <div class="form-group">
				                        	<img id="image" src="#">
				                            <label for="exampleInputPassword1">New Photo</label>
				                            <input type="file" name="company_logo" accept="image/*" class="upload" onchange="readURL(this);">
				                        </div>

				                        <div class="form-group">
				                        	<img src="{{URL::to ($setting->company_logo) }}" style="height: 60px; width:60px;" name="old_photo">
				                        	<input type="hidden" name="old_photo" value="{{ $setting->company_logo }}">
				                        	
				                        </div>
				                        
				                        <button type="submit" class="btn btn-purple waves-effect waves-light">Update</button>
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