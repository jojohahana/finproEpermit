@extends('layouts.masterapproval')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Approval Supervisor Leave Permit <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Approval</a></li>
                            <li class="breadcrumb-item active">Leaves Permit</li>
                        </ul>
                    </div>
                    {{-- <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                    </div> --}}
                </div>
            </div>
            <!-- Search Filter -->
            {{-- <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <input id="searchByNik" type="text" class="form-control floating">
                        <label class="focus-label">Enter NIK</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select id="filterLeaveType" class="select floating">
                            <option value=""> -- Select -- </option>
                            <option value="CT">Cuti Tahunan</option>
                            <option value="CB">Cuti Besar</option>
                            <option value="CK">Cuti Khusus</option>
                        </select>
                        <label class="focus-label">Leave Type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option> -- Select -- </option>
                            <option> New </option>
                            <option> Pending </option>
                            <option> Approved </option>
                            <option> Rejected </option>
                        </select>
                        <label class="focus-label">Status Approve</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div> --}}
            <!-- /Search Filter -->

			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">Approve ?</th>
                                    <th>Status</th>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>No of Days</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!empty($leaves))
                                    @foreach ($leaves as $items2 )
                                        <tr>
                                            <td hidden class="id">{{ $items2->id }}</td>
                                            <td class="text-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-eye fa-lg"></i></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{url('form/leavesApprove/app2/acc/'.$items2->id)}}"onclick="return confirm('Are you sure to want to approve it?')"><i class="fa fa-check m-r-5"></i> Approve</a>
                                                        <a class="dropdown-item" href="{{url('form/leavesApprove/app2/decline/'.$items2->id)}}"onclick="return confirm('Are you sure to want to decline it?')"><i class="fa fa-trash-o m-r-5"></i> Decline</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="statusApp_Edit">{{ $items2->stat_app3 }}</td>
                                            <td><h2 class="table-avatar"><a>{{ $items2->name }}<span>{{ $items2->position }}</span></a></h2></td>
                                            <td class="leave_type">{{$items2->leave_type}}</td>
                                            <td hidden class="from_date">{{ $items2->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items2->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items2->to_date}}</td>
                                            <td>{{date('d F, Y',strtotime($items2->to_date)) }}</td>
                                            <td class="day">{{$items2->day}} Day</td>
                                            <td class="leave_reason">{{$items2->leave_reason}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        {{-- Modals 2 Button Decline / Approve  --}}
         <div id="approveLeaves" class="modal custom-modal-fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title">Update Approval Leaves</h5>
                    </div> --}}
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Approve or Decline Permit ?</h3>
                        </div>
                        <div class="modal-btn delete-action">
                            {{-- <form action="#" method="post">
                                @csrf
                                <input type="hidden" name="id" class="" value=""> --}}
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-primary continue-btn" href="javascript:void(0);">Approve</a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-primary continue-btn" href="{{ url('form/leavesApprove/app2/decline/'.$items2->id) }}" onclick="return confirm('Yakin Decline ?')">Decline</a>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Modals 2 Button Decline / Approve  --}}

        {{-- Modals Approval  --}}
        {{-- <div id="approveLeaves" class="modal custom-modal-fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Approval Leaves</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/leavesApprove/app1') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_Up" id="editStatus_id" value="">
                                <div class="form-group">
                                    <select class="select @error('statusApp_Edit') is-invalid @enderror" name="statusApp_Edit" id="statusApp_Edit">
                                        <option selected disabled>-- Select Status --</option>
                                        @foreach ($statAppList as $status)
                                            <option value="{{ $status->status_app}}">{{ $status->status_app}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Send Action</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- /Modals Approval  --}}
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $(document).on('click','.update_Status',function()
        {
            var _this = $(this).parents('tr');
            $('#editStatus_id').val(_this.find('.id').text());
            $('#statusApp_Edit').val(_this.find('.statusApp_Edit').text());
            $('#statusHidd_Edit').val(_this.find('.statusHidd_Edit').text());
        });
    </script>
    @endsection
@endsection
