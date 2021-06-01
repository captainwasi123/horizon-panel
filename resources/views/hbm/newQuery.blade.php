@extends('support.master')
@section('title', 'Add Query | HBM')
@section('content')
	
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
            	<br>
            </nav>	
            <!-- /Breadcrumb -->

           <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="icon-user-follow"></i></span>Add Query | HBM</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                    		 @if ($errors->any())
                                    		 	<div class="col-md-12">
                                    		 		<div class="alert alert-danger">
														<ul class="error_list">
														     @foreach ($errors->all() as $error)
														         <li>{{$error}}</li>
														     @endforeach
														 </ul>
													 </div>
												 </div>
											 @endif
	                                    	<div class="col-md-2">
	                                    		&nbsp;
	                                    	</div>
	                                        <div class="col-md-8">
		                                    	<form method="post" action="{{ route('hbm.queries.insert') }}">
		                                    		{{ csrf_field() }}
		                                        	<div class="row">
			                                        	<div class="col-md-8">
				                                        	<span class="label_span">Full Name *</span>
				                                            <input type="text" class="form-control form-control-sm" name="name" required>
			                                        	</div>
			                                        	<div class="col-md-4">
				                                        	<span class="label_span">Phone *</span>
				                                            <input type="text" placeholder="" id="phone" class="form-control form-control-sm" name="phone" required>
			                                        	</div>
		                                        	</div>
		                                        	<br>
		                                        	<div class="row">
			                                        	<div class="col-md-12">
				                                        	<span class="label_span">Address</span>
				                                            <input type="text" class="form-control form-control-sm" name="address">
			                                        	</div>
			                                        </div> 
		                                        	<div class="row">
		                                        		<hr>
		                                        	</div>
		                                        	<div class="row">
			                                        	<div class="col-md-12">
				                                        	<span class="label_span">Requirments *</span>
				                                            <textarea placeholder="" name="remarks" autocomplete="false"  class="form-control form-control-sm" rows="5" required></textarea>
			                                        	</div>
			                                        </div>
		                                        	<br>
			                                        <div class="row">
			                                        	<div class="col-md-8">
			                                        		&nbsp;
			                                        	</div>
			                                        	<div class="col-md-4 right_side">
			                                        		<button type="submit" class="btn btn-primary">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
			                                        		<a href="javascript:history.back()" class="btn btn-default">Cancel</a>
			                                        	</div>
			                                        </div>
		                                    	</form>
	                                        </div>
	                                    	<div class="col-md-2">
	                                    		&nbsp;
	                                    	</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
@endsection

@section('addScript')
	<script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
	<script type="text/javascript">
		var autoPopulateNo = "\\92"
		$("#phone").inputmask({
			"mask": autoPopulateNo + "9999999999",
			clearMaskOnLostFocus: false,
		});
	</script>
    @if (session()->has('success'))
        <script type="text/javascript">
            $.toast({
                text: "<i class='jq-toast-icon glyphicon glyphicon-ok'></i></i><p><strong>Success.! </strong> &nbsp;{{session()->get('success')}}</p>",
                position: 'top-center',
                loaderBg:'#7a5449',
                class: 'jq-has-icon jq-toast-success',
                hideAfter: 3500, 
                stack: 6,
                showHideTransition: 'fade'
            });
        </script>
    @endif
@endsection