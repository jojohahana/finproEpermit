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
                        <h3 class="page-title">Approval Sick Leaves Manager Levels <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leaves</li>
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
                                    {{-- <th>Reason</th> --}}
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
                                                        <a class="dropdown-item" href="{{url('form/sickApprove/app2/acc/'.$items->id)}}"onclick="return confirm('Are you sure to want to approve it?')"><i class="fa fa-check m-r-5"></i> Approve</a>
                                                        <a class="dropdown-item" href="{{url('form/sickApprove/app2/decline/'.$items->id)}}"onclick="return confirm('Are you sure to want to decline it?')"><i class="fa fa-trash-o m-r-5"></i> Decline</a>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="text-center"> <a class="dropdown-item update_Status" data-toggle="modal" data-target="#approveLeaves"><i class="fa fa-reply fa-lg"></i></a></td> --}}
                                            {{-- <td class="statusApp_Edit">{{ $items->stat_app2 }}</td> --}}
                                            <td class="statusApp_Edit">{{ $items->stat_app2 }}</td>
                                            <td hidden class="statusHidd_Edit">{{ $items->stat_app2 }}</td>
                                            <td><h2 class="table-avatar"><a>{{ $items->name }}<span>{{ $items->position }}</span></a></h2></td>
                                            <td class="sick_type">{{$items->sick_type}}</td>
                                            <td hidden class="from_date">{{ $items->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items->to_date}}</td>
                                            <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                            <td class="day">{{$items->day}} Day</td>
                                            {{-- <td class="leave_reason">{{$items->leave_reason}}</td> --}}
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

    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script type="text/javascript">
    // Filter by Search & DropDown
        $(function () {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('form/leavesApprove')}}",
                    data: function (d) {
                        d.leaveType = $('#filterLeaveType').val(),
                        d.searchNik = $('#searchByNik').val()
                    }
                },
                columns: [
                    {data:'id', name:'id'},
                    {data:'leave_type', name:'leave_type'},
                    {data:'from_date', name:'from_date'},
                    {data:'to_date', name:'to_date'},
                    {data:'day', name:'day'},
                    {data:'leave_reason', name:'leave_reason'},
                ];
            });

            $('#filterLeaveType').change(function(){
                table.draw();
            });
        })
    </script>
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
    {{-- update js --}}
    <script>
        $(document).on('click','.leaveUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_number_of_days').val(_this.find('.day').text());
            $('#e_from_date').val(_this.find('.from_date').text());
            $('#e_to_date').val(_this.find('.to_date').text());
            $('#e_leave_reason').val(_this.find('.leave_reason').text());

            var leave_type = (_this.find(".leave_type").text());
            var _option = '<option selected value="' + leave_type+ '">' + _this.find('.leave_type').text() + '</option>'
            $( _option).appendTo("#e_leave_type");
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.leaveDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
