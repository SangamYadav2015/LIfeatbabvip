<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                required>
                            <div class="invalid-feedback">
                                Please Enter Title!
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="banner_image"> Image 1
                            </label><span class="text-small text-danger">( Image size must be 596 x 643 px )</span>
                            <input type="file" name="banner_image" class="form-control image-check" id="banner_image"
                                required data-width="596" data-height="643">
                            <div class="img-alert"></div>
                            <div class="invalid-feedback">
                                Please Choose Image!
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="banner_image1_alt_tag">Image 1 Alt Tag</label>
                            <input type="text" class="form-control" id="banner_image1_alt_tag" name="banner_image1_alt_tag" placeholder="Image 1 Alt Tag">
                        </div>
                   </div>
                   </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="banner_image1"> Image 2
                            </label><span class="text-small text-danger">( Image size must be 374 x 375 px )</span>
                            <input type="file" name="banner_image1" class="form-control image-check" id="banner_image1"
                                required data-width="374" data-height="375">
                            <div class="img-alert"></div>
                            <div class="invalid-feedback">
                                Please Choose Image Icon!
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="banner_image2_alt_tag">Image 2 Alt Tag</label>
                            <input type="text" class="form-control" id="banner_image2_alt_tag" name="banner_image2_alt_tag" placeholder="Image 2 Alt Tag">
                        </div>
                   </div>
                </div>
              
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" name="description"
                                placeholder="Description" rows="2" required></textarea>
                            <div class="invalid-feedback">
                                Please Enter Description!
                            </div>
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="service_title">Step Title</label>
                                        <input type="text" name="card_title[]" class="form-control" id="step_title"
                                            placeholder="Step Title" required>
                                        <div class="invalid-feedback">
                                            Please provide a Step Title!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="step_image"> Step Icon
                                        </label><span class="text-small text-danger">( Image size must be 65 x 65 px )</span>
                                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image"
                                            required data-width="65" data-height="65">
                                        <div class="img-alert"></div>
                                        <div class="invalid-feedback">
                                            Please Choose Step Icon!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="image_icon_alt_tag">Step Icon ALT Tag</label>
                                        <input type="text" name="image_icon_alt_tag[]" class="form-control" id="image_icon_alt_tag"
                                            placeholder="Step Title">

                                    </div>
                                </div>
                            </div>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="step_description">Step Description</label>
                                    <textarea name="step_description[]" class="form-control" id="step_description"
                                        placeholder="Step Description"></textarea>

                                </div>
                            </div>
                        </div>



                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        var maxReviews = 1;
                        var reviewIndex = 1;

                        // Function to update indexes and IDs
                        function updateIndexes() {
                            $('.review-section').each(function (index) {
                                var idx = index + 1;
                                $(this).find('.service-title').attr('id', 'service_title_' + idx);
                                $(this).find('.service-title').attr('name', 'service_title[]');
                                $(this).find('.service-image-icon').attr('id', 'service_image_icon_' + idx);
                                $(this).find('.service-image-icon').attr('name', 'service_image_icon[]');
                                $(this).find('.service-description').attr('id', 'service_description_' + idx);
                                $(this).find('.service-description').attr('name', 'service_description[]');
                            });
                        }

                        // Add more review sections
                        $('#add-review').click(function () {
                            if ($('.review-section').length < maxReviews) {
                                reviewIndex++;
                                var newReviewSection = `
                 <div class="review-section" style="border-top: 7px solid #fff;">
                         <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_title${reviewIndex}">Step Title</label>
                                                    <input type="text" name="card_title[]" class="form-control" id="step_title${reviewIndex}" placeholder="Step Title">
                                                    <div class="invalid-feedback">
                                                        Please provide a Step Title!
                                                    </div>
                                                 </div>
                                            </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="step_image"${reviewIndex}> Step Icon
                                        </label><span class="text-small text-danger">( Image size must be 65 x 65 px )</span>
                                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image${reviewIndex}"
                                            required data-width="65" data-height="65">
                                        <div class="img-alert"></div>
                                        <div class="invalid-feedback">
                                            Please Choose Step Icon!
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="image_icon_alt_tag">Step Icon ALT Tag</label>
                                        <input type="text" name="image_icon_alt_tag[]" class="form-control" id="image_icon_alt_tag"
                                            placeholder="Step Title">

                                    </div>
                                </div>
                                        </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="step_description">Step Description</label>
                                    <textarea name="step_description[]" class="form-control" id="step_description"
                                        placeholder="Step Description"></textarea>

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