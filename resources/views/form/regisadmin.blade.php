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
                            <li class="breadcrumb-item"><a href="#">Admin Profile</a></li>
                            <li class="breadcrumb-item active">Regis Admin</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Regis Admin</a>
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
                    {{-- <div class="col-sm-6 col-md-3">
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
                    </div> --}}
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
                                    <td class="employeeid_edit">{{ $items->employee_id }}</td>
                                    <td class="nameAdmin_edit">{{ $items->name }}</td>
                                    <td class="positionAdmin_edit">{{ $items->position }}</td>
                                    <td class="deptAdmin_edit">{{ $items->department }}</td>
                                    <td class="phoneNum_edit">{{ $items->phone_number }}</td>
                                    <td class="rfidTag_edit">{{ $items->rfid_tag }}</td>
                                    <td class="emailAdmin_edit">{{ $items->email }}</td>
                                    <td class="role_type_edit">{{ $items->role_type }}</td>
                                    <td class="joindateAdm_edit">{{ $items->join_date }}</td>
                                    {{-- <td class="phone_number_edit">{{ $items->phone_number }}</td> --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item upd_admin" href="#" data-toggle="modal" data-target="#update_admin"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                {{-- <a class="dropdown-item view_admin" data-toggle="modal" data-target="view_admin" href="#"><i class="fa fa-eye m-r-5"></i> View</a> --}}
                                                <a class="dropdown-item" data-toggle="modal" data-target="#delete_admin" href="{{url('all/employee/admin/delete/'.$items->id)}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

        <!-- Add Admin Modal -->
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

        <!-- View Admin Modal -->
        {{-- <div id="view_admin" class="modal custom-modal fade" role="dialog">
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
        </div> --}}

        <!-- Update Admin Modal -->
        <div id="update_admin" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Administrator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/employee/admin/update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_edit" id="editAdmin_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input class="form-control @error('nameAdmin_editame') is-invalid @enderror" type="text" id="nameAdmin_edit" name="nameAdmin_edit" autofocus>
                                        @error('nameAdmin_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('emailAdmin_edit') is-invalid @enderror" type="email" id="emailAdmin_edit" name="emailAdmin_edit">
                                        @error('emailAdmin_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="select @error('deptAdmin_edit') is-invalid @enderror" name="deptAdmin_edit" id="deptAdmin_edit">
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
                                        <input class="form-control @error('positionAdmin_edit') is-invalid @enderror" type="text" id="positionAdmin_edit" name="positionAdmin_edit">
                                        @error('positionAdmin_edit')
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
                                            <input class="form-control datetimepicker" type="text" id="joindateAdm_edit" name="joindateAdm_edit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No <span class="text-danger">*</span></label>
                                        <input class="form-control @error('phoneNum_edit') is-invalid @enderror" type="text" id="phoneNum_edit" name="phoneNum_edit">
                                        @error('phoneNum_edit')
                                            <span class="invalid-feedback" roler="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('employeeid_edit') is-invalid @enderror" id="employeeid_edit" name="employeeid_edit" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <select class="select @error('role_type_edit') is-invalid @enderror" name="role_type_edit" id="role_type_edit">
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
                                        <input class="form-control @error('rfidTag_edit') is-invalid @enderror" type="text" id="rfidTag_edit" name="rfidTag_edit">
                                        @error('rfidTag_edit')
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
        <!-- /Update Employee Modal -->

        <!-- Delete Admin Modal -->
        {{-- <div class="modal custom-modal fade" id="delete_admin" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Admin</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{url('all/employee/admin/delete/'.$items->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
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
        </div> --}}
        <!-- /Delete Admin Modal -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $(document).on('click','.upd_admin',function()
        {
            var _this = $(this).parents('tr');
            $('#editAdmin_id').val(_this.find('.id').text());
            $('#nameAdmin_edit').val(_this.find('.nameAdmin_edit').text());
            $('#emailAdmin_edit').val(_this.find('.emailAdmin_edit').text());
            $('#deptAdmin_edit').val(_this.find('.deptAdmin_edit').text());
            $('#positionAdmin_edit').val(_this.find('.positionAdmin_edit').text());
            $('#joindateAdm_edit').val(_this.find('.joindateAdm_edit').text());
            $('#phoneNum_edit').val(_this.find('.phoneNum_edit').text());
            $('#employeeid_edit').val(_this.find('.employeeid_edit').text());
            $('#role_type_edit').val(_this.find('.role_type_edit').text());
            $('#rfidTag_edit').val(_this.find('.rfidTag_edit').text());
        });

        $(document).on('click','.view_admin',function()
        {
            var _this = $(this).parents('tr');
            $('#editAdmin_id').val(_this.find('.id').text());
            $('#nameAdmin_edit').val(_this.find('.nameAdmin_edit').text());
            $('#emailAdmin_edit').val(_this.find('.emailAdmin_edit').text());
            $('#deptAdmin_edit').val(_this.find('.deptAdmin_edit').text());
            $('#positionAdmin_edit').val(_this.find('.positionAdmin_edit').text());
            $('#joindateAdm_edit').val(_this.find('.joindateAdm_edit').text());
            $('#phoneNum_edit').val(_this.find('.phoneNum_edit').text());
            $('#employeeid_edit').val(_this.find('.employeeid_edit').text());
            $('#role_type_edit').val(_this.find('.role_type_edit').text());
            $('#rfidTag_edit').val(_this.find('.rfidTag_edit').text());
        });
    </script>

    @endsection
@endsection
