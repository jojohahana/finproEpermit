<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <h1>
                        <span>E-PERMIT</span>
                    </h1>
                </li>
                {{-- <li class="{{set_active(['home','em/dashboard'])}} submenu">
                    <a href="#" class="{{ set_active(['home','em/dashboard']) ? 'noti-dot' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Summary Dashboard</a></li>

                    </ul>
                </li> --}}
                @if (Auth::user()->role_name=='Admin')
                    <li class="menu-title"> <span>Authentication</span> </li>
                    <li class="{{set_active(['search/user/list','userManagement','activity/log','activity/login/logout'])}} submenu">
                        <a href="#" class="{{ set_active(['search/user/list','userManagement','activity/log','activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-user-secret"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['search/user/list','userManagement'])}}" href="{{ route('userManagement') }}">All User</a></li>
                            <li><a class="{{set_active(['activity/log'])}}" href="{{ route('activity/log') }}">Activity Log</a></li>
                            <li><a class="{{set_active(['activity/login/logout'])}}" href="{{ route('activity/login/logout') }}">Activity User</a></li>
                        </ul>
                    </li>
                @endif

                <li class="menu-title"> <span>Menu Approval</span> </li>
                <li class="{{set_active(['create/estimate/page','form/estimates/page','payments','expenses/page'])}} submenu">
                    <a href="#" class="{{ set_active(['create/estimate/page','form/estimates/page','payments','expenses/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-edit"></i>
                        <span>Approval Page</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/leavesApprove'])}}" href="{{ route('form/leavesApprove') }}">Approval 1 Leave Permit</a></li>
                        <li><a class="{{set_active(['form/leavesApprove2'])}}" href="{{ route('form/leavesApprove2') }}">Approval 2 Leave Permit</a></li>
                        <li><a class="{{set_active(['form/sickApprove'])}}" href="{{ route('form/sickApprove') }}">Approval 1 Sick Leave</a></li>
                        <li><a class="{{set_active(['form/sickApprove2'])}}" href="{{ route('form/sickApprove2') }}">Approval 2 Sick Leave</a></li>
                        <!-- <li><a class="{{set_active(['expenses/page'])}}" href="{{ route('expenses/page') }}">Expenses</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
