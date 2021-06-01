@extends('support.master')
@section('title', 'Dashboard')
@section('content')

      <!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
              @if(Auth::user()->role_id == '9')
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                      <h2 class="hk-pg-title font-weight-600 mb-10">Horizon Properties</h2>
                      <p>Welcome to <a href="">HORIZON PROPERTIES</a> dashboard.</p>
                      <br>
                      <a href="{{ URL::to('/clientTarget') }}" class="btn btn-primary">Click Here to check client's Target.</a>
                    </div>
                </div>
                <!-- /Title -->
              @else
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                      <h2 class="hk-pg-title font-weight-600 mb-10">Data Analytics Dashboard</h2>
                      <p>About <a href="">HORIZON PROPERTIES</a> onboarding lead data.</p>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                      <div class="hk-row">
                        <div class="col-lg-12">
                          
                          <div class="hk-row">              
                            <div class="col-sm-6 col-lg-4">
                              <div class="card card-sm">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Total Queries</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-primary  badge-sm">+10%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['totalQueries']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                              <div class="card card-sm">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Potential Queries</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-danger   badge-sm">+10%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['potentialQueries']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                              <div class="card card-sm">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Super-Potential Queries</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-danger   badge-sm">+10%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['superPotentialQueries']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                              <div class="card card-sm" style="background-color:#ff9d72b3;">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Pending Leads</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-danger   badge-sm">+10%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['pendingLeads']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                              <div class="card card-sm">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Total Leads</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-primary  badge-sm">-1.5%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['totalLeads']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                              <div class="card card-sm">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Potential Leads</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-warning  badge-sm">+60%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['potentialLeads']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                              <div class="card card-sm" style="background-color:#b6ff6fb8;">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between mb-5">
                                    <div>
                                      <span class="d-block font-15 text-dark font-weight-700">Mature Sale</span>
                                    </div>
                                    <div>
                                      <span class="badge badge-danger   badge-sm">+10%</span>
                                    </div>
                                  </div>
                                  <div>
                                    <span class="d-block display-5 text-dark mb-5">{{$data['matureSale']}}</span>
                                    <small class="d-block">All Sources Included.</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '7'  || Auth::user()->role_id == '8')
                            <div class="col-lg-12">
                              <div class="card" style="min-height: 337px;">
                                <div class="card-header card-header-action">
                                  <h6>Visit Alerts</h6>
                                  <div class="d-flex align-items-center card-action-wrap">
                                  </div>
                                </div>
                                <div class="card-body table-responsive" style="padding: 0;">
                                  <table class="table">
                                    <tr>
                                      <th style="width: 5%;">#</th>
                                      <th style="width: 30%;">Name</th>
                                      <th style="width: 25%;">Phone</th>
                                      <th style="width: 15%;">Status</th>
                                      <th style="width: 20%;">Visit</th>
                                      <th style="width: 10%">Remarks</th>
                                      <th style="width: 10%">Action</th>
                                    </tr>
                                    @php $s=1; $todate = date('Y-m-d'); @endphp
                                    @foreach($data['todayVisit'] as $val)
                                      <tr>
                                        <td style="width: 5%;">{{$s}}</td>
                                        <td style="width: 30%;"><p style="font-size:13px">{{$val->name}}</p></td>
                                        <td style="width: 25%;"><p style="font-size:13px">{{$val->phone}}</p></td>
                                        <td style="width: 15%;">
                                            @if($val->lead_status == '2')
                                                <span class="badge badge-primary">Potential Queries</span>
                                            @elseif($val->lead_status == '6')
                                                <span class="badge badge-danger">Pending Leads</span>
                                            @else
                                                <span class="badge badge-info">Others</span>
                                            @endif
                                        </td>
                                        <td style="width: 20%;">
                                          @if($val->visit_date == $todate)
                                            <span class="badge badge-warning">Today</span>
                                          @else
                                            <span class="badge badge-info">Tomorrow</span>
                                          @endif
                                          <p class="date-label">{{date('d-M-Y', strtotime($val->visit_date))}}</p>
                                        </td>
                                        <td style="width: 10%;">
                                            <a href="javascript::void()"  data-toggle="modal" data-target="#remarksmodal{{$val->id}}"><span class="badge badge-success">{{count($val->leadRemarks)}} Items</span></a>
                                        </td>
                                        <td>
                                          <div class="btn-group">
                                              <div class="dropdown">
                                                  <a href="#" aria-expanded="false" data-toggle="dropdown" class="btn btn-link dropdown-toggle btn-icon-dropdown"><span class="feather-icon"><i data-feather="server"></i></span> <span class="caret"></span></a>
                                                  <div role="menu" class="dropdown-menu">
                                                      <a class="dropdown-item assignModal" data-id="{{ base64_encode($val->id) }}" href="javascript:void(0)"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Lead</a>
                                                      <a class="dropdown-item visitModal" data-id="{{ base64_encode($val->id) }}" href="javascript:void(0)"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Visit Date</a>
                                                      @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '8')
                                                          <a class="dropdown-item" href="{{URL::to('/')}}/query/edit/{{ base64_encode($val->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit</a> 
                                                          <div class="dropdown-divider"></div>
                                                          <a class="dropdown-item tst2" data-id="{{ base64_encode($val->id) }}" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</a>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @php $s++; @endphp
                                    @endforeach
                                    @if(count($data['todayVisit']) == '0')
                                      <tr>
                                        <td colspan="7">No Visits Found.</td>
                                      </tr>
                                    @endif
                                  </table>
                                </div>
                              </div>
                            </div>
                            @endif 
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- /Row -->
              @endif
            </div>
            <!-- /Container -->
            
             @foreach($data['todayVisit'] as $key => $data)
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
                    @endforeach


                                        <div class="modal fade" id="assignModalu" tabindex="-1" role="dialog" aria-labelledby="assignModalu" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign Lead to Person</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{URL::to('/query/assign/person')}}">
                                        {{csrf_field()}}
                                    <input type="hidden" name="lead_id" id="lid">
                                    <label>Assign To:</label>
                                    <select class="form-control" name="assign_to" required>
                                        <option value="" selected>Select</option>
                                        @foreach($users as $key => $val)
                                            <option value="{{$val->id}}"
                                                @if(!empty($search_data['user_by']))
                                                    {{$search_data['user_by'] == $val->id ? 'selected' : ''}}
                                                @endif
                                            >{{$val->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="visitModalu" tabindex="-1" role="dialog" aria-labelledby="visitModalu" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Set Visit Date</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{URL::to('/query/visitDate')}}">
                                        {{csrf_field()}}
                                    <input type="hidden" name="lead_id" id="llid">
                                    <label>Date:</label>
                                    <input type="date" name="visit_date" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    
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
    /*Dashboard3 Init*/
       
      "use strict"; 

   $(document).on('click touchstart', '.assignModal',function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $('#lid').val(id);
        $('#assignModalu').modal('show');
    });

    $(document).on('click touchstart', '.visitModal',function(e){
        var id = $(this).data("id");
        $('#llid').val(id);
        $('#visitModalu').modal('show');
    });

  </script>
@endsection