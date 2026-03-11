<div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                  <div class="invalid-feedback">
                    Please Enter Title!
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="main_description">Description</label>
                  <textarea class="form-control" name="main_description" id="main_description" name="main_description"
                    placeholder="Description" rows="2" required></textarea>
                  <div class="invalid-feedback">
                    Please Enter Description!
                  </div>
                </div>
              </div>
            </div>
            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
              <div class="card-header">
                <h4 class="card-title">Step
                  <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add
                    More</button>
                </h4>
              </div>
              <div class="card-body">
                <div id="review-sections">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="category">Select Category</label>
                        <select name="category[]" id="category" class="form-select">
                          <option value="">Select Category</option>
                          <option value="Agriculture">Agriculture</option>
                          <option value="Apparel">Apparel</option>
                          <option value="Art & Culture">Art & Culture</option>
                          <option value="Construction">Construction</option>
                          <option value="Consulting">Consulting</option>
                          <option value="Education">Education</option>
                          <option value="Environmental Services">Environmental Services</option>
                          <option value="Event Management">Event Management</option>
                          <option value="Financial Services">Financial Services</option>
                          <option value="Food & Beverage">Food & Beverage</option>
                          <option value="Healthcare">Healthcare</option>
                          <option value="Hospitality">Hospitality</option>
                          <option value="Information Technology">Information Technology</option>
                          <option value="Manufacturing">Manufacturing</option>
                          <option value="Non-Profit">Non-Profit</option>
                          <option value="Publishing">Publishing</option>
                          <option value="Real Estate">Real Estate</option>
                          <option value="Retail">Retail</option>
                          <option value="Tourism">Tourism</option>
                          <option value="Waste Management">Waste Management</option>
                        </select>
                        <div class="invalid-feedback">
                          Please Select Category!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="portfolio_title">Portfolio Title</label>
                        <input type="text" name="portfolio_title[]" class="form-control" id="portfolio_title" placeholder="Portfolio Title" required>
                        <div class="invalid-feedback">
                          Please Enter Portfolio Title!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image_icon">Image Thumbnail
                        </label><span class="text-small text-danger">( Image size must be 400 x 370 px )</span>
                        <input type="file" name="step_image_icon[]" class="form-control image-check"
                          id="step_image_icon" required data-width="400" data-height="370">
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                          Please Choose Image Thumbnail!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image__icon_alt_tag">Image Thumbnail Alt Tag </label>
                        <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check"
                          id="step_image_icon_alt_tag" placeholder="Image Thumbnail Alt Tag">
                        <div class="invalid-feedback">
                          Please Enter Image Thumbnail Alt Tag!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image_icon">Detail Image
                        </label><span class="text-small text-danger">( Image size must be 1200 x 210 px )</span>
                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image" required
                          data-width="1200" data-height="210">
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                          Please Choose Image Thumbnail!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image_alt_tag">Detail Image Alt Tag </label>
                        <input type="text" name="step_image_alt_tag[]" class="form-control image-check"
                          id="step_image_alt_tag" placeholder="Detail Image  Alt Tag">
                        <div class="invalid-feedback">
                          Please Enter Detail Image Alt Tag!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label" for="detail_title">Detailed Title</label>
                        <input type="text" name="detail_title[]" class="form-control" id="detail_title" placeholder="Detailed Title"
                          required>
                        <div class="invalid-feedback">
                          Please Enter Detailed Title!
                        </div>
                      </div>
                    </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="client">Client</label>
                        <input type="text" name="client[]" class="form-control" id="client" placeholder="Client"
                          required>
                        <div class="invalid-feedback">
                          Please Enter Client!
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="client">Service</label>
                        <input type="text" name="service[]" class="form-control" id="service" placeholder="Service"
                          required>
                        <div class="invalid-feedback">
                          Please Enter Service!
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea name="description[]" class="form-control" id="description" placeholder="Description"
                          required></textarea>
                        <div class="invalid-feedback">
                          Please Enter Description!
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        var maxReviews = 12;
        var reviewIndex = 1;
  
        // Function to update indexes and IDs
        function updateIndexes() {
  
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
                          <label class="form-label" for="category">Select Category</label>
                          <select name="category[]" id="category" class="form-select">
                             <option value="">Select Category</option>
                          <option value="Agriculture">Agriculture</option>
                          <option value="Apparel">Apparel</option>
                          <option value="Art & Culture">Art & Culture</option>
                          <option value="Construction">Construction</option>
                          <option value="Consulting">Consulting</option>
                          <option value="Education">Education</option>
                          <option value="Environmental Services">Environmental Services</option>
                          <option value="Event Management">Event Management</option>
                          <option value="Financial Services">Financial Services</option>
                          <option value="Food & Beverage">Food & Beverage</option>
                          <option value="Healthcare">Healthcare</option>
                          <option value="Hospitality">Hospitality</option>
                          <option value="Information Technology">Information Technology</option>
                          <option value="Manufacturing">Manufacturing</option>
                          <option value="Non-Profit">Non-Profit</option>
                          <option value="Publishing">Publishing</option>
                          <option value="Real Estate">Real Estate</option>
                          <option value="Retail">Retail</option>
                          <option value="Tourism">Tourism</option>
                          <option value="Waste Management">Waste Management</option>
                          </select>
                          <div class="invalid-feedback">
                            Please Select Category!
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="portfolio_title">Portfolio Title</label>
                          <input type="text" name="portfolio_title[]" class="form-control" id="portfolio_title"
                            placeholder="Portfolio Title" required>
                          <div class="invalid-feedback">
                            Please Enter Portfolio  Title!
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image_icon">Image Thumbnail
                          </label><span class="text-small text-danger">( Image size must be 400 x 370 px )</span>
                          <input type="file" name="step_image_icon[]" class="form-control image-check" id="step_image_icon" required
                            data-width="400" data-height="370">
                          <div class="img-alert"></div>
                          <div class="invalid-feedback">
                            Please Choose  Image Thumbnail!
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image__icon_alt_tag">Image Thumbnail Alt Tag </label>
                          <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check"
                            id="step_image_icon_alt_tag" placeholder="Image Thumbnail Alt Tag">
                          <div class="invalid-feedback">
                            Please Enter Image Thumbnail Alt Tag!
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image_icon">Detail Image
                          </label><span class="text-small text-danger">( Image size must be 1200 x 210 px )</span>
                          <input type="file" name="step_image[]" class="form-control image-check" id="step_image" required
                            data-width="1200" data-height="210">
                          <div class="img-alert"></div>
                          <div class="invalid-feedback">
                            Please Choose Image Thumbnail!
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image_alt_tag">Detail Image Alt Tag </label>
                          <input type="text" name="step_image_alt_tag[]" class="form-control image-check"
                            id="step_image_alt_tag" placeholder="Detail Image  Alt Tag">
                          <div class="invalid-feedback">
                            Please Enter Detail Image  Alt Tag!
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label" for="detail_title">Detailed Title</label>
                          <input type="text" name="detail_title[]" class="form-control" id="detail_title" placeholder="Detailed Title"
                            required>
                          <div class="invalid-feedback">
                            Please Enter Detailed Title!
                          </div>
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="client">Client</label>
                          <input type="text" name="client[]" class="form-control" id="client"
                            placeholder="Client" required>
                          <div class="invalid-feedback">
                            Please Enter Client!
                          </div>
                        </div>
                      </div>
  
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="client">Service</label>
                          <input type="text" name="service[]" class="form-control" id="service"
                            placeholder="Service" required>
                          <div class="invalid-feedback">
                            Please Enter Service!
                          </div>
                        </div>
                      </div>
                    </div>
  
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label" for="description">Description</label>
                          <textarea name="description[]" class="form-control" id="description"
                            placeholder="Description" required></textarea>
                          <div class="invalid-feedback">
                            Please Enter Description!
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