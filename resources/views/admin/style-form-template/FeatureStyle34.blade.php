<div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title"  required>
                                                     <div class="invalid-feedback">
                                                        Please Enter Title!
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                      
                                       <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Image 1</label><span class="text-small text-danger">( Image size
                                                        must be 120 x 120 px )</span>
                                                    <input type="file" name="image1" class="form-control image-check" id="image1" required="" data-width="120" data-height="120">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 1!
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
                                                    <label class="form-label" for="image2">Image 2</label><span class="text-small text-danger">( Image size
                                                        must be 692 x 409 px )</span>
                                                    <input type="file" name="image2" class="form-control image-check" id="image2" required="" data-width="692" data-height="409">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 2!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2_alt_tag">Image 2
                                                        Alt Tag</label>
                                                    <input type="text" name="image2_alt_tag" class="form-control" id="image2_alt_tag" placeholder="Image 2 Alt Tag">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image3">Image 3</label><span class="text-small text-danger">( Image size
                                                        must be 766 x 766 px )</span>
                                                    <input type="file" name="image3" class="form-control image-check" id="image3" required="" data-width="766" data-height="766">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 3!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image3_alt_tag">Image 3
                                                        Alt Tag</label>
                                                    <input type="text" name="image3_alt_tag" class="form-control" id="image3_alt_tag" placeholder="Image 3 Alt Tag">
                                                </div>
                                            </div>
                                           
                                        </div>

                                          <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" rows="2" required></textarea>
                
                                                <div class="invalid-feedback">
                                                    Please Enter Description!
                                                </div> 
                                                </div>
                                            </div>
                                        </div>
                
                            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                <div class="card-header">
                                    <h4 class="card-title">Feature Steps 
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                
                                         <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_title">Step  Title</label>
                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Step  Title" required="">
                                                        <div class="invalid-feedback">
                                                            Please Enter Step  Title!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_image_icon">Step Image Icon 
                                                        </label><span class="text-small text-danger">( Image size must be 60 x 60 px )</span>
                                                    <input type="file" name="step_image_icon[]" class="form-control image-check" id="step_image_icon" required="" data-width="60" data-height="60">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Step Image Icon!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_image_icon_alt_tag">Step Image Icon Alt Tag </label>
                                                    <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check" id="step_image_icon_alt_tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter Step Image Icon Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                         </div>

                                       

                                              <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Step Description</label>
                                                        <textarea type="text" class="form-control" name="step_description[]" id="step_description" placeholder="Step Description" rows="2" required=""></textarea>
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
        $(document).ready(function() {
          var maxReviews = 2;
          var reviewIndex = 1;
      
          // Function to update indexes and IDs
          function updateIndexes() {
              $('.review-section').each(function(index) {
                  var idx = index + 1;
                  $(this).find('.step-subtitle').attr('id', 'step_title_' + idx);
                  $(this).find('.step-subtitle').attr('name', 'step_title[]');
                  $(this).find('.step-image-icon').attr('id', 'step_image_icon_' + idx);
                  $(this).find('.step-image-icon').attr('name', 'step_image_icon[]');
                  $(this).find('.step-description').attr('id', 'step_description_' + idx);
                  $(this).find('.step-description').attr('name', 'step_description[]');
                 
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
                                                        <label class="form-label" for="step_title">Step  Title</label>
                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Step  Title" required="">
                                                        <div class="invalid-feedback">
                                                            Please Enter Step  Title!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_image_icon">Step Image Icon 
                                                        </label><span class="text-small text-danger">( Image size must be 60 x 60 px )</span>
                                                    <input type="file" name="step_image_icon[]" class="form-control image-check" id="step_image_icon" required="" data-width="60" data-height="60">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Step Image Icon!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_image_icon_alt_tag">Step Image Icon Alt Tag </label>
                                                    <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check" id="step_image_icon_alt_tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter Step Image Icon Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                         </div>


                                              <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Step Description</label>
                                                        <textarea type="text" class="form-control" name="step_description[]" id="step_description" placeholder="Step Description" rows="2" required=""></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Step Description!
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
          $(document).on('click', '.remove-review', function() {
              $(this).closest('.review-section').remove();
              $('#add-review').attr('disabled', false)
              updateIndexes();
          });
      });
      
      </script>
      <script>
          $(document).ready(function() {
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