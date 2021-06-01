@extends('support.master')
@section('title', 'Edit Work Flow | Layout Settings')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="fa fa-gear"></i></span>Edit Work Flow | Layout Settings</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{URL::to('/setting/workflow/update')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="workflow_id" value="{{base64_encode($data->id)}}">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <label>Title:</label>
                                        <input type="text" name="title" class="form-control" value="{{$data->title}}" required>
                                    </div>
                                </div>
                                <br>
                                <div id="content_div">
                                    @php $s=1; @endphp
                                    @foreach($data->details as $val)
                                        @if($s == 1)
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label>Description:</label>
                                                    <select class="form-control form-control-sm" name="description[]" required>
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach($items as $item)
                                                            <option value="{{$item->id}}"
                                                                @if($item->id == $val->item_id)
                                                                    selected
                                                                @endif
                                                            >{{$item->item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Weeks:</label>
                                                    <input type="number" name="weeks[]" class="form-control form-control-sm" value="{{$val->weeks}}" required>
                                                </div>
                                                <div class="col-lg-1">
                                                    <br>
                                                    <button type="button" id="addItem" class="btn btn-primary btn-sm rem-btn">+</button>
                                                </div>
                                            </div>
                                            @php $s++; @endphp
                                        @else
                                            <div class="row">
                                                <div class="col-lg-12"><br></div>
                                                <div class="col-lg-8">
                                                    <select class="form-control form-control-sm" name="description[]" required>
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach($items as $item)
                                                            <option value="{{$item->id}}"
                                                                @if($item->id == $val->item_id)
                                                                    selected
                                                                @endif
                                                            >{{$item->item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="number" name="weeks[]" value="{{$val->weeks}}" class="form-control form-control-sm" required>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button type="button" class="btn btn-danger btn-sm remm-btn removeItem">-</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <br><hr>
                                <div class="row">
                                    <div class="col-lg-9">
                                    </div>
                                    <div class="col-lg-3" style="text-align: right;">
                                        <a href="{{URL::to('/setting/workflow')}}" class="btn btn-default btn-sm">Cancel</a>
                                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </div>
                            </section>
                        </form>
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

    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";

           $('#content_div').on('click', '#addItem', function(){
                $('#content_div').append('<div class="row"><div class="col-lg-12"><br></div><div class="col-lg-8"><select class="form-control form-control-sm" name="description[]" required><option value="" selected disabled>Select</option>@foreach($items as $item)<option value="{{$item->id}}">{{$item->item}}</option>@endforeach</select></div><div class="col-lg-3"><input type="number" name="weeks[]" class="form-control form-control-sm" required></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-sm remm-btn removeItem">-</button></div></div>');
           });

           $('#content_div').on('click', '.removeItem', function(){
                $(this).parent().parent().remove();
           });

           $('.delete').on('click',function(e){
                var del_data = $(this).data("id");
                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    heading: 'Are you sure you want to delete this?',
                    text: '<i class="jq-toast-icon ti-alert"></i><a href="{{ URL::to("/")}}/planning/installment/delete/'+del_data+'" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</a>',
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
