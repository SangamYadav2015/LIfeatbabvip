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
            <label class="form-label" for="sub_title1">Sub Title  1</label>
            <input type="text" name="sub_title1" class="form-control" id="sub_title1" placeholder="Sub Title  1"  required>
             <div class="invalid-feedback">
                Please Enter Sub Title 1!
            </div>   
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="sub_title2">Sub Title  2</label>
            <input type="text" name="sub_title2" class="form-control" id="sub_title2" placeholder="Sub Title 2"  required>
             <div class="invalid-feedback">
                Please Enter Sub Title 2!
            </div>   
        </div>
    </div>

    </div>

    <div class="row">
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_image">Main Image
            </label><span class="text-small text-danger">( Image size must be 511 x 511 px )</span>
            <input type="file" name="banner_image" class="form-control image-check" id="banner_image"
                required data-width="511" data-height="511">
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
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="button_text">Button Text</label>
            <input type="text" name="button_text" class="form-control" id="button_text" placeholder="Button Text" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="sub_title">Button Url</label>
            <input type="text" name="button_url" class="form-control" id="button_url" placeholder="Button Url">
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-12">
    <div class="mb-3">
        <label class="form-label" for="description1">Description 1</label>
        <textarea name="description1" class="form-control" id="description1" placeholder="Description 1" required></textarea>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label" for="description2">Description 2</label>
            <textarea name="description2" class="form-control" id="description2" placeholder="Description 2" required></textarea>
        </div>
    </div>
</div>


<div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
    <div class="card-header">
        <h4 class="card-title">Steps
            <button class="btn btn-danger float-right" style="float: right;" type="button"
                id="add-review">+ Add More</button>
        </h4>
    </div>
    <div class="card-body">
        <div id="review-sections">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="service_title">Step Title</label>
                        <input type="text" name="step_title[]" class="form-control" id="step_title"
                            placeholder="Step Title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_sub_title">Step Sub Title</label>
                        <input type="text" name="step_sub_title[]" class="form-control" id="step_sub_title"
                            placeholder="Step Sub Title">
                        
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="service_title${reviewIndex}">Step Title</label>
                                    <input type="text" name="step_title[]" class="form-control" id="step_title${reviewIndex}" placeholder="Step Title">
                                    <div class="invalid-feedback">
                                        Please provide a Step Title!
                                    </div>
                                 </div>
                            </div>
                     <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="step_sub_title">Step Sub Title</label>
                        <input type="text" name="step_sub_title[]" class="form-control" id="step_sub_title"
                            placeholder="Step Sub Title">
                        
                    </div>
                </div>
                        </div>
     <div class="col-md-12 text-end">
         <button type="button" class="btn btn-danger remove-review">Remove</button>
     </div>
 </div>
`;
                $('#review-sections').append(newReviewSection);

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