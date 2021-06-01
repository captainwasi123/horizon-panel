@extends('support.master')
@section('title', 'Workflow | Construction')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-tasks"></i></span>Workflow</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <form method="post">
                            {{csrf_field()}}
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Customer Name:</label>
                                        <input class="form-control" type="text" name="cust_name" value="{{empty($search_data['cust_name']) ? '' : $search_data['cust_name']}}" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Precent:</label>
                                        <input class="form-control" type="text" name="precent" value="{{empty($search_data['precent']) ? '' : $search_data['precent']}}" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Plot#:</label>
                                        <input class="form-control" type="text" name="plot_no" value="{{empty($search_data['plot_no']) ? '' : $search_data['plot_no']}}" />
                                    </div>
                                    <div class="col-lg-2">
                                        <br>
                                        <button class="btn btn-primary rem-btn">Search</button>
                                    </div>
                                </div>
                            </section>
                        </form>
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
                                                        <th>Plot#</th>
                                                        <th>Plot Size</th>
                                                        <th>Precent</th>
                                                        <th>Source</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                        <th>Created by</th>
                                                        <th>Created at</th>
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
                                                        <td>{{$data->plot_no}}</td>
                                                        <td>{{$data->plot_size}}</td>
                                                        <td>{{$data->precent}}</td>
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
														<td>
                                                            <a href="{{URL::to('/construction/workflow/'.base64_encode($data->id))}}" target="_blank" class="btn btn-success btn-sm">Flow</a>
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


           $('.assignModal').on('click',function(e){
                var id = $(this).data("id");
                $('#lid').val(id);
                $('#assignModalu').modal('show');
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

            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                "cancelClass": "btn-secondary",
            }, function(start, end, label) {
                $('#daterange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
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
           $('.tst2').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to move this to trash?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/leads/delete/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-warning',
                    hideAfter: 3500, 
                    stack: 6,
                    showHideTransition: 'fade'
                });
                return false;
            });

           $('.inac-tst').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to In-Active this user?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/users/inactive/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-warning',
                    hideAfter: 3500, 
                    stack: 6,
                    showHideTransition: 'fade'
                });
                return false;
            });

           $('.ac-tst').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to Active this user?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/users/active/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
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
