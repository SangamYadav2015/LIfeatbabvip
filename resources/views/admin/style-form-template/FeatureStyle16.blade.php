<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
            <div class="invalid-feedback">
                Please Enter Title!
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="title1">Title 1</label>
            <input type="text" name="title1" class="form-control" id="title1" placeholder="Title 1" required>
            <div class="invalid-feedback">
                Please Enter Title 1!
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="sub_title">Sub Title</label>
            <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Sub Title" required>
            <div class="invalid-feedback">
                Please Enter Sub Title!
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="button_text">Button Text</label>
            <input type="text" name="button_text" class="form-control" id="button_text" placeholder="Button Text">

        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="button_url">Button Url</label>
            <input type="text" name="button_url" class="form-control" id="button_url" placeholder="Button Url">

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="image1">Image 1
            </label><span class="text-small text-danger">( Image size must be 1188 x 1082 px )</span>
            <input type="file" name="image1" class="form-control image-check" id="image1" required data-width="1188"
                data-height="1082">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose Image 1!
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="image1_alt_tag"> Image 1 Alt Tag</label>
            <input type="text" name="image1_alt_tag" class="form-control" id="image1_alt_tag"
                placeholder="Image 1 Alt Tag">
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="image2">Image 2
            </label><span class="text-small text-danger">( Image size must be 1222 x 965 px )</span>
            <input type="file" name="image2" class="form-control image-check" id="image2" required data-width="1222"
                data-height="965">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose Image 2!
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="image2_alt_tag"> Image 2 Alt Tag</label>
            <input type="text" name="image2_alt_tag" class="form-control" id="image2_alt_tag"
                placeholder="Image 2 Alt Tag">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label" for="description1">Description 1</label>
            <textarea name="description1" class="form-control" id="description1" placeholder="Description 1"
                required></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label" for="description2">Description 2</label>
            <textarea name="description2" class="form-control" id="description2" placeholder="Description 2"
                required></textarea>
        </div>
    </div>
</div>

<div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
    <div class="card-header">
        <h4 class="card-title">Steps
            <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add
                More</button>
        </h4>
    </div>
    <div class="card-body">
        <div id="review-sections">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="step_title">Step Title</label>
                        <input type="text" name="step_title[]" class="form-control" id="step_title"
                            placeholder="Step Title" required>
                        <div class="invalid-feedback">
                            Please Enter Step Title!
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_image">Step Image
                        </label><span class="text-small text-danger">( Image size must be 65 x 65 px )</span>
                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image"
                            data-width="65" data-height="65" required>
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                            Please Choose Step Image!
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_image_alt_tag">Step Image Alt Tag</label>
                        <input type="text" name="step_image_alt_tag[]" class="form-control" id="step_image_alt_tag"
                            placeholder="Step Image Alt Tag">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="step_title">Step Description</label>
                        <textarea name="step_description[]" class="form-control" id="step_description"
                            placeholder="Step Description" required></textarea>
                        <div class="invalid-feedback">
                            Please Enter Step Description!
                        </div>
                    </div>
                </div>
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


<script>
    $(document).ready(function () {
        var maxReviews = 2;
        var reviewIndex = 1;

        // Function to update indexes and IDs
        function updateIndexes() {
            $('.review-section').each(function (index) {
                var idx = index + 1;

            });
        }

        // Add more review sections
        $('#add-review').click(function () {
            if ($('.review-section').length < maxReviews) {
                reviewIndex++;
                var newReviewSection = `
 <div class="review-section" style="border-top: 7px solid #fff;">
         
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="step_title">Step Title</label>
                        <input type="text" name="step_title[]" class="form-control" id="step_title"
                            placeholder="Step Title" required>
                            <div class="invalid-feedback">
                                Please Enter Step Title!
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_image">Step Image
                        </label><span class="text-small text-danger">( Image size must be 65 x 65 px )</span>
                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image"
                             data-width="65" data-height="65" required>
                             <div class="img-alert"></div>
                             <div class="invalid-feedback">
                                 Please Choose Step Image!
                             </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_image_alt_tag">Step Image Alt Tag</label>
                        <input type="text" name="step_image_alt_tag[]" class="form-control" id="step_image_alt_tag"
                            placeholder="Step Image Alt Tag">
                    </div>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="step_title">Step Description</label>
                            <textarea  name="step_description[]" class="form-control" id="step_description"
                                placeholder="Step Description" required></textarea>
                                <div class="invalid-feedback">
                                    Please Enter Step Description!
                                </div>
                        </div>
                    </div>
               
     <div class="col-md-12 text-end">
         <button type="button" class="btn btn-danger remove-review">Remove</button>
     </div>
 </div>
`;

                $('#review-sections').append(newReviewSection);
                //for dynamic image change//
                $(".image-check").change(function () {
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

                })
                //for dynamic image change//

                updateIndexes();
            } else {
                $('#add-review').attr('disabled', true)
            }
        });

        // Remove review section
        $(document).on('click', '.remove-review', function () {
            $(this).closest('.review-section').remove();
            $('#add-review').attr('disabled', false)
            updateIndexes();
        });
    });

</script>