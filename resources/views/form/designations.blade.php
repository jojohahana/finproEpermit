@extends('layouts.master')
@section('content')
  
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Sub Department</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sub Department</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_subdept"><i class="fa fa-plus"></i> Add Sub Dept  </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th>Sub Department </th>
                                    <th>Department </th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($subdept))
                                    @foreach ($subdept as $key=>$items)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td class="subdept_name">{{ $items->subdept_name }}</td>
                                        <td class="department">{{ $items->department }}</td>
                                        <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item edit_subdept" data-toggle="modal" data-target="#edit_subdept"><i class="fa fa-pencil m-r-5"> Edit</i></a>
                                                <a href="#" class="dropdown-item delete_subdept" data-toggle="modal" data-target="#delete_subdept"><i class="fa fa-trash-o m-r-5"> Delete</i></a>
                                            </div>
                                        </div>
                                        </td>
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

        <!-- Add Designation Modal -->
        <div id="add_subdept" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Sub Dept</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/designations/save') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Sub Department Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('subdept') is-invalid @enderror" type="text" id="subdept" name="subdept" value="{{ old('subdept') }}" placeholder="Enter Sub Dept">
                                <!-- @error('subdept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select class="select @error('department') is-invalid @enderror" name="department" id="department">
                                        <option selected disabled>-- Select Department --</option>
                                        @foreach ($deptList as $dept)
                                            <option value="{{ $dept->department }}">{{ $dept->department }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Designation Modal -->
        
        <!-- Edit Designation Modal -->
        <div id="edit_subdept" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Sub Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('form/designations/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_edit" id="e_id" value="">
                            <div class="form-group">
                                <label>Sub Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="subdept_edit" name="subdept_name_edit" value="" type="text">
                            </div>
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select class="select" id="select_dept" name="select_dept">
                                    <option>--Select Department--</option>
                                    @foreach ($deptList as $dept)
                                        <option value="{{ $dept->department }}">{{ $dept->department}}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Designation Modal -->
        
        <!-- Delete Designation Modal -->
        <div class="modal custom-modal fade" id="delete_subdept" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Sub Department</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            
                        <form action="{{ route('form/designations/delete') }}" method="POST">
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
        </div>
        <!-- /Delete Designation Modal -->
    
    </div>
    <!-- /Page Wrapper -->

    @section('script')
    <script>
        $(document).on('click','.edit_subdept',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#subdept_edit').val(_this.find('.subdept_name').text());
        });
    </script>

    <script>
        $(document).on('click','.delete_subdept',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
