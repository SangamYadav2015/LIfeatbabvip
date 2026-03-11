<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title"  required>
             <div class="invalid-feedback">
                Please Enter Video Url!
            </div>   
        </div>
    </div>
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_bg_image">BG Image
            </label><span class="text-small text-danger">( Image size must be 1920 x 450 px )</span>
            <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image"
                required data-width="1920" data-height="450">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose BG Image!
            </div>
        </div>
    </div>   
</div>




<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="icon_1_url">Icon 1 Url</label>
            <input type="text" name="icon_1_url" class="form-control" id="icon_1_url" placeholder="Icon 1 Url"  required>
             <div class="invalid-feedback">
                Please Enter Icon 1 Url!
            </div>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="icon_2_url">Icon 2 Url</label>
            <input type="text" name="icon_2_url" class="form-control" id="icon_2_url" placeholder="Icon 2 Url"  required>
             <div class="invalid-feedback">
                Please Enter Icon 2 Url!
            </div>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="icon_3_url">Icon 3 Url</label>
            <input type="text" name="icon_3_url" class="form-control" id="icon_3_url" placeholder="Icon 3 Url"  required>
             <div class="invalid-feedback">
                Please Enter Icon 3 Url!
            </div>   
        </div>
    </div>
</div>
    




<script>
    $(document).ready(function () {
        $('.image-check').on('change', function () {
            var fileInput = this;
            var $parentDiv = $(fileInput).closest('.mb-3'); // Find the closest parent div

            if (fileInput.files && fileInput.files[0]) {
                var img = new Image();
                var file = fileInput.files[0];

                var imgFixWidth = parseInt($(fileInput).attr('data-width'));
                var imgFixHeight = parseInt($(fileInput).attr('data-height'));
                var objectUrl = URL.createObjectURL(file);

                img.onload = function () {
                    var width = this.width;
                    var height = this.height;

                    if (width === imgFixWidth && height === imgFixHeight) {
                        $parentDiv.find(".img-alert").html('<span class="text-success">Image dimensions are correct.</span>');
                    } else {
                        $parentDiv.find(".img-alert").html('<span class="text-danger">Image dimensions are not correct.</span>');
                        fileInput.value = '';
                    }

                    URL.revokeObjectURL(objectUrl);
                };

                img.src = objectUrl;
            }
        });
    });
</script>