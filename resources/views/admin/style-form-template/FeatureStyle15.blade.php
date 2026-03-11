<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title"  required>
             <div class="invalid-feedback">
                Please Enter Title!
            </div>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="title1">Title 1</label>
            <input type="text" name="title1" class="form-control" id="title1" placeholder="Title 1"  required>
             <div class="invalid-feedback">
                Please Enter Title 1!
            </div>   
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="sub_title">Sub Title</label>
            <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Sub Title"  required>
             <div class="invalid-feedback">
                Please Enter Sub Title!
            </div>   
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="link_text">Link Text</label>
                <input type="text" name="link_text" class="form-control" id="link_text" placeholder="Link Text"  required>
                 <div class="invalid-feedback">
                    Please Enter Link Text!
                </div>   
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="link_url">Link Url</label>
                <input type="text" name="link_url" class="form-control" id="link_url" placeholder="Link Url"  required>
                 <div class="invalid-feedback">
                    Please Enter Link Url!
                </div>   
            </div>
        </div>
      </div>

    <div class="row">
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_image">Main Image
            </label><span class="text-small text-danger">( Image size must be 862 x 736 px )</span>
            <input type="file" name="banner_image" class="form-control image-check" id="banner_image"
                required data-width="862" data-height="736">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose Main Image!
            </div>
        </div>
    </div>   
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="sub_title">Main Image Alt Tag</label>
            <input type="text" name="banner_image_alt_tag" class="form-control" id="banner_image_alt_tag" placeholder="Main Image Alt Tag">
        </div>
    </div>
</div>



<div class="row">
<div class="col-md-12">
    <div class="mb-3">
        <label class="form-label" for="description1">Description</label>
        <textarea name="description" class="form-control" id="description" placeholder="Description" required></textarea>
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