<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title">Banner Title </label>
                                                    <input type="text" name="banner_title" class="form-control"
                                                        id="banner_title" placeholder="Banner Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Title!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                    <input type="text" name="highlighted_title" class="form-control"
                                                        id="highlighted_title" placeholder="Highlighted Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Highlighted Title!
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="bottom_title">Bottom Title</label>
                                                    <input type="text" name="bottom_title" class="form-control"
                                                        id="bottom_title" placeholder="Bottom Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Bottom Title!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="bottom_highlighted_title">Bottom Highlighted Title</label>
                                                    <input type="text" name="bottom_highlighted_title" class="form-control"
                                                        id="bottom_highlighted_title" placeholder="Bottom Highlighted Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Bottom Highlighted Title!
                                                    </div>
                                                </div>
                                            </div>

                                        </div>





                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button Text</label>
                                                    <input type="text" name="button_text" class="form-control"
                                                        id="button_text" placeholder="Button Text" value="">
                                                    <div class="invalid-feedback">
                                                        Please Enter Button Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button URL</label>
                                                    <input type="text" class="form-control" id="button_url"
                                                        name="button_url" placeholder="Button URL">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_description">Banner
                                                        Description</label>
                                                    <textarea type="text" class="form-control" id="banner_description"
                                                        name="banner_description" placeholder="Banner Description"
                                                        required=""></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Description!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card  bg-gradient"
                                            style="background-color: rgb(220 221 225) !important;">
                                            <div class="card-header">
                                                <h4 class="card-title">Banner Step
                                                    <button class="btn btn-danger float-right" style="float: right;"
                                                        type="button" id="add-review">+ Add More</button>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="review-sections">


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_image">Step
                                                                    Image</label><span class="text-small text-danger">(
                                                                    Image size
                                                                    must be 200 x 45 px )</span>
                                                                <input type="file" name="step_image[]"
                                                                    class="form-control image-check" id="step_image"
                                                                    required data-width="200" data-height="45">
                                                                <div class="img-alert"></div>
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Image!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_image_alt_tag">Step
                                                                    Image
                                                                    Alt Tag</label>
                                                                <input type="text" name="step_image_alt_tag[]"
                                                                    class="form-control" id="step_image_alt_tag"
                                                                    placeholder="Step Image Alt Tag" required>
                                                                <div class="invalid-feedback">
                                                                    Please Enter Step Image Alt Tag
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <script>
                                            $(document).ready(function () {
                                                var maxReviews = 5;
                                                var reviewIndex = 1;

                                                // Function to update indexes and IDs
                                                function updateIndexes() {
                                                    $('.review-section').each(function (index) {
                                                        var idx = index + 1;
                                                        $(this).find('.client-image').attr('id', 'client_image_' + idx);
                                                        $(this).find('.client-image').attr('name', 'client_image[]');
                                                        $(this).find('.client-name').attr('id', 'client_name_' + idx);
                                                        $(this).find('.client-name').attr('name', 'client_name[]');
                                                        $(this).find('.review-title').attr('id', 'review_title_' + idx);
                                                        $(this).find('.review-title').attr('name', 'review_title[]');
                                                        $(this).find('.review-description').attr('id', 'review_description_' + idx);
                                                        $(this).find('.review-description').attr('name', 'review_description[]');
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
                                                    <label class="form-label" for="step_image">Step Image</label><span class="text-small text-danger">( Image size
                                                        must be 200 x 45 px )</span>
                                                    <input type="file" name="step_image[]"
                                                        class="form-control image-check" id="step_image" required
                                                        data-width="200" data-height="45">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Step Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_image_alt_tag">Step Image
                                                        Alt Tag</label>
                                                    <input type="text" name="step_image_alt_tag[]" class="form-control"
                                                        id="step_image_alt_tag" placeholder="Step Image Alt Tag" required>
                                                          <div class="invalid-feedback">
                                                        Please Enter Step Image Alt Tag
                                                    </div>

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