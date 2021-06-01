@extends('support.master')
@section('title', 'Requisitions | Approval')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-list"></i></span>Requisitions | Approval</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Need Date</th>
                                                        <th>Priority</th>
                                                        <th>Remarks</th>
                                                        <th>User</th>
                                                        <th>Client</th>
                                                        <th>Created at</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $s=1;
                                                    @endphp
                                                    @foreach($databelt as $key => $data)
                                                    <tr>
                                                        <th scope="row">{{$s}}</th>
                                                        <td>{{$data->item->item}}</td>
                                                        <td>{{$data->quantity}} <span class="user-label">{{$data->Unit->unit}}</</span></td>
                                                        <td>{{empty($data->need_date) ? '-' : date('d-M-Y', strtotime($data->need_date))}}</td>
                                                        <td><span class="badge badge-primary">{{$data->priority}}</span></td>
                                                        <td>
                                                            <a href="javascript::void()"  data-toggle="modal" data-target="#remarksmodal{{$data->id}}"><span class="badge badge-success">{{count($data->reqRemarks)}} Items</span></a>
                                                        </td>
                                                        <td><p class="user-label">{{$data->user->fullname}}</p></td>
                                                        <td><p class="date-label"><strong>{{$data->client->name}}</strong><br>Plot#: {{$data->client->plot_no}}</p></td>
                                                        <td><p class="date-label">{{date('d-M-Y h:i a', strtotime($data->created_at))}}</p></td>
                                                        <td>
                                                            @if($data->status == 1)
                                                                <span class="badge badge-info">Pending</span>
                                                            @elseif($data->status == 2)
                                                                <span class="badge badge-warning">Hold</span>
                                                            @elseif($data->status == 3)
                                                                <span class="badge badge-success">Delivered</span>
                                                            @elseif($data->status == 4)
                                                                <span class="badge badge-danger">Rejected</span>
                                                            @elseif($data->status == 5)
                                                                <span class="badge badge-primary">Processing</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <div class="dropdown">
                                                                    <a href="#" aria-expanded="false" data-toggle="dropdown" class="btn btn-link dropdown-toggle btn-icon-dropdown"><span class="feather-icon"><i data-feather="server"></i></span> <span class="caret"></span></a>
                                                                    <div role="menu" class="dropdown-menu">
                                                                        <a class="dropdown-item statusChange" data-status="3" data-id="{{ base64_encode($data->id) }}" href="#">Approved</a>
                                                                        <a class="dropdown-item statusChange" data-status="2" data-id="{{ base64_encode($data->id) }}" href="#">Hold</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item  statusChange" data-status="4" data-id="{{ base64_encode($data->id) }}" href="#">Rejected</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $s++;
                                                    @endphp
                                                    @endforeach
                                                    @if(count($databelt) == '0')
                                                        <tr>
                                                            <td colspan="11">No Records Found.</td>
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
                    @foreach($databelt as $key => $data)
                        <div class="modal fade" id="remarksmodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="remarksmodal{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requisition Remarks</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <form method="post" action="{{URL::to('/constRequisition/remarks/add')}}">
                                                {{csrf_field()}}
                                                <p><strong>Add Remarks:</strong></p>
                                            </div>
                                            <div class="col-lg-7">
                                                    <input type="hidden" name="req_id" value="{{base64_encode($data->id)}}">
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

                                            @if(count($data->reqRemarks) == '0')
                                                <div class="col-lg-12">
                                                    <p>No Records Found.</p>
                                                </div>
                                            @endif
                                            @foreach($data->reqRemarks as $key => $val)
                                                <div class="col-lg-12 rem-block">
                                                    <p>{{$val->remarks}}</p>
                                                    <p class="rem-date">{{date('d-M-Y h:i a', strtotime($val->created_at))}}</p><br>
                                                    <p class="rem-user">User: {{empty($val->user) ? 'Unknown' : $val->user->fullname}}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                <!-- Modal -->
            </div>
            <!-- /Container -->
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
            
           $('.statusChange').on('click',function(e){
                var req_id = $(this).data("id");
                var status = $(this).data("status");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to change status?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/supplyChain/requisition/status/'+status+'/'+req_id+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
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
