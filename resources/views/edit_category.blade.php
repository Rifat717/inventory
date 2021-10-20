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
				            <div class="panel panel-info">
				                <div class="panel-heading"><h3 class="panel-title text-white"> Edit Category</h3>
				                	
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

				                    <form role="form" action="{{ url('/update-category/'.$cat->id) }}" method="post" >
				                    	@csrf

     
				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Category Name</label>
				                            <input type="text" class="form-control" name="cate_name"  value="{{ $cat->cate_name }}" required>
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


@endsection