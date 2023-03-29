@extends('admin.master')

@section('title')
    Add Product | {{ $appName }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/toastr/toastr.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @include('admin.partials.error_message')
            @include('admin.partials.success_message')
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Add Product</h3>
                            <div class="fa-pull-right">
                                <a href="{{ route('product.index') }}">
                                    <button class="btn btn-info"><i class="fa fa-arrow-left"></i><b> Back To Product List</b></button>
                                </a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                            <select name="category_id" class="form-control" style="width: 100%">
                                                <option value="" selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="d-block">
                                                <a class="ml-2" target="_blank" href="{{route('category.create')}}"><i class="fa fa-plus"></i></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="custom-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Product Price <span class="text-danger">*</span></label>
                                            <input type="number" name="price" step="0.001" class="custom-control {{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Product Sale Price <span class="text-danger">*</span></label>
                                            <input type="text" name="sale_price" step="0.001" class="custom-control {{ $errors->has('sale_price') ? ' is-invalid' : '' }}" value="{{ old('sale_price') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Quantity <span class="text-danger">*</span></label>
                                            <input type="text" name="quantity" step="0.001" class="custom-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Main Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" onchange="imageUpload(this)" data-sl="1" data-attr="detailsImageView" data-val="baseImage" id="details_image" class="image pt-1 custom-control" accept="image/*">
                                            <small id="emailHelp" class="form-text text-muted">
                                                File Format: *.jpg/ .png | Max file size: 3MB
                                            </small>
                                            <div>
                                                <img class="img-thumbnail" id="details_image_preview" src="{{ asset('assets/admin/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Gallery Image 1 <span class="text-danger">*</span></label>
                                            <input type="file" name="image1" onchange="imageUpload(this)" data-sl="1" data-attr="detailsImageView" data-val="baseImage" id="details_image1" class="image pt-1 custom-control" accept="image/*">
                                            <small id="emailHelp" class="form-text text-muted">
                                                File Format: *.jpg/ .png | Max file size: 3MB
                                            </small>
                                            <div>
                                                <img class="img-thumbnail" id="details_image1_preview" src="{{ asset('assets/admin/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Gallery Image 2 <span class="text-danger">*</span></label>
                                            <input type="file" name="image2" onchange="imageUpload(this)" data-sl="1" data-attr="detailsImageView" data-val="baseImage" id="details_image2" class="image pt-1 custom-control" accept="image/*">
                                            <small id="emailHelp" class="form-text text-muted">
                                                File Format: *.jpg/ .png | Max file size: 3MB
                                            </small>
                                            <div>
                                                <img class="img-thumbnail" id="details_image2_preview" src="{{ asset('assets/admin/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-12">
                                        <div class="custom-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="editor" cols="59" rows="5" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" autofocus>{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Status <span class='required-star'></span></label>
                                            <select name="status" class="custom-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('product.index') }}">
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
</section>
<style>
    .btn {
        cursor: pointer;
    }
    .project #progressbar li {
        width: 14% !important;
    }
</style>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/toastr/toastr.js') }}"></script>
    @include('admin.partials.notifications')
    <script src="{{ asset('assets/common/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @include('admin.partials.ckeditor_js')
    @include('admin.product.product_js')
@endsection
