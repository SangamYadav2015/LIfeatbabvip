<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="subtitle">Subtitle</label>
                                                    <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Subtitle" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Subtitle!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button Text</label>
                                                    <input type="text" name="button_text" class="form-control" id="button_text" placeholder="Button Text" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a Button Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button Url</label>
                                                    <input type="text" name="button_url" class="form-control" id="button_url" placeholder="Button Url" required>
                
                                                    <div class="invalid-feedback">
                                                        Please provide a Button URL!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="left_icon_image">Left Icons </label><span class="text-small text-danger">( Image size must be 64 x
                                                        64 px and Min & Max 6 images are allowed)</span>
                                                    <input type="file" class="form-control" name="left_image_icon[]" id="left_icon_image" multiple data-height="64" data-width="64" accept="image/*">
                                                    <div class="left-img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Top Client Images!
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="left_icon_alt_tag"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="left_icon_image">Right Icons </label><span class="text-small text-danger">( Image size must be 64 x
                                                        64 px and Min & Max 6 images are allowed)</span>
                                                    <input type="file" class="form-control" name="right_image_icon[]" id="right_icon_image" multiple data-height="64" data-width="64" accept="image/*">
                                                    <div class="right-img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Right Images!
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="right_icon_alt_tag"></div>
                                        </div>
                
                                        <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                            <div class="card-header">
                                                <h4 class="card-title">Intigration Steps
                                                    <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="review-sections">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="image_icon">
                                                                    Image Icon</label><span class="text-small text-danger">( Image size must be 64 x 64 px )</span>
                                                                <input type="file" name="image_icon[]" class="form-control image-check" id="image_icon" required data-width="64" data-height="64">
                                                                <div class="img-alert"></div>
                                                                <div class="invalid-feedback">
                                                                    Please Choose Image Icon!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="image_icon_alt_tag"> Image Icon Alt Tag</label>
                                                                <input type="text" name="image_icon_alt_tag[]" class="form-control" id="image_icon_alt_tag">
                                                                <div class="invalid-feedback">
                                                                    Please Enter Image Icon Alt Tag!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="card_title">Card Title</label>
                                                                <input type="text" name="card_title[]" class="form-control" id="card_title" placeholder="Card Title" required>
                                                                <div class="invalid-feedback">
                                                                    Please Enter Card Title!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                
                
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_button_text">Button Text</label>
                                                                <input type="text" name="step_button_text[]" class="form-control" id="step_button_text" placeholder="Button Text">
                                                                <div class="invalid-feedback">
                                                                    Please Enter Button Text!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_button_url">Button Url</label>
                                                                <input type="text" name="step_button_url[]" class="form-control" id="step_button_url" placeholder="Button Url">
                
                                                                <div class="invalid-feedback">
                                                                    Please Enter Button URL!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="card_description">Card Description</label>
                                                                <textarea type="text" name="card_description[]" class="form-control" id="card_description" placeholder="Card Description" rows="2" required></textarea>
                                                                <div class="invalid-feedback">
                                                                    Please Enter Card Description!
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                
                                                </div>
                                            </div>
                                        </div>

