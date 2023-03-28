<script src="{{ asset('assets/common/cropper/cropper.js') }}"></script>
<script>
    var $modal = $('#modal');
    var $modal1 = $('#cerimagemodal');
    var image = document.getElementById('image');
    var image1 = document.getElementById('cer_image');
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
    $("body").on("change", ".cer_image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image1.src = url;
            $modal1.modal('show');
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

                width: 300,
                height: 300,
                type: 'rectangle'
            },
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });
    $modal1.on('shown.bs.modal', function() {
        cropper = new Cropper(image1, {
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

                width: 500,
                height: 300,
                type: 'rectangle'
            },
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });
    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 300,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                document.getElementById("baseImage").value = base64data;
                document.getElementById("ImageView").src = base64data;
                $modal.modal('hide');
            }
        });
    })
    $("#cer_crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 300,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                document.getElementById("baseImage1").value = base64data;
                document.getElementById("cerImageView").src = base64data;
                $modal1.modal('hide');
            }
        });
    })
</script>
