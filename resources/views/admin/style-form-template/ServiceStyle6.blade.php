<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title 
                                                    </label>
                                                    <input type="text" name="title" class="form-control"
                                                        id="title" placeholder="Title" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title !
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="sub_title">Subtitle
                                                    </label>
                                                    <input type="text" name="sub_title" class="form-control"
                                                        id="sub_title" placeholder="Subtitle" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Subtitle!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       

                                        <div class="card card  bg-gradient"
                                            style="background-color: rgb(220 221 225) !important;">
                                            <div class="card-header">
                                                <h4 class="card-title">Step
                                                    <button class="btn btn-danger float-right" style="float: right;"
                                                        type="button" id="add-review">+ Add More</button>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="review-sections">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_title">Step Title</label>
                                                                <input type="text" name="step_title[]"
                                                                    class="form-control" id="step_title"
                                                                    required data-width="200" data-height="45" placeholder="Step Title">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Title!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_url">Step
                                                                    Link</label>
                                                                <input type="text" name="step_url[]"
                                                                    class="form-control" id="step_url"
                                                                    placeholder="Step Link">
                                                            </div>
                                                        </div>
                                                    </div>

                                             
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_image">Step
                                                                    Image</label><span class="text-small text-danger">(
                                                                    Image size
                                                                    must be 90 x 90 px )</span>
                                                                <input type="file" name="step_image[]"
                                                                    class="form-control image-check" id="step_image"
                                                                    required data-width="90" data-height="90">
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
                                                                    placeholder="Step Image Alt Tag">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="row">
                                                     <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_description">Step
                                                                    Description</label>
                                                                <textarea name="step_description[]"
                                                                    class="form-control" id="step_description"
                                                                    placeholder="Step Description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                </div>
                                            </div>
                                        </div>


                                        <script>
                                            $(document).ready(function () {
                                                var maxReviews = 3;
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
                       <div class="review-section mt-2" style="border-top: 7px solid #fff;">
                          
                                       <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_title">Step Title</label>
                                                                <input type="text" name="step_title[]"
                                                                    class="form-control" id="step_title"
                                                                    required data-width="200" data-height="45" placeholder="Step Title">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Title!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_url">Step
                                                                    Link</label>
                                                                <input type="text" name="step_url[]"
                                                                    class="form-control" id="step_url"
                                                                    placeholder="Step Link">
                                                            </div>
                                                        </div>
                                                    </div>

                                             
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_image">Step
                                                                    Image</label><span class="text-small text-danger">(
                                                                    Image size
                                                                    must be 90 x 90 px )</span>
                                                                <input type="file" name="step_image[]"
                                                                    class="form-control image-check" id="step_image"
                                                                    required data-width="90" data-height="90">
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
                                                                    placeholder="Step Image Alt Tag">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="row">
                                                     <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_description">Step
                                                                    Description</label>
                                                                <textarea name="step_description[]"
                                                                    class="form-control" id="step_description"
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