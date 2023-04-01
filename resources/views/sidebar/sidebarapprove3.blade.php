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

                @if (Auth::user()->role_name=='Manager')
                    {{-- <li class="menu-title"> <span>Authentication</span> </li>
                    <li class="{{set_active(['search/user/list','userManagement','activity/log','activity/login/logout'])}} submenu">
                        <a href="#" class="{{ set_active(['search/user/list','userManagement','activity/log','activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-user-secret"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['search/user/list','userManagement'])}}" href="{{ route('userManagement') }}">All User</a></li>
                            <li><a class="{{set_active(['activity/log'])}}" href="{{ route('activity/log') }}">Activity Log</a></li>
                            <li><a class="{{set_active(['activity/login/logout'])}}" href="{{ route('activity/login/logout') }}">Activity User</a></li>
                        </ul>
                    </li> --}}
                @endif

                <li class="menu-title"> <span>Menu Approval Direktur</span> </li>
                <li class="{{set_active(['create/estimate/page','form/estimates/page','payments','expenses/page'])}} submenu">
                    <a href="#" class="{{ set_active(['create/estimate/page','form/estimates/page','payments','expenses/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-edit"></i>
                        <span>Approval Page</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        {{-- <li><a class="{{set_active(['form/leavesApprove'])}}" href="{{ route('form/leavesApprove') }}">Approval 1 Leave Permit</a></li> --}}
                        <li><a class="{{set_active(['form/leavesApprove2'])}}" href="{{ route('form/leavesApprove2') }}">Approval 3 Leave Permit</a></li>
                        {{-- <li><a class="{{set_active(['form/sickApprove'])}}" href="{{ route('form/sickApprove') }}">Approval 1 Sick Leave</a></li> --}}
                        <li><a class="{{set_active(['form/sickApprove2'])}}" href="{{ route('form/sickApprove2') }}">Approval 3 Sick Leave</a></li>
                        <!-- <li><a class="{{set_active(['expenses/page'])}}" href="{{ route('expenses/page') }}">Expenses</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
