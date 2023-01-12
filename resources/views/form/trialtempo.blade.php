<!-- MINDAHIN VERIFY EMPLOYEE BLADE  -->
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
                        <h3 class="page-title">Verify Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Regis Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <!-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Button Verif</a> -->
                        <!-- YOHANA NGULIK RUBAH ROUTE NYA  -->
                        <div class="view-icons">
                            <a href="{{ route('all/employee/verify') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('all/employee/verify') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- Yohana Ngulik  -->
            <!-- Account Form -->
            <form method="POST" action="{{ route('all/employee/verify') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="name" value="{{ old('phone_number') }}" placeholder="Enter Mobile Phone Number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                                    <label class="col-form-label">Department</label>
                                    <select class="select @error('department') is-invalid @enderror" name="department" id="department">
                                        <option selected disabled>-- Select Department --</option>
                                        @foreach ($dept as $name)
                                            <option value="{{ $name->department }}">{{ $name->department }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                        </div>
                </div>
                <!-- Button Save Verify  -->
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" type="submit">Register</button>
                </div>
            </form>
            <!-- /Account Form -->
            <!-- Yohana Ngulik End  -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
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
    </script>
    <script>
        // select auto id and email
        $('#name').on('change',function()
        {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
    @endsection
@endsection