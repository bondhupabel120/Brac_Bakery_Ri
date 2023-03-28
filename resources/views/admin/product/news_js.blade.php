<script>
    function getSubCategory(value) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var category_id = value;
    $.ajax({
        url: "/admin/ajax_get_sub_category",
        type: "POST",
        data: {category_id:category_id},
        success: function (data) {
            $('.sub_category_id').html(data)
        }
    })
}

function addMultipleImage()
    {
        let sl = parseInt($("#add_multiple_image").attr('data-attr')) + 1;
        let div_item = '<input type="hidden" id="detailsbaseImage'+sl+'" name="detailsbaseImage'+sl+'">'+
                        '<input type="hidden" name="image_id[]" class="custom-control" value="" autofocus>'+
                        '<div class="row">'+
                            '<div class="col-md-6">' +
                                '<div class="custom-group">'+
                                    '<label>Image</label>' +
                                    '<input type="file" name="details_image[]" onchange="fileDetailsCrop(this)" data-sl="1" data-attr="detailsImageView'+sl+'" data-val="detailsbaseImage'+sl+'" class="image pt-1 custom-control" accept="image/*">'+
                                    '<small id="emailHelp" class="form-text text-muted">'+
                                        "File Format: *.jpg/ .png | Max file size: 3MB"+
                                    '</small>'+
                                    '<div>'+
                                        '<img class="img-thumbnail" id="detailsImageView'+sl+'" src="{{ asset('assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<div class="custom-group">'+
                                    '<label> Image Text <span class="text-danger">*</span></label>'+
                                    '<input type="text" name="image_text[]" class="custom-control" autofocus>'+
                                '</div>'+
                            '</div>' +
                            '<div class="col-md-1">' +
                                '<button class="btn mt-4 btn-danger" type="button" onclick="deleteMultipleImage(this)">'+"Delete"+'</button>'
                            '</div>'+
                        '</div>';
                        $("#add_multiple_image").append(div_item);
                        $("#add_multiple_image").attr('data-attr',sl);
    }
function addMultipleVideo()
    {
        let sl = parseInt($("#add_multiple_video").attr('data-attr')) + 1;
        let div_item = '<input type="hidden" id="videobaseImage'+sl+'" name="videobaseImage'+sl+'">'+
                        '<div class="row">'+
                            '<div class="col-md-6">'+
                                '<div class="custom-group">'+
                                    '<label> YouTube Link (Video) <span class="text-danger">*</span></label>'+
                                    '<input type="text" name="youtube_link[]" class="custom-control" autofocus>'+
                                    
                                '</div>'+
                            '</div>' +
                            '<div class="col-md-5">' +
                                '<div class="custom-group">'+
                                    '<label>Thambnail Image</label>' +
                                    '<input type="file" name="video_image[]" onchange="fileDetailsCrop(this)" data-sl="1" data-attr="videoImageView'+sl+'" data-val="videobaseImage'+sl+'" class="image pt-1 custom-control" accept="image/*">'+
                                    '<small id="emailHelp" class="form-text text-muted">'+
                                        "File Format: *.jpg/ .png | Max file size: 3MB"+
                                    '</small>'+
                                    '<div>'+
                                        '<img class="img-thumbnail" id="videoImageView'+sl+'" src="{{ asset('assets/backend/img/no_image_found.png') }}" style="height: 70px; width: 120px;" />'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<input type="hidden" name="youtube_link_id[]" class="custom-control" value="" autofocus>'+
                            // '<div class="col-md-5">'+
                            //     '<div class="custom-group">'+
                            //         '<label> Video Text <span class="text-danger">*</span></label>'+
                            //         '<input type="text" name="video_text[]" class="custom-control" autofocus>'+
                            //     '</div>'+
                            // '</div>' +
                            '<div class="col-md-1">' +
                                '<button class="btn mt-4 btn-danger" type="button" onclick="deleteMultipleVideo(this)">'+"Delete"+'</button>'
                            '</div>'+
                        '</div>';
                        $("#add_multiple_video").append(div_item);
                        $("#add_multiple_video").attr('data-attr',sl);
    }
    function deleteMultipleImage(data) {
        $(data).parent().parent().remove();
    }
    function deleteMultipleVideo(data) {
        $(data).parent().parent().remove();
    }
    function fileDetailsCrop(data)
    {
        let name = $(data).attr('data-val');
        let name_view = $(data).attr('data-attr');
        $("#crop").attr('name',name)
        $("#crop").val(name_view)
    }

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            dragMode: 'move',
            restore: false,
            guides: true,
            center: false,
            highlight: false,
            mouseWheelZoom: true,
            touchDragZomm: true,
            dragCrop: true,
            cropBoxMovable: true,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,

            data: { //define cropbox size

                width: 800,
                height: 400,
                type: 'rectangle'
            },
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });
    $("#crop").click(function() {
        let baseImage = $(this).attr('name')
        let baseView = $(this).val();
        canvas = cropper.getCroppedCanvas({
            width: 800,
            height: 400,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                console.log("base64 data", base64data,baseImage,baseView)
                // document.getElementById(baseImage).value = base64data;
                // document.getElementById(baseView).src = base64data;
                $('#'+baseImage).val(base64data)
                $('#'+baseView).attr('src',base64data)
                $modal.modal('hide');
            }
        });
    })

    function fileDetailsCrop(data)
    {
        let name = $(data).attr('data-val');
        let name_view = $(data).attr('data-attr');
        $("#crop").attr('name',name)
        $("#crop").val(name_view)
    }
</script>
