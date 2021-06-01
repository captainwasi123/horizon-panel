@extends('support.master')
@section('title', 'Users Log')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="icon-people"></i></span>Users Log</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-lg-3">
                                    <form method="post">
                                        {{csrf_field()}}
                                    <label>Date:</label>
                                    <input class="form-control" type="date" name="date" value="{{empty($search_data['date']) ? date('Y-m-d') : $search_data['date']}}" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Action:</label>
                                    <select class="form-control" name="action">
                                        <option value="" selected>All</option>
                                        @foreach($actions as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['action']))
                                                    {{$search_data['action'] == $val->id ? 'selected' : ''}}
                                                @endif
                                            >{{$val->action}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Users:</label>
                                    <select class="form-control" name="user">
                                        <option value="" selected>All</option>
                                        @foreach($users as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['user']))
                                                    {{$search_data['user'] == $val->id ? 'selected' : ''}}
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
                                                        <th>Lead</th>
                                                        <th>user</th>
                                                        <th>Action</th>
                                                        <th>Created at</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	@php
                                                		$s=1;
                                                	@endphp
                                                	@foreach($databelt as $key => $data)
                                                    <tr>
                                                        <th scope="row">{{$s}}</th>
                                                        <td>{{empty($data->lead) ? '-' : $data->lead->name}}</td>
                                                        <td>{{empty($data->user) ? '-' : $data->user->fullname}}</td>
                                                        <td>
                                                        	<span class="badge badge-primary">{{empty($data->action) ? '-' : $data->action->action}}</span>
														</td>
                                                        <td>
                                                            <p class="date-label">
                                                                {{date('d-M-Y h:i a', strtotime($data->created_at))}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    	$s++;
                                                    @endphp
                                                    @endforeach
                                                    @if(count($databelt) == '0')
                                                        <tr>
                                                            <td colspan="5">No Records Found.</td>
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

        });
    </script>
@endsection
