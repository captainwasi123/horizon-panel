@extends('support.master')
@section('title', 'Work Flow | Layout Settings')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-list"></i></span>Work Flow | Layout Setting</h4>
                    <div class="right_side">
                        <a href="{{ URL::to('/setting/workflow/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Workflow</a>
                    </div>
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
                                                        <th>Title</th>
                                                        <th>Total Weeks</th>
                                                        <th>Created By</th>
                                                        <th>Created at</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $s=1; @endphp
                                                    @foreach($databelt as $data)
                                                        <tr>
                                                            <td>{{$s}}</td>
                                                            <td>{{$data->title}}</td>
                                                            <td>{{$data->weekSum[0]->total}} weeks</td>
                                                            <td>{{$data->user->fullname}}</td>
                                                            <td><p class="date-label">{{date('d-M-Y h:i a', strtotime($data->created_at))}}</p></td>
                                                            <td>
                                                                <a href="{{URL::to('/setting/workflow/edit/'.base64_encode($data->id))}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                                            </td>
                                                        </tr>
                                                        @php $s++; @endphp
                                                    @endforeach
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
