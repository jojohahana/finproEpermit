@extends('layouts.masterapproval3')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Approval Direksi Leave Permit <span id="year"></span></h3>
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
                                    <th>Remain of Leaves</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!empty($leaves))
                                    @foreach ($leaves as $items )
                                        <tr>
                                            <td hidden class="id">{{ $items->id }}</td>
                                            <td class="text-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-eye fa-lg"></i></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{url('form/leavesApprove/app2/acc/'.$items->id) }}"onclick="return confirm('Are you sure to want to approve it?')"><i class="fa fa-check m-r-5"></i> Approve</a>
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#decline_leave" href="#"><i class="fa fa-trash-o m-r-5"></i> Decline</a>
                                                        {{-- <a class="dropdown-item" href="{{url('form/leavesApprove/app2/decline/'.$items->id) }}"onclick="return confirm('Are you sure to want to decline it?')"><i class="fa fa-trash-o m-r-5"></i> Decline</a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="statusApp_Edit">{{ $items->stat_app3 }}</td>
                                            <td><h2 class="table-avatar"><a>{{ $items->name }}<span>{{ $items->position }}</span></a></h2></td>
                                            <td class="leave_type">{{$items->category}}</td>
                                            <td hidden class="from_date">{{ $items->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items->to_date}}</td>
                                            <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                            <td class="day">{{$items->day}} Day</td>
                                            <td class="remain_cuti">{{$items->remain_cuti}} Day</td>
                                            <td class="leave_reason">{{$items->leave_reason}}</td>
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
         <div class="modal custom-modal fade" id="decline_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Reason for refunsing leaves</h3>
                            <div class="form-group">
                                <textarea rows="4" class="form-control" id="reasonleaves" name="reasonleaves" value=""></textarea>
                            </div>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leavesApprove3') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="nik" value="">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn submit-btn">Decline</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        {{-- /Modals 2 Button Decline / Approve  --}}
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
