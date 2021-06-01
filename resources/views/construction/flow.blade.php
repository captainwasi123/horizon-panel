@extends('support.master')
@section('title', 'Work Flow | Construction')
@section('content')
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
            	<br>
            </nav>	
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <br>
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-bar-chart"></i></span>Work Flow | Construction</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Name: <strong>{{$data->name}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Plot Size: <strong>{{$data->plot_size}}</strong></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Plot#: <strong>{{$data->plot_no}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Precent: <strong>{{$data->precent}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Remarks: <strong><a href="javascript::void()"  data-toggle="modal" data-target="#remarksmodal{{$data->id}}">{{count($data->leadRemarks)}} Items</a></strong></p>
                                    
                                </div>
                            </div>
                            @if(count($data->workflow) < 1)
                                <br><hr>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <form method="post" action="{{URL::to('/construction/workflow/generate')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="lead_id" value="{{base64_encode($data->id)}}">
                                        <label>Workflow Layout:</label>
                                        <select class="form-control" name="layout_id" required>
                                            <option value="">Select</option>
                                            @foreach($flows as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Start Date:</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <br>
                                        <button class="btn btn-primary rem-btn">Generate</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                @if(Auth::user()->role_id)
                                    <br><hr>
                                    <div class="row">
                                        <div class="col-lg-10">
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="javascript:void(0)" class="btn btn-danger rem-btn deleteFlow" data-id="{{base64_encode($data->id)}}">Delete</a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">#</th>
                                                        <th style="width: 45%">Item</th>
                                                        <th style="width: 25%">Finish Date</th>
                                                        <th style="width: 25%">Week</th>
                                                        <th style="width: 10%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $s=1; @endphp
                                                    @foreach($data->workflow as $val)
                                                        <tr>
                                                            <td>{{$s}}</td>
                                                            <td>{{$val->item->item}}</td>
                                                            <td>{{date('d-M-Y', strtotime($val->finish_date))}}</td>
                                                            <td>
                                                                @php
                                                                    $ends = array('th','st','nd','rd','th','th','th','th','th','th'); 
                                                                    $number = $val->week; 
                                                                @endphp
                                                                
                                                                @if ((($number % 100) >= 11) && (($number%100) <= 13))
                                                                    {{$number. 'th'}} week
                                                                @else
                                                                    {{$number. $ends[$number % 10]}} week
                                                                @endif
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <label class="container">
                                                                  <input type="checkbox" class="hide-checkbox flowstatus" data-id="{{$val->id}}" name="status"
                                                                  {{$val->status == '1' ? 'checked' : ''}}
                                                                  >
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if(count($data->workflow) == 0)
                                                        <tr>
                                                            <td colspan="5">No Workflow Found.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Row -->

                 <!-- Modal -->
                        <div class="modal fade" id="remarksmodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="remarksmodal{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Lead Remarks</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <form method="post" action="{{URL::to('/leads/remarks/add')}}">
                                                {{csrf_field()}}
                                                <p><strong>Add Remarks:</strong></p>
                                            </div>
                                            <div class="col-lg-7">
                                                    <input type="hidden" name="lead_id" value="{{base64_encode($data->id)}}">
                                                    <textarea class="form-control" rows="3" name="remarks"></textarea>
                                                    <br>
                                            </div>
                                            <div class="col-lg-3">
                                                    <button type="submit" class="btn btn-success btn-sm rem-btn">Submit</button><br>
                                                    <button type="reset" class="btn btn-default btn-sm rem-btn">Clear</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <hr>
                                                <h5 style="padding-bottom: 5px;">History:</h5>
                                            </div> 

                                            @if(count($data->leadRemarks) == '0')
                                                <div class="col-lg-12">
                                                    <p>No Records Found.</p>
                                                </div>
                                            @endif
                                            @foreach($data->leadRemarks as $key => $val)
                                                @if($val->status == '1')
                                                    <div class="col-lg-12 rem-block2">
                                                        <p>{{$val->remarks}}</p>
                                                        <p class="rem-date">{{date('d-M-Y h:i a', strtotime($val->created_at))}}</p><br>
                                                        <p class="rem-user">User: {{empty($val->user) ? 'Unknown' : $val->user->fullname}} | {{empty($val->user) ? 'Unknown' : $val->user->phone}}</p>
                                                    </div>
                                                @else
                                                    <div class="col-lg-12 rem-block">
                                                        <p>{{$val->remarks}}</p>
                                                        <p class="rem-date">{{date('d-M-Y h:i a', strtotime($val->created_at))}}</p><br>
                                                        <p class="rem-user">User: {{empty($val->user) ? 'Unknown' : $val->user->fullname}}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- Modal -->
            </div>
            <!-- /Container -->
@endsection

@section('addStyle')


    <!-- Data Table CSS -->
    <link href="/vendors4/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="/vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <style>
        
        </style>

@endsection
@section('addScript')
    
    @if (session()->has('success'))
        <script type="text/javascript">
            $.toast({
                text: "<i class='jq-toast-icon glyphicon glyphicon-ok'></i><p><strong>Success.! </strong> &nbsp;{{session()->get('success')}}</p>",
                position: 'top-center',
                loaderBg:'#7a5449',
                class: 'jq-has-icon jq-toast-success',
                hideAfter: 3500, 
                stack: 6,
                showHideTransition: 'fade'
            });
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";


           $('.deleteFlow').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to delete this Flow?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/construction/workflow/delete/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-warning',
                    hideAfter: 3500, 
                    stack: 6,
                    showHideTransition: 'fade'
                });
                return false;
            });
        });
    </script>
@endsection
