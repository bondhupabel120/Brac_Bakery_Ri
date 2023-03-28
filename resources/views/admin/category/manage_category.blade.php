@extends('admin.master')

@section('title')
    Manage News | {{ $appName }}
@endsection

@section('css')
    @include('admin.partials.datatable_css')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @include('admin.partials.error_message')
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="fa-pull-left">
                                <h3 class="card-title">
                                    <i class="fas fa-list"></i> Manage Category
                                </h3>
                            </div>
                            <div class="fa-pull-right">
                                <a href="{{ route('category.create') }}">
                                    <button class="btn btn-info"><i class="fa fa-plus"></i><b> Add Category</b></button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="list" class="table dt-responsive table-bordered table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Category Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    @include('admin.partials.datatable_js')
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <script src="{{ asset('assets/common/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        function showNews(){
            $('#list').DataTable({
               bAutoWidth: false,
               processing: true,
               serverSide: true,
               iDisplayLength: 10,
               ajax: {
                   url: "/admin/get_categories",
                   method: "POST",
                   data: function (d) {
                       d._token = $('input[name="_token"]').val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'name', name: 'name'},
                   {data: 'des', name: 'des'},
                   {data: 'status', name: 'status'},
                   {data: 'action', name: 'action', orderable: false, searchable: false},
               ],
               "aaSorting": []
           });
        }

        showNews();

        function deleteCategory(id, e) {
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "You want to delete this Category!",
                icon: "warning",
                showCloseButton: true,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Delete`,
                // dangerMode: true,
            }).then((result) => {
                if (result.value == true) {
                    swal.fire({
                        title: 'Success',
                        text: 'Category is Deleted Successfully!',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                        $.ajax({
                            url: "/admin/category",
                            method: "DELETE",
                            data: {
                                id: id,
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: 'json',
                            success: function() {
                                location.reload();
                            }
                        })
                    })
                } else if (result.value == false) {
                    swal.fire("Cancelled", "News Category is safe :)", "error");
                }
            })
        }
    </script>
@endsection
