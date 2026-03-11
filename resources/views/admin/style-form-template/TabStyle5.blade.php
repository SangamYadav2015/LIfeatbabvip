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
                                                <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                <input type="text" class="form-control" id="highlighted_title" name="highlighted_title"
                                                    placeholder="Highlighted Title" required>
                                                <div class="invalid-feedback">
                                                    Please Enter Highlighted Title!
                                                </div>
                                            </div>

                                              <div class="col-md-4">
                                                <label class="form-label" for="highlighted_title">Subtitle</label>
                                                <input type="text" class="form-control" id="sub_title" name="sub_title"
                                                    placeholder="Subtitle" required>
                                                <div class="invalid-feedback">
                                                    Please Enter Subtitle!
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Backgound Image</label><span class="text-small text-danger">( Image size
                                                        must be 1320 x 557 px )</span>
                                                    <input type="file" name="image1" class="form-control image-check" id="image1" required="" data-width="1320" data-height="557">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Backgound Image !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1_alt_tag">Image 1
                                                        Alt Tag</label>
                                                    <input type="text" name="image1_alt_tag" class="form-control" id="image1_alt_tag" placeholder="Image 1 Alt Tag">
                                                </div>
                                            </div>
                                          
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2">Image 1</label><span class="text-small text-danger">( Image size
                                                        must be 112 x 112 px )</span>
                                                    <input type="file" name="image2" class="form-control image-check" id="image2" required="" data-width="112" data-height="112">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 1!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2_alt_tag">Image 1
                                                        Alt Tag</label>
                                                    <input type="text" name="image2_alt_tag" class="form-control" id="image2_alt_tag" placeholder="Image 1 Alt Tag">
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
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="tab_main_title${reviewIndex}">Tab Main
                                                                Title</label>
                                                            <input type="text" class="form-control"
                                                                name="tab_main_title[]"
                                                                id="tab_main_title${reviewIndex}"
                                                                placeholder="Tab Main Title" required>
                                                            <div class="invalid-feedback">
                                                                Please Enter Tab Main Title!
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="image">Image
                                                            </label><span class="text-small text-danger">( Image size
                                                                must be 484 x 309 px )</span>
                                                            <input type="file" name="tab_image[]"
                                                                class="form-control image-check" id="image" required
                                                                data-width="484" data-height="309">
                                                            <div class="img-alert"></div>
                                                            <div class="invalid-feedback">
                                                                Please Choose Image!
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
                                                            <label class="form-label"
                                                                for="step_image_icon">Icon
                                                            </label><span class="text-small text-danger">( Image size
                                                                must be 25 x 25 px )</span>
                                                            <input type="file" name="step_image_icon[]"
                                                                class="form-control image-check"
                                                                id="step_image_icon" required
                                                                data-width="25" data-height="25">
                                                            <div class="img-alert"></div>
                                                            <div class="invalid-feedback">
                                                                Please Choose Image!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="step_image_icon_alt_tag"> Image Alt
                                                                Tag </label>
                                                            <input type="text" name="step_image_icon_alt_tag[]"
                                                                class="form-control image-check"
                                                                id="step_image_icon_alt_tag"
                                                                placeholder="Icon Image Alt Tag!">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="step1_text">Step 1
                                                                Text</label>
                                                            <input type="text" name="step1_text[]" class="form-control"
                                                                id="step1_text" placeholder="Step 1 Text" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Step 1 Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="step2_text">Step 2
                                                                Text</label>
                                                            <input type="text" name="step2_text[]" class="form-control"
                                                                id="step2_text" placeholder="Step 2 Text" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Step 2 Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_text">Button Text
                                                                Text</label>
                                                            <input type="text" name="button_text[]" class="form-control"
                                                                id="button_text" placeholder="Button Text" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Button Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_url">Button URL
                                                                </label>
                                                            <input type="text" name="button_url[]" class="form-control"
                                                                id="button_url" placeholder="Button URL" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Button URL!
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
                                            var maxReviews = 3;
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
                                 <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_main_title${reviewIndex}">Tab Main Title</label>
                                         <input type="text" class="form-control" name="tab_main_title[]" id="tab_main_title${reviewIndex}" placeholder="Tab Main Title"  required>
                                         <div class="invalid-feedback">
                                             Please Enter Tab Main Title!
                                         </div>
                                     </div>
                                 </div>

                                   <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_title_${reviewIndex}">Tab Title</label>
                                         <input type="text" class="form-control" name="tab_title[]" id="tab_title_${reviewIndex}" placeholder="Tab Title"  required>
                                         <div class="invalid-feedback">
                                             Please Enter Tab Title!
                                         </div>
                                     </div>
                                 </div>
                                </div>
                            
                            <div class="row">
                                  <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_image_${reviewIndex}">Image 
                                            </label><span class="text-small text-danger">( Image size must be 484 x 309 px )</span>
                                             <input type="file" name="tab_image[]" class="form-control image-check" id="tab_image_${reviewIndex}" required  data-width="484" data-height="309">
                                         <div class="img-alert"></div>
                                         <div class="invalid-feedback">
                                             Please Choose  Image!
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_image_alt_tag${reviewIndex}"> Image Alt Tag </label>
                                         <input type="text" name="tab_image_alt_tag[]" class="form-control image-check" id="tab_image_alt_tag${reviewIndex}"  placeholder="Image Alt Tag!" >
                                         <div class="invalid-feedback">
                                             Please Enter Image Alt Tag!
                                         </div>
                                     </div>
                                 </div>
                             </div>


                             <div class="row">
                                  <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="step_image_icon${reviewIndex}">Icon 
                                            </label><span class="text-small text-danger">( Image size must be 25 x 25 px )</span>
                                             <input type="file" name="step_image_icon[]" class="form-control image-check" id="step_image_icon${reviewIndex}" required  data-width="25" data-height="25">
                                         <div class="img-alert"></div>
                                         <div class="invalid-feedback">
                                             Please Choose  Image!
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="mb-3">
                                         <label class="form-label" for="step_image_icon_alt_tag${reviewIndex}"> Image Alt Tag </label>
                                         <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check" id="step_image_icon_alt_tag${reviewIndex}"  placeholder="Icon Image Alt Tag!" >
                                     </div>
                                 </div>
                             </div>
                                 
                         
                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step1_text">Step 1 Text</label>
                                                    <input type="text" name="step1_text[]" class="form-control" id="step1_text" placeholder="Step 1 Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please provide a Step 1 Text!
                                                    </div> 
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step2_text">Step 2 Text</label>
                                                    <input type="text" name="step2_text[]" class="form-control" id="step2_text" placeholder="Step 2 Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please provide a Step 2 Text!
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                        </div>

                                        
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_text">Button Text
                                                                Text</label>
                                                            <input type="text" name="button_text[]" class="form-control"
                                                                id="button_text" placeholder="Button Text" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Button Text!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="button_url">Button URL
                                                                </label>
                                                            <input type="text" name="button_url[]" class="form-control"
                                                                id="button_url" placeholder="Button URL" required>
                                                            <div class="invalid-feedback">
                                                                Please provide a Button URL!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="mb-3">
                                     <label class="form-label" for="tab_description_${reviewIndex}">Tab Description</label>
                                     <textarea type="text" class="form-control" name="tab_description[]" id="tab_description_${reviewIndex}" placeholder="Tab Description"  required></textarea>
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