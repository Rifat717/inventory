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
				                <div class="panel-heading"><h3 class="panel-title text-white">Import Product
				                	<a href="{{ route('export') }}" class="pull-right btn btn-danger btn-sm">Download Xlxs</a>
				                </h3>
				                	
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

				                    <form role="form" action="{{ route('import') }}" method="post" enctype="multipart/form-data" >
				                    	@csrf

     
				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Xlxs File Import</label>
				                            <input type="file"  name="import_file" required>
				                        </div>

				                        

				                        <button type="submit" class="btn btn-purple waves-effect waves-light">Upload</button>
				                    </form>
				                </div><!-- panel-body -->
				            </div> <!-- panel -->

				            <strong class="text-danger"> Please Download excel file for Import</strong>
				        </div> <!-- col-->

				</div> <!-- container -->
		           
		</div> <!-- content -->
	</div>

</div>


@endsection