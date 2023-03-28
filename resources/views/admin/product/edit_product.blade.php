@extends('backend.master')

@section('title')
    Update News | {{ $appName }}
@endsection

@section('css')
    @include('backend.partials.crop_image_css')
    @include('backend.partials.select2_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/toastr/toastr.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @include('frontend.partials.error_message')
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Update News</h3>
                            <div class="fa-pull-right">
                                <a href="{{ route('manage.news') }}">
                                    <button class="btn btn-info"><i class="fa fa-arrow-left"></i><b> Back To News List</b></button>
                                </a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('update.news') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control select2" onchange="getSubCategory(this.value)" style="width: 100%">
                                                <option value="">Select Category</option>
                                                @foreach ($service_categories as $service_category)
                                                    <option @if($service_category->id == $news->category_id) selected @endif value="{{ $service_category->id }}">{{ $service_category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Sub Category (Optional)</label>
                                            <div class="d-flex">
                                            <select name="subcategory_id" class="form-control select2 sub_category_id" style="width: 100%">
                                                <option value="" selected>Select Sub Category</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" @if($subcategory->id == $news->subcategory_id) selected @endif>{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="d-block">
                                                <a class="ml-2" target="_blank" href="{{route('add.news_subcategory')}}"><i class="fa fa-plus"></i></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $news->title }}" autofocus>
                                            <input type="hidden" name="id" value="{{ $news->id }}">
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="baseImage" name="baseImage" value="" />
                                    <div class="col-md-6">
                                        <div class="custom-group">
                                            <label>Main Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" onchange="fileDetailsCrop(this)" data-sl="1" data-attr="detailsImageView" data-val="baseImage" id="details_image" class="image pt-1 custom-control" accept="image/*">
                                            <small id="emailHelp" class="form-text text-muted">
                                                File Format: *.jpg/ .png | Max file size: 3MB
                                            </small>
                                            <div>
                                                <img class="img-thumbnail" id="detailsImageView" src="{{ asset($news->image ? $news->image : 'assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border">
                                        <div class="card-body">
                                            <div class="row margin-left-auto">
                                                <div class="float-right py-2 d-block">
                                                    <button class="btn btn-sm custom-btn" type="button" onclick="addMultipleImage()"> + Add More Image</button>
                                                </div>
                                            </div>
                                            <div id="add_multiple_image" data-attr="0">
                                                @if ($news->news_images)
                                                    @foreach ($news->news_images as $key => $news_image)
                                                        <div class="row">
                                                            <input type="hidden" id="detailsbaseImage{{ $key }}" name="detailsbaseImage{{ $key }}" value="" />
                                                            <input type="hidden" name="image_id[]" value="{{ $news_image->id }}" />
                                                            <div class="col-md-6">
                                                                <div class="custom-group">
                                                                    <label>Image</label>
                                                                    <input type="file" name="details_image[]" onchange="fileDetailsCrop(this)" data-sl="1" data-attr="detailsImageView{{ $key }}" data-val="detailsbaseImage{{ $key }}" id="details_image" class="image pt-1 custom-control" accept="image/*">
                                                                    <small id="emailHelp" class="form-text text-muted">
                                                                        File Format: *.jpg/ .png | Max file size: 3MB
                                                                    </small>
                                                                    <div>
                                                                        <img class="img-thumbnail" id="detailsImageView{{ $key }}" src="{{ asset($news_image->image ? $news_image->image :'assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="custom-group">
                                                                    <label>Image Text <span class="text-danger">*</span></label>
                                                                    <input type="text" name="image_text[]" value="{{ $news_image->image_text }}" class="custom-control" autofocus>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button class="btn mt-4 btn-danger" type="button" onclick="deleteMultipleImage(this)">Delete</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border">
                                        <div class="card-body">
                                            <div class="row margin-left-auto">
                                                <div class="float-right py-2 d-block">
                                                    <button class="btn btn-sm custom-btn" type="button" onclick="addMultipleVideo()"> + Add More Video</button>
                                                </div>
                                            </div>
                                            <div id="add_multiple_video" data-attr="{{$news->news_videos ? $news->news_videos->count() : 0}}">
                                                @if ($news->news_videos)
                                                    @foreach ($news->news_videos as $key => $news_video)
                                                        <div class="row">
                                                            <input type="hidden" name="youtube_link_id[]" value="{{ $news_video->id }}">
                                                            <div class="col-md-6">
                                                                <div class="custom-group">
                                                                    <label>YouTube Link (Video)</label>
                                                                    <input type="text" name="youtube_link[]" value="{{ $news_video->youtube_link }}" class="custom-control" autofocus>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="videobaseImage{{ $key }}" name="videobaseImage{{ $key }}" value="" />
                                                            <div class="col-md-5">
                                                                <div class="custom-group">
                                                                    <label>Thaimbnail Image</label>
                                                                    <input type="file" name="video_image[]" onchange="fileDetailsCrop(this)" data-sl="1" data-attr="videoImageView{{ $key }}" data-val="videobaseImage{{ $key }}" class="image pt-1 custom-control" accept="image/*">
                                                                    <small id="emailHelp" class="form-text text-muted">
                                                                        File Format: *.jpg/ .png | Max file size: 3MB
                                                                    </small>
                                                                    <div>
                                                                        <img class="img-thumbnail" id="videoImageView{{ $key }}" src="{{ asset($news_video->image ? $news_video->image :'assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-5">
                                                                <div class="custom-group">
                                                                    <label>Video Text </label>
                                                                    <input type="text" name="video_text[]" value="{{ $news_video->video_text }}" class="custom-control" autofocus>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-1">
                                                                <button class="btn mt-4 btn-danger" type="button" onclick="deleteMultipleVideo(this)">Delete</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" class="form-control" id="baseImage" name="baseImage" value="" />
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="image form-control" accept="image/*">
                                            <small id="emailHelp" class="form-text text-muted">
                                                File Format: *.jpg/ .png | Max file size: 3MB
                                            </small>
                                            <div>
                                                <a href="{{ asset($news->image) }}" target="_blank">
                                                    <img class="img-thumbnail" id="ImageView" src="{{ asset($news->image ? $news->image : 'assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 100px;" />
                                                </a>
                                            </div>
                                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                                aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Please Ensure the Image First
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="img-container">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="preview"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="des" id="editor" cols="59" rows="5" class="form-control {{ $errors->has('des') ? ' is-invalid' : '' }}" autofocus>{{ $news->des }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status <span class='required-star'></span></label>
                                            <select name="status" class="form-control">
                                                <option value="1" @if ($news->status == 1) selected @endif>Active</option>
                                                <option value="0" @if ($news->status == 2) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('manage.news') }}">
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
    <div class="modal fade" id="modal" onchange="getCropper()" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Please Ensure the Image First
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" name="baseImage" value="ImageView" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('assets/backend/toastr/toastr.js') }}"></script>
    @include('backend.partials.notifications')
    @include('backend.partials.select2_js')
    @include('backend.partials.ckeditor_js')
    @include('backend.news.news_js')
    <script src="{{ asset('assets/common/cropper/cropper.js') }}"></script>
@endsection
