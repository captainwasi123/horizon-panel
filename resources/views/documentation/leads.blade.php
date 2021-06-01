@extends('support.master')
@section('title', 'Documentation')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="icon-people"></i></span>Documentation</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post">
                                        {{csrf_field()}}
                                    <label>Date Range:</label>
                                    <input class="form-control" type="text" id="daterange" name="daterange" value="{{empty($search_data['daterange']) ? date('m/1/Y').' - '.date('m/30/Y') : $search_data['daterange']}}" />
                                </div>
                                <div class="col-lg-6">
                                    <label>Customer Name:</label>
                                    <input class="form-control" type="text" name="cust_name" value="{{empty($search_data['cust_name']) ? '' : $search_data['cust_name']}}" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Source:</label>
                                    <select class="form-control" name="source">
                                        <option value="" selected>All</option>
                                        @foreach($source as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['source']))
                                                    {{$search_data['source'] == $val->id ? 'selected' : ''}}
                                                @endif
                                            >{{$val->source}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Status:</label>
                                    <select class="form-control" name="status">
                                        <option value="" selected>All</option>
                                        @foreach($status as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['status']))
                                                    {{$search_data['status'] == $val->id ? 'selected' : ''}}
                                                @endif
                                            >{{$val->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>User by:</label>
                                    <select class="form-control" name="user_by">
                                        <option value="" selected>All</option>
                                        @foreach($users as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['user_by']))
                                                    {{$search_data['user_by'] == $val->id ? 'selected' : ''}}
                                                @endif
                                            >{{$val->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <br>
                                    <button class="btn btn-primary rem-btn">Search</button>
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
                                            <table class="table mb-0" id="datable_3">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Source</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                        <th>User</th>
                                                        <th>Created at</th>
                                                        <th>Assigned to</th>
                                                        <th>Assigned at</th>
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
                                                        <td>{{$data->name}}</td>
                                                        <td>{{empty($data->email) ? '-' : $data->email}}</td>
                                                        <td>{{empty($data->phone) ? '-' : $data->phone}}</td>
                                                        <td>
                                                        	<span class="badge badge-primary">{{$data->leadSource->source}}</span>
														</td>
                                                        <td>
                                                            @if($data->status == 1)
                                                                <span class="badge badge-success">Interested</span>
                                                            @elseif($data->status == 2)
                                                                <span class="badge badge-danger">Not-Interested</span>
                                                            @else
                                                                <span class="badge badge-warning">Others</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="openremarks" data-id="{{$data->id}}"><span class="badge badge-success">{{count($data->leadRemarks)}} Items</span></a>
                                                        </td>
                                                        <td><p class="user-label">{{$data->user->fullname}}</p></td>
                                                        <td><p class="date-label">{{date('d-M-Y h:i a', strtotime($data->created_at))}}</p></td>
                                                        <td><p class="user-label">{{empty($data->assign) ? '-' : $data->assign->assignUser->fullname}}</p></td>
                                                        <td><p class="date-label">{{empty($data->assign) ? '-' : date('d-M-Y h:i a', strtotime($data->assign->created_at))}}</p></td>
														<td>
                                                            <a href="{{URL::to('/documentation/leads/detail/'.base64_encode($data->id))}}" class="btn btn-sm btn-success">Details</a>
														</td>
                                                    </tr>
                                                    @php
                                                    	$s++;
                                                    @endphp
                                                    @endforeach
                                                    @if(count($databelt) == '0')
                                                        <tr>
                                                            <td colspan="8">No Records Found.</td>
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
                    <div class="modal fade" id="remarksmodal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Lead Remarks</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="remarksbody">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="modal fade" id="targetMod" tabindex="-1" role="dialog" aria-labelledby="targetMod" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Potential Lead</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{URL::to('/sales/leads/potential/target')}}">
                                        {{csrf_field()}}
                                    <input type="hidden" name="lead_id" id="lid">
                                    <label>Client Target:</label>
                                    <input type="text" class="form-control" name="client_target" required>
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

    <!-- Daterangepicker JavaScript -->
    <script src="/vendors4/moment/min/moment.min.js"></script>
    <script src="/vendors4/daterangepicker/daterangepicker.js"></script>
    <!-- Data Table JavaScript -->
    <script src="/vendors4/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/vendors4/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="/vendors4/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendors4/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/vendors4/jszip/dist/jszip.min.js"></script>
    <script src="/vendors4/pdfmake/build/pdfmake.min.js"></script>
    <script src="/vendors4/pdfmake/build/vfs_fonts.js"></script>
    <script src="/vendors4/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendors4/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/vendors4/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";

            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                "cancelClass": "btn-secondary",
                autoUpdateInput: false
            }, function(start, end, label) {
                $('#daterange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            
            $(document).on('click','.openremarks' ,function(e){
                var id = $(this).data("id");
                var xhttp = new XMLHttpRequest();
                $('#remarksmodal').modal('show');
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#remarksbody').html(xhttp.responseText);
                    }else{
                        $('#remarksbody').html('<img src="{{URL::to('/')}}/dist/img/earth.gif" width="200">');
                    }
                };
                xhttp.open("GET", "{{URL::to('/')}}/leads/remarks/load/"+id, true);
                xhttp.send();
            });

            $(document).on('click', '.targetModal', function() {
                var id = $(this).data("id");
                $('#lid').val(id);
                $('#targetMod').modal('show');
            });

            $('#datable_3').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                language: { search: "",searchPlaceholder: "Search" },
                "bPaginate": true,
                "info":     true,
                "bFilter":     false,
                buttons: [
                    {
                       extend: 'pdf',
                       footer: true,
                       exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                   },
                   {
                       extend: 'excel',
                       footer: false,
                       exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                      
                   },
                   {
                       extend: 'print',
                       footer: false,
                       exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                   }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                }
            } );
           

            $(document).on('click', '.pendingLead', function() {
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to move this to Pending?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/query/status/6/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-warning',
                    hideAfter: 3500, 
                    stack: 6,
                    showHideTransition: 'fade'
                });
                return false; 
            });


            $(document).on('click', '.convert', function() {
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to convert this to sale?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/query/convert/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
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
