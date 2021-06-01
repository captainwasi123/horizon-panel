@extends('support.master')
@section('title', 'Edit Requisition')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-plus"></i></span>Edit Requisition</h4>
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
		                                    	<form method="post" action="{{ URL::to('/construction/requisition/update')}}">
		                                    		{{ csrf_field() }}
		                                    		<input type="hidden" name="request_id" value="{{base64_encode($data->id)}}">
		                                        	<div class="row">
			                                        	<div class="col-md-12">
				                                        	<span class="label_span">Client *</span>
				                                        	<select class="form-control form-control-lg select2" name="client_id" required>
				                                        		<option value="" selected disabled>Select</option>
				                                        		@php $s = 1; @endphp
				                                        		@foreach($leads as $key => $val)
				                                        			<option value="{{$val->id}}"
				                                        				@if($val->id == $data->client_id)
				                                        					selected
				                                        				@endif
				                                        			>{{$s.' - '.$val->name}} | Plot#: {{empty($val->plot_no) ? '---' : $val->plot_no}} | Precent: {{empty($val->precent) ? '---' : $val->precent}}</option>
				                                        		    @php $s++; @endphp
				                                        		@endforeach
				                                        	</select>
			                                        	</div>
		                                        	</div>
		                                        	<br>
		                                        	<div class="row">
			                                        	<div class="col-md-6">
				                                        	<span class="label_span">Meterial *</span>
				                                        	<select class="form-control form-control-sm" name="material" required>
				                                        		<option value="" selected disabled>Select</option>
				                                        		@foreach($items as $key => $val)
				                                        			<option value="{{$val->id}}"
				                                        				@if($val->id == $data->item_id)
				                                        					selected
				                                        				@endif
				                                        			>{{$val->item}}</option>
				                                        		@endforeach
				                                        	</select>
			                                        	</div>
			                                        	<div class="col-md-3">
				                                        	<span class="label_span">Quantity *</span>
			                                        		<input type="number" name="qty" class="form-control form-control-sm" value="{{$data->quantity}}" required>
			                                        	</div>
			                                        	<div class="col-md-3">
				                                        	<span class="label_span">Unit *</span>
				                                        	<select class="form-control form-control-sm" name="unit_id" required>
				                                        		<option value="" selected disabled>Select</option>
				                                        		@foreach($units as $key => $val)
				                                        			<option value="{{$val->id}}"
				                                        				@if($val->id == $data->unit_id)
				                                        					selected
				                                        				@endif
				                                        			>{{$val->unit}}</option>
				                                        		@endforeach
				                                        	</select>
			                                        	</div>
		                                        	</div>
		                                        	<br>
		                                        	<div class="row">
			                                        	<div class="col-md-4">
				                                        	<span class="label_span">Need Date</span>
			                                        		<input type="date" name="needDate" class="form-control form-control-sm" value="{{$data->need_date}}">
				                                        	<br>
				                                        	<span class="label_span">Priority *</span>
				                                        	<select class="form-control form-control-sm" name="priority" required>
				                                        		<option {{$data->priority == 'Normal' ? 'selected' : ''}}>Normal</option>
				                                        		<option {{$data->priority == 'Urgent' ? 'selected' : ''}}>Urgent</option>
				                                        	</select>
			                                        	</div>
			                                        	<div class="col-md-8">
				                                        	<span class="label_span">Remarks</span>
				                                            <textarea placeholder="" name="remarks" autocomplete="false"  class="form-control form-control-sm" rows="5">{{$data->remarks}}</textarea>
			                                        	</div>
			                                        </div>
			                                        <br>
			                                        <div class="row">
			                                        	<div class="col-md-8">
			                                        		&nbsp;
			                                        	</div>
			                                        	<div class="col-md-4 right_side">
			                                        		<button type="submit" class="btn btn-primary">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
			                                        		<a href="{{URL::to('/construction/requisition')}}" class="btn btn-default">Cancel</a>
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
@section('addStyle')
    <!-- select2 CSS -->
    <link href="/vendors4/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('addScript')
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

    <!-- Select2 JavaScript -->
    <script src="/vendors4/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
    	"use strict";
    	$(".select2").select2();
    </script>
@endsection