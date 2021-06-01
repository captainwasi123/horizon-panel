@extends('support.master')
@section('title', 'Documentation Status')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-file"></i></span>Documentation Status</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Name: <strong>{{$data->name}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Phone: <strong>{{$data->phone}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Email: <strong>{{$data->email}}</strong></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Plot#: <strong>{{$data->plot_no}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Plot Size: <strong>{{$data->plot_size}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Precent: <strong>{{$data->precent}}</strong></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <p>Source: <strong>{{$data->leadSource->source}}</strong></p>
                                </div>
                                <div class="col-md-3">
                                    <p>Status: <strong>{{$data->leadStatus->label}}</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Target: <strong>{{empty($data->target) ? 'N/A' : $data->target}}</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p>Remarks: <strong><a href="javascript::void()"  data-toggle="modal" data-target="#remarksmodal{{$data->id}}">{{count($data->leadRemarks)}} Items</a></strong></p>
                                    
                                </div>
                            </div>
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
                                                        <th style="width: 40%">Description</th>
                                                        <th style="width: 10%">Status</th>
                                                        <th style="width: 15%">Date</th>
                                                        <th style="width: 15%">File</th>
                                                        <th style="width: 10%">User</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($DocDescrip as $val)
                                                    @php $exist = 0; @endphp
                                                        <tr>
                                                            <td style="width: 40%">{{$val->description}}</td>
                                                            @foreach($DocInfo as $di)
                                                                @if($di->des_id == $val->id)
                                                                    <td style="width: 10%">
                                                                        <span class="badge badge-success">Completed</span>
                                                                    </td>
                                                                    <td style="width: 15%">{{date('d-M-Y', strtotime($di->file_date))}}</td>
                                                                    <td style="width: 15%">
                                                                        @if(!empty($di->file_name))
                                                                            <a href="{{URL::to('/public/documents/'.$di->id.'-'.$di->file_name)}}" download>File <span class="fa fa-download"></span></a>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                    <td style="width: 10%">{{empty($di->user) ? 'Unknown' : $di->user->fullname}}</td>
                                                                    <td style="width: 10%"></td>
                                                                    @php $exist = 1; @endphp
                                                                @endif
                                                            @endforeach
                                                            @if($exist == 0)
                                                                <td style="width: 10%">
                                                                    <span class="badge badge-warning">Pending</span>
                                                                </td>
                                                                <td style="width: 15%">-</td>
                                                                <td style="width: 10%">-</td>
                                                                <td style="width: 10%">-</td>
                                                                <td style="width: 10%"><a href="javascript:void(0)" data-lead="{{$data->id}}" data-id="{{$val->id}}" class="btn btn-sm btn-default uploadDoc">Done</a></td>
                                                            @endif
                                                        </tr>
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

                        <div class="modal fade" id="uploadModalu" tabindex="-1" role="dialog" aria-labelledby="uploadModalu" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Document Copy</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{URL::to('/documentation/update')}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                        <input type="hidden" name="lead_id" id="llid">
                                        <input type="hidden" name="des_id" id="desid">
                                        <label>Document Date:</label>
                                        <input type="date" name="filedate" class="form-control" required>
                                        <br>
                                        <label>File:</label>
                                        <input type="file" name="filename" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- Modal -->
            </div>
            <!-- /Container -->
@endsection

@section('addStyle')

    <!-- Daterangepicker CSS -->
    <link href="/vendors4/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

    <!-- Data Table CSS -->
    <link href="/vendors4/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="/vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

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
           
            $(document).on('click touchstart', '.uploadDoc',function(e){
                var id = $(this).data("id");
                var lead = $(this).data("lead");
                $('#llid').val(lead);
                $('#desid').val(id);
                $('#uploadModalu').modal('show');
            });

        });
    </script>
@endsection
