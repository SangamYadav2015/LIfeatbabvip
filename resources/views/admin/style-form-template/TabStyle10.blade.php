<div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Title" required>
                                                <div class="invalid-feedback">
                                                    Please Enter Title!
                                                </div>
                                            </div>

                                             <div class="col-md-4">
                                                <label class="form-label" for="sub_title">Subtitle</label>
                                                <input type="text" class="form-control" id="sub_title" name="sub_title"
                                                    placeholder="Subtitle" required>
                                                <div class="invalid-feedback">
                                                    Please Enter Title!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_bg_image">BG 
                                                        Image</label><span class="text-small text-danger">( Image size must be 1600 x 1000 px )</span>
                                                    <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required=""  data-width="1600" data-height="1000">
                                                        <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose BG Image!
                                                    </div>
                                                </div>
                                            </div>
                                             
                                             
                                        </div>

                                    

                                    <div class="card card  bg-gradient"
                                        style="background-color: rgb(220 221 225) !important;">
                                        <div class="card-header">
                                            <h4 class="card-title">Tab Data
                                                <button class="btn btn-danger float-right" style="float: right;"
                                                    type="button" id="add-review">+ Add More</button>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="review-sections">

                                                <div class="row">
                                                  <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_main_title_${reviewIndex}">Tab Main
                                                                Title</label>
                                                            <input type="text" class="form-control" name="tab_main_title_[]"
                                                                id="tab_main_title_${reviewIndex}" placeholder="Tab Main Title"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Main Title!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_title_${reviewIndex}">Tab
                                                                Title</label>
                                                            <input type="text" class="form-control" name="tab_title[]"
                                                                id="tab_title_${reviewIndex}" placeholder="Tab Title"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Title!
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_sub_title${reviewIndex}">Tab
                                                                Subtitle</label>
                                                            <input type="text" class="form-control" name="tab_sub_title[]"
                                                                id="tab_sub_title${reviewIndex}" placeholder="Tab Subtitle"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Subtitle!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="image">Image
                                                            </label><span class="text-small text-danger">( Image size
                                                                must be 570 x 384 px )</span>
                                                            <input type="file" name="tab_image[]"
                                                                class="form-control image-check" id="image" required
                                                                data-width="570" data-height="384">
                                                            <div class="img-alert"></div>
                                                            <div class="invalid-feedback">
                                                                Please Choose Review Image!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_image_alt_tag">Image Alt
                                                                Tag </label>
                                                            <input type="text" name="tab_image_alt_tag[]"
                                                                class="form-control image-check" id="tab_image_alt_tag"
                                                                placeholder="Image Alt Tag!">
                                                            <div class="invalid-feedback">
                                                                Please Enter Image Alt Tag!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_text${reviewIndex}">Button Text</label>
                                                            <input type="text" class="form-control" name="button_text[]"
                                                                id="button_text${reviewIndex}" placeholder="Button Text"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Button Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_url${reviewIndex}">Tab
                                                                Title</label>
                                                            <input type="text" class="form-control" name="button_url[]"
                                                                id="button_url${reviewIndex}" placeholder="Button URL"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Button URL!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                               
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_description">Tab
                                                                Description</label>
                                                            <textarea class="form-control" name="tab_description[]"
                                                                id="tab_description" placeholder="Tab Description"
                                                                required></textarea>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Description!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            var maxReviews = 4;
                                            var reviewIndex = 1;

                                            // Function to update indexes and IDs
                                            function updateIndexes() {
                                                $('.review-section').each(function (index) {
                                                    var idx = index + 1;
                                                    $(this).find('.tab-title').attr('id', 'tab_title_' + idx);
                                                    $(this).find('.tab-title').attr('name', 'tab_title[]');
                                                    $(this).find('.review-image').attr('id', 'tab_image_' + idx);
                                                    $(this).find('.review-image').attr('name', 'tab_image[]');



                                                    $(this).find('.tab-description').attr('id', 'tab_description_' + idx);
                                                    $(this).find('.tab-description').attr('name', 'tab_description[]');

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
                                                            <label class="form-label" for="tab_main_title_${reviewIndex}">Tab Main
                                                                Title</label>
                                                            <input type="text" class="form-control" name="tab_main_title_[]"
                                                                id="tab_main_title_${reviewIndex}" placeholder="Tab Main Title"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Main Title!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_title_${reviewIndex}">Tab
                                                                Title</label>
                                                            <input type="text" class="form-control" name="tab_title[]"
                                                                id="tab_title_${reviewIndex}" placeholder="Tab Title"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Title!
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_sub_title${reviewIndex}">Tab
                                                                Subtitle</label>
                                                            <input type="text" class="form-control" name="tab_sub_title[]"
                                                                id="tab_sub_title${reviewIndex}" placeholder="Tab Subtitle"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Subtitle!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="image">Image
                                                            </label><span class="text-small text-danger">( Image size
                                                                must be 570 x 384 px )</span>
                                                            <input type="file" name="tab_image[]"
                                                                class="form-control image-check" id="image" required
                                                                data-width="570" data-height="384">
                                                            <div class="img-alert"></div>
                                                            <div class="invalid-feedback">
                                                                Please Choose Review Image!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_image_alt_tag">Image Alt
                                                                Tag </label>
                                                            <input type="text" name="tab_image_alt_tag[]"
                                                                class="form-control image-check" id="tab_image_alt_tag"
                                                                placeholder="Image Alt Tag!">
                                                            <div class="invalid-feedback">
                                                                Please Enter Image Alt Tag!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_text${reviewIndex}">Button Text</label>
                                                            <input type="text" class="form-control" name="button_text[]"
                                                                id="button_text${reviewIndex}" placeholder="Button Text"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Button Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_url${reviewIndex}">Tab
                                                                Title</label>
                                                            <input type="text" class="form-control" name="button_url[]"
                                                                id="button_url${reviewIndex}" placeholder="Button URL"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Button URL!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                               
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tab_description">Tab
                                                                Description</label>
                                                            <textarea class="form-control" name="tab_description[]"
                                                                id="tab_description" placeholder="Tab Description"
                                                                required></textarea>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Description!
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
                                                    updateIndexes();
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