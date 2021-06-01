@extends('support.master')
@section('title', 'Quotation Plan | Sales')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-tasks"></i></span>Quotation Plan | Sales</h4>
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
                                    <p>CNIC: <strong>{{$data->cnic}}</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <p>Address: <strong>{{$data->address}}</strong></p>
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
                            <br><hr><br>
                            <div class="row">
                                <div class="col-lg-5">
                                    <form method="post" action="{{URL::to('/sales/quotation/add')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="lead_id" value="{{base64_encode($data->id)}}">
                                    <label>Description:</label>
                                    <select name="description" class="form-control" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach($descrip as $des)
                                            <option value="{{$des->id}}">{{$des->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Amount:</label>
                                    <input type="number" name="amount" step="any" class="form-control" required>
                                </div>
                                <div class="col-lg-2">
                                    <label>Multiplier (x):</label>
                                    <input type="number" name="multiplier" value="1" class="form-control" required>
                                </div>
                                <div class="col-lg-2">
                                    <br>
                                    <button class="btn btn-primary rem-btn">Add</button>
                                    </form>
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
                                                        <th style="width: 10%">#</th>
                                                        <th style="width: 55%">Description</th>
                                                        <th style="width: 25%">Amount</th>
                                                        <th style="width: 25%">Total</th>
                                                        <th style="width: 15%">User</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $s=1; $total=0; @endphp
                                                	@foreach($data->leadPlan as $key => $val)
                                                        <tr>
                                                            <td style="width: 10%">{{$s}}</td>
                                                            <td style="width: 35%">{{$val->descrip->description}}</td>
                                                            <td style="width: 25%">{{number_format($val->amount)}} x {{$val->multiplier}}</td>
                                                            <td style="width: 25%">{{number_format($val->totalAmount)}}</td>
                                                            <td><p class="date-label">{{$val->user->fullname}}</p></td>
                                                            <td style="width: 10%"><a href="javascript::void(0)" class="btn btn-danger btn-sm delete" data-id="{{base64_encode($val->id)}}"><span class="fa fa-trash"></span></a></td>
                                                        </tr>
                                                        @php $s++; $total = $total+$val->totalAmount @endphp
                                                    @endforeach
                                                    @if(count($data->leadPlan) == 0)
                                                        <tr>
                                                            <td colspan="6">No Plan Found.</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td colspan="3" style="text-align: right;">Grand Total:</td>
                                                            <td colspan="3"><strong>{{number_format($total)}}/-</strong></td>
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


           $('.delete').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to delete this?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/sales/quotation/delete/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
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