<script>
        $(document).ready(function() {
            var maxReviews = 1;
            var reviewIndex = 1;

            // Function to update indexes and IDs
            function updateIndexes() {
                $('.review-section').each(function(index) {
                    var idx = index + 1;
                    $(this).find('.image-icon').attr('id', 'image_icon_' + idx);
                    $(this).find('.image-icon').attr('name', 'image_icon[]');
                    $(this).find('.card-title').attr('id', 'card_title_' + idx);
                    $(this).find('.card-title').attr('name', 'card_title[]');
                    $(this).find('.button-text').attr('id', 'button_text_' + idx);
                    $(this).find('.button-text').attr('name', 'button_text[]');
                    $(this).find('.button-url').attr('id', 'button_url_' + idx);
                    $(this).find('.button-url').attr('name', 'button_url[]');
                    $(this).find('.card-short-description').attr('id', 'card_short_description_' + idx);
                    $(this).find('.card-short-description').attr('name', 'card_short_description[]');
                    $(this).find('.card-description').attr('id', 'card_description_' + idx);
                    $(this).find('.card-description').attr('name', 'card_description[]');

                });
            }

            // Add more review sections
            $('#add-review').click(function() {
                if ($('.review-section').length < maxReviews) {
                    reviewIndex++;
                    var newReviewSection = `
                <div class="review-section" style="border-top: 7px solid #fff;">
                    
                   
                    <div class="row">
                                   <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="image_icon_${reviewIndex}"> 
                                                Image Icon</label><span class="text-small text-danger">( Image size must be 64 x 64 px )</span>
                                            <input type="file" name="image_icon[]" class="form-control image-check" id="image_icon_${reviewIndex}" required  data-width="64" data-height="64">
                                            <div class="img-alert"></div>
                                            <div class="invalid-feedback">
                                                Please Choose  Image Icon!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">    
                                        <div class="mb-3">
                                            <label class="form-label" for="image_icon_alt_tag_${reviewIndex}"> Image Icon Alt Tag</label>
                                            <input type="text" name="image_icon_alt_tag[]" class="form-control"  id="image_icon_alt_tag_${reviewIndex}">
                                            <div class="invalid-feedback">
                                                Please Enter  Image Icon Alt Tag!
                                            </div> 
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                        <label class="form-label" for="card_title_${reviewIndex}">Card Title</label>
                                        <input type="text" name="card_title[]" class="form-control" id="card_title_${reviewIndex}" placeholder="Card Title" required>
                                        <div class="invalid-feedback">
                                            Please Enter Card Title!
                                        </div>
                                    </div>
                                </div>
                                </div>
                                   
                            
                                 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="step_button_text${reviewIndex}">Button Text</label>
                                    <input type="text" name="step_button_text[]" class="form-control" id="step_button_text${reviewIndex}" placeholder="Button Text" >
                                    <div class="invalid-feedback">
                                        Please Enter Button Text!
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="step_button_url${reviewIndex}">Button Url</label>
                                    <input type="text" name="step_button_url[]" class="form-control" id="step_button_url${reviewIndex}" placeholder="Button Url_${reviewIndex}">

                                    <div class="invalid-feedback">
                                        Please Enter Button URL!
                                    </div> 
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                  <div class="col-md-12">
                                        <div class="mb-3">
                                        <label class="form-label" for="card_description_${reviewIndex}">Card Description</label>
                                        <textarea type="text" name="card_description[]" class="form-control" id="card_description_${reviewIndex}" placeholder="Card Short Description" rows="2" required></textarea>
                                        <div class="invalid-feedback">
                                            Please Enter Card Short Description!
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
            });

            // Remove review section
            $(document).on('click', '.remove-review', function() {
                $(this).closest('.review-section').remove();
                $('#add-review').attr('disabled', false)
                updateIndexes();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.image-check').on('change', function() {
                var fileInput = this;
                var $parentDiv = $(fileInput).closest('.mb-3'); // Find the closest parent div

                if (fileInput.files && fileInput.files[0]) {
                    var img = new Image();
                    var file = fileInput.files[0];

                    var imgFixWidth = parseInt($(fileInput).attr('data-width'));
                    var imgFixHeight = parseInt($(fileInput).attr('data-height'));
                    var objectUrl = URL.createObjectURL(file);

                    img.onload = function() {
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

            $('#left_icon_image').on('change', function() {
                var files = $(this)[0].files;
                var maxFiles = 8;
                if (files.length > maxFiles) {
                    $(".left-img-alert").html('<span class="text-danger">You can only upload a maximum of ' + maxFiles + ' images.</span>');
                    $(this).val('');
                    return;
                }
                altHtml = '<div class="row">';
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function() {
                            var naturalWidth = this.naturalWidth;
                            var naturalHeight = this.naturalHeight;
                            var expectedWidth = parseInt($('#left_icon_image').data('width'));
                            var expectedHeight = parseInt($('#left_icon_image').data('height'));
                            if (naturalWidth !== expectedWidth || naturalHeight !== expectedHeight) {
                                $(".left-img-alert").html('<span class="text-danger">Image dimensions do not match expected values (' + expectedWidth + 'x' + expectedHeight + ').</span>');
                                $('#left_icon_image').val('');
                                return;
                            }
                        };
                    };

                    reader.readAsDataURL(file);
                    altHtml += '<div class="col-md-4">';
                    altHtml += '<div class="mb-3">';
                    altHtml += '<label class="form-label" for="left_icon_alt_tag">Icon ' + parseInt(i + 1) + ' Alt Tag</label>';
                    altHtml += '<input type="text" class="form-control" name="left_icon_alt_tag[]" id="left_icon_alt" placeholder="Icon ' + parseInt(i + 1) + ' Alt Tag">';
                    altHtml += '<div class="invalid-feedback">Please Enter Icon' + parseInt(i + 1) + ' Alt Tag!</div>';
                    altHtml += '</div></div>';
                }
                altHtml += '</div>';

                $("#left_icon_alt_tag").html(altHtml);
            });



            $('#right_icon_image').on('change', function() {
                var files = $(this)[0].files;
                var maxFiles = 8;
                if (files.length > maxFiles) {
                    $(".right-img-alert").html('<span class="text-danger">You can only upload a maximum of ' + maxFiles + ' images.</span>');
                    $(this).val('');
                    return;
                }
                altHtml = '<div class="row">';
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function() {
                            var naturalWidth = this.naturalWidth;
                            var naturalHeight = this.naturalHeight;
                            var expectedWidth = parseInt($('#right_icon_image').data('width'));
                            var expectedHeight = parseInt($('#right_icon_image').data('height'));
                            if (naturalWidth !== expectedWidth || naturalHeight !== expectedHeight) {
                                $(".right-img-alert").html('<span class="text-danger">Image dimensions do not match expected values (' + expectedWidth + 'x' + expectedHeight + ').</span>');
                                $('#right_icon_image').val('');
                                return;
                            }
                        };
                    };

                    reader.readAsDataURL(file);
                    altHtml += '<div class="col-md-4">';
                    altHtml += '<div class="mb-3">';
                    altHtml += '<label class="form-label" for="right_icon_alt">Icon ' + parseInt(i + 1) + ' Alt Tag</label>';
                    altHtml += '<input type="text" class="form-control" name="right_icon_alt_tag[]" id="right_icon_alt" placeholder="Icon ' + parseInt(i + 1) + ' Alt Tag">';
                    altHtml += '<div class="invalid-feedback">Please Enter Icon' + parseInt(i + 1) + ' Alt Tag!</div>';
                    altHtml += '</div></div>';
                }
                altHtml += '</div>';

                $("#right_icon_alt_tag").html(altHtml);
            });

        });
    </script>