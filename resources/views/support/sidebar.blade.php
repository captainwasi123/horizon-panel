<nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/') }}" >
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '20')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#hbm">
                                    <span class="fa fa-building"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Building Material</span>
                                </a>
                                <ul id="hbm" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('hbm.queries.add') }}">Add Query</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('hbm.queries') }}">Queries</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('hbm.sales') }}">Sales</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '7' || Auth::user()->role_id == '8' || Auth::user()->role_id == '10'  || Auth::user()->role_id == '11')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#marketing">
                                    <span class="fa fa-microphone"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Marketing</span>
                                </a>
                                <ul id="marketing" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '8')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/query/add') }}">Add Query</a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/query/total') }}">Total Queries</a>
                                                </li> -->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCat">
                                                            Total Queries
                                                        </a>
                                                    <ul id="totalCat" class="nav flex-column collapse collapse-level-2">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(0).'/Uncategoriezed') }}">Uncategoriezed</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCat1">
                                                                    Bahria
                                                                </a>
                                                            <ul id="totalCat1" class="nav flex-column collapse collapse-level-3">
                                                                <li class="nav-item">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(1).'/Bahria Trading') }}">Trading</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(2).'/Bahria Villa') }}">Villa</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(3).'/Bahria Construction') }}">Construction</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCat2">
                                                                    DHA
                                                                </a>
                                                            <ul id="totalCat2" class="nav flex-column collapse collapse-level-3">
                                                                <li class="nav-item">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(4).'/DHA Construction') }}">Construction</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(5).'/DHA Trading') }}">Trading</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCat3">
                                                                    Industrial Plot
                                                                </a>
                                                            <ul id="totalCat3" class="nav flex-column collapse collapse-level-3">
                                                                <li class="nav-item">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(6).'/Industrial Plot Construction') }}">Construction</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(7).'/Industrial Plot Trading') }}">Trading</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCat4">
                                                                    Inter-City
                                                                </a>
                                                            <ul id="totalCat4" class="nav flex-column collapse collapse-level-3">
                                                                <li class="nav-item">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="{{ URL::to('/query/total/'.base64_encode(8).'/Inter City Construction') }}">Construction</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '7' || Auth::user()->role_id == '8' || Auth::user()->role_id == '10')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/leads/pending') }}">Pending Leads</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/query/potential') }}">Potential Queries</a>
                                                </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '11' || Auth::user()->role_id == '8' || Auth::user()->role_id == '10')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/query/superPotential') }}">Super Potential Queries</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '15' || Auth::user()->role_id == '17' || Auth::user()->role_id == '13' || Auth::user()->role_id == '19'  || Auth::user()->role_id == '16')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#bmarketing">
                                    <span class="fa fa-microphone"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Marketing - Bahria</span>
                                </a>
                                <ul id="bmarketing" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '13' || Auth::user()->role_id == '15')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('bahria/query/add') }}">Add Query</a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('bahria/query/total') }}">Total Queries</a>
                                                </li> -->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#totalCatb">
                                                            Total Queries
                                                        </a>
                                                    <ul id="totalCatb" class="nav flex-column collapse collapse-level-2">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ URL::to('bahria/query/total/'.base64_encode(1).'/Trading') }}">Trading</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ URL::to('/bahria/query/total/'.base64_encode(2).'/Villa') }}">Villa</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ URL::to('/bahria/query/total/'.base64_encode(3).'/Construction') }}">Construction</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '17' || Auth::user()->role_id == '13' || Auth::user()->role_id == '19')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('bahria/leads/pending') }}">Pending Leads</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('bahria/query/potential') }}">Potential Queries</a>
                                                </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '16' || Auth::user()->role_id == '13' || Auth::user()->role_id == '19')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('bahria/query/superPotential') }}">Super Potential Queries</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '3' || Auth::user()->role_id == '10')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#sales">
                                    <span class="fa fa-shopping-cart"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Sales</span>
                                </a>
                                <ul id="sales" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            @if(Auth::user()->role_id != '10')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/sales/leads/total') }}">Total Leads</a>
                                            </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '10')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/sales/leads/potential') }}">Potential Leads</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '18' || Auth::user()->role_id == '19')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#bsales">
                                    <span class="fa fa-shopping-cart"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Sales - Bahria</span>
                                </a>
                                <ul id="bsales" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            @if(Auth::user()->role_id != '19')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/sales/leads/total') }}">Total Leads</a>
                                            </li>
                                            @endif
                                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '19')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/sales/leads/potential') }}">Potential Leads</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '9')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/clientTarget') }}" >
                                    <i class="icon-people"></i>
                                    <span class="nav-link-text">Client Target</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#planinng">
                                    <span class="fa fa-tasks"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Planning</span>
                                </a>
                                <ul id="planinng" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/planning/leads') }}">Leads</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/documentation/leads') }}" >
                                    <i class="fa fa-file"></i>&nbsp;
                                    <span class="nav-link-text">Documentation</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '6')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#construct">
                                    <span class="fa fa-wrench"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Construction</span>
                                </a>
                                <ul id="construct" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/construction/requisition') }}">Requisition</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/construction/workflow') }}">Workflow</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '5')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#supplyChain">
                                    <span class="fa fa-cubes"></span>&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Procurement</span>
                                </a>
                                <ul id="supplyChain" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/supplyChain/requisition') }}">Requisition</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '12')
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#approval">
                                    <span class="fa fa-money"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="nav-link-text">Accounts</span>
                                </a>
                                <ul id="approval" class="nav flex-column collapse collapse-level-1">
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('/approval/construction_requisition') }}">Contruction Requisition</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <hr class="nav-separator">
                    @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '6')
                        <div class="nav-header">
                            <span>Settings</span>
                            <span>UI</span>
                        </div>
                        <ul class="navbar-nav flex-column">
                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '6')
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#setting">
                                        <span class="fa fa-gear"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="nav-link-text">Layout Setting</span>
                                    </a>
                                    <ul id="setting" class="nav flex-column collapse collapse-level-1">
                                        <li class="nav-item">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/setting/workflow') }}">Work Flow</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == '1')
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#userss">
                                        <span class="fa fa-users"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="nav-link-text">Users</span>
                                    </a>
                                    <ul id="userss" class="nav flex-column collapse collapse-level-1">
                                        <li class="nav-item">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/users') }}">Users List</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL::to('/users/log') }}">Users Log</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>