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
				                	<h3 class="panel-title">Add Expense</h3>
				                	
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

				                    <form role="form" action="{{ url('/insert-expense') }}" method="post" >
				                    	@csrf
				                    	<div class="form-group">
				                            <label for="exampleInputEmail1">Expense Details</label>
				                            <textarea class="form-control" row="4" name="details"></textarea>
				                        </div>

				                        <div class="form-group">
				                            <label for="exampleInputEmail1">Amount</label>
				                            <input type="text" class="form-control" name="amount"  placeholder="Amount" required>
				                        </div>
				                        <div class="form-group">
				                            
				                            <input type="hidden" name="date" class="form-control"   value="{{ date("d-m-y") }}" required>
				                        </div>

				                        <div class="form-group">
				                            
				                            <input type="hidden" name="month" class="form-control"   value="{{ date("F") }}" required>
				                            <input type="hidden" name="year" class="form-control"   value="{{ date("Y") }}" required>
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