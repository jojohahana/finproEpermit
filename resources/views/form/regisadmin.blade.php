@extends('layouts.master')
@section('content')
  <!-- +++ YOHANA NGAMBIL DARI BLADE EMPLOYEE LIST +++  -->
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Register Admin E-Permit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Admin Profile</a></li>
                            <li class="breadcrumb-item active">Regis Admin</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Regis Admin</a>
                        <!-- YOHANA NGULIK RUBAH ROUTE NYA  -->
                        {{-- <div class="view-icons">
                            <a href="{{ route('all/employee/regist') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('all/employee/regist') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('all/employee/list/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="employee_id">
                            <label class="focus-label">NIK</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Position</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- Yohana Ngulik  -->
            <!-- Form Table Employee  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Dept</th>
                                    <th>Mobile</th>
                                    <th>Rfid Tag</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-nowrap">Join Date</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee as $items )
                                <tr>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td class="nik_edit">{{ $items->employee_id }}</td>
                                    <td class="nameAdmin_edit">{{ $items->name }}</td>
                                    <td class="positionAdmin_edit">{{ $items->position }}</td>
                                    <td class="deptAdmin_edit">{{ $items->department }}</td>
                                    <td class="phoneNum_edit">{{ $items->phone_number }}</td>
                                    <td class="rfidTag_edit">{{ $items->rfid_tag }}</td>
                                    <td class="email_edit">{{ $items->email }}</td>
                                    <td class="role_type_edit">{{ $items->role_type }}</td>
                                    <td class="joindateAdm_edit">{{ $items->join_date }}</td>
                                    {{-- <td class="phone_number_edit">{{ $items->phone_number }}</td> --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item upd_employee" href="#" data-toggle="modal" data-target="#update_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <!-- Yohana Ngulik Nambahin Button View -->
                                                <a class="dropdown-item" href="{{ url('all/employee/view/edit/'.$items->id) }}"><i class="fa fa-eye m-r-5"></i> View</a>
                                                <a class="dropdown-item" href="{{url('all/employee/delete/'.$items->id)}}"onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Yohana Ngulik End  -->
        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Administrator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/employee/admin_reg/save') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="contoh@gmail.com">
                                        @error('name')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="select @error('department') is-invalid @enderror" name="department" id="department">
                                        <option selected disabled>-- Select Department --</option>
                                        @foreach ($deptList as $dept)
                                            <option value="{{ $dept->department }}">{{ $dept->department }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                        <input class="form-control @error('position') is-invalid @enderror" type="text" id="position" name="position">
                                        @error('position')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Join Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="join_date" name="join_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No <span class="text-danger">*</span></label>
                                        <input class="form-control @error('phone_number') is-invalid @enderror" type="text" id="phone_number" name="phone_number">
                                        @error('phone_number')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" placeholder="1234">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <select class="select @error('role_type') is-invalid @enderror" name="role_type" id="role_type">
                                            <option selected disabled>-- Select Role --</option>
                                            @foreach ($roleList as $role)
                                            <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">RFID Tag <span class="text-danger">*</span></label>
                                        <input class="form-control @error('rfid_tag') is-invalid @enderror" type="text" id="rfid_tag" name="rfid_tag">
                                        @error('rfid_tag')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->

        <!-- View Employee Modal -->
        <div id="view_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/employee/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name Test</label>
                                        <input class="form-control @error('company') is-invalid @enderror" type="text" id="company" name="company">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="Auto email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="select form-control" id="gender" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Auto id employee" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Company</label>
                                        <input class="form-control @error('company') is-invalid @enderror" type="text" id="company" name="company">
                                        @error('company')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <!-- <select class="select" id="company" name="company">
                                            <option value="">-- Select --</option>
                                            <option value="Soeng Souy">Soeng Souy</option>
                                            <option value="StarGame Kh">StarGame Kh</option>
                                        </select> -->
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Employee Modal -->
        <div id="update_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Administrator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/employee/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_edit" id="em_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name</label>
                                        <input class="form-control @error('name_edit') is-invalid @enderror" type="text" id="name_edit" name="name_edit">
                                        @error('name_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email_edit') is-invalid @enderror" type="email" id="email_edit" name="email_edit" placeholder="contoh@gmail.com">
                                        @error('email_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="select @error('department_edit') is-invalid @enderror" name="department_edit" id="department_edit">
                                        <option selected disabled>-- Select Department --</option>
                                        @foreach ($deptList as $dept)
                                            <option value="{{ $dept->department }}">{{ $dept->department }}</option>
                                        @endforeach
                                    </select>
                            </div>
                                </div>




                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                        <input class="form-control @error('position_edit') is-invalid @enderror" type="text" id="position_edit" name="position_edit">
                                        @error('position_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <!-- harusnya selection  -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Join Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="join_date_edit" name="join_date_edit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <input class="form-control @error('phone_number_edit') is-invalid @enderror" type="text" id="phone_number_edit" name="phone_number_edit">
                                        @error('phone_number_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">RFID Tag</label>
                                        <input class="form-control @error('rfid_tag_edit') is-invalid @enderror" type="text" id="rfid_tag_edit" name="rfid_tag_edit">
                                        @error('rfid_tag_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nomor Induk Karyawan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('employee_id_edit') is-invalid @enderror" id="employee_id_edit" name="employee_id_edit" placeholder="NIK" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Update Employee Modal -->


        <!-- /View Employee Modal -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    {{-- <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script> --}}
    {{-- <script>
        // select auto id and email
        $('#name').on('change',function()
        {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script> --}}

<script>
        $(document).on('click','.upd_employee',function()
        {
            var _this = $(this).parents('tr');
            $('#em_id').val(_this.find('.id').text());
            $('#name_edit').val(_this.find('.name_edit').text());
            $('#position_edit').val(_this.find('.position_edit').text());
            $('#department_edit').val(_this.find('.department_edit').text());
            $('#employee_id_edit').val(_this.find('.employee_id_edit').text());
            $('#rfid_tag_edit').val(_this.find('.rfid_tag_edit').text());
            $('#email_edit').val(_this.find('.email_edit').text());
            $('#phone_number_edit').val(_this.find('.phone_number_edit').text());
            $('#join_date_edit').val(_this.find('.join_date_edit').text());
        });
    </script>

    @endsection
@endsection
