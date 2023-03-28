@extends('admin.master')

@section('title')
    Update Category | {{ $appName }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/toastr/toastr.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @include('admin.partials.error_message')
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Update Category</h3>
                            <div class="fa-pull-right">
                                <a href="{{ route('category.index') }}">
                                    <button class="btn btn-info"><i class="fa fa-arrow-left"></i><b> Back To Category List</b></button>
                                </a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('category.update',['category'=>$category->id]) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $category->name }}" autofocus>
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                            <input type="hidden" name="_method" value="PUT">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Status <span class='required-star'></span></label>
                                            <select name="status" class="custom-control">
                                                <option value="1" @if ($category->status == 1) selected @endif>Active</option>
                                                <option value="0" @if ($category->status == 2) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category Description <span class="text-danger">*</span></label>
                                            <textarea name="des" id="editor" cols="59" rows="5" class="form-control {{ $errors->has('des') ? ' is-invalid' : '' }}" autofocus>{{ $category->des }}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('category.index') }}">
                                    <button type="button" class="btn btn-danger">Close</button>
                                </a>
                                <button type="submit" class="btn btn-info float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/toastr/toastr.js') }}"></script>
    @include('admin.partials.ckeditor_js')
@endsection
