<div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                  <div class="invalid-feedback">
                    Please Enter Title!
                  </div>

                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="highlighted_title">Highlited Title</label>
                  <input type="text" class="form-control" id="highlighted_title" name="highlighted_title"
                    placeholder="Highlited Title" required>
                  <div class="invalid-feedback">
                    Please Enter Highlited Title!
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="subtitle">Subtitle</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle" required>
                  <div class="invalid-feedback">
                    Please Enter Subtitle!
                  </div>
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
                        <label class="form-label" for="step_title">Step Title</label>
                        <input type="text" name="step_title[]" class="form-control" id="step_title"
                          placeholder="Step Title" required>
                        <div class="invalid-feedback">
                          Please provide a Service Title!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_sub_title">Step Subtitle</label>
                        <input type="text" name="step_sub_title[]" class="form-control" id="step_sub_title"
                          placeholder="Step Subtitle" required>
                        <div class="invalid-feedback">
                          Please provide a Service Title!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image">Step Image Icon
                        </label><span class="text-small text-danger">( Image size must be 48 x 48px )</span>
                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image" required
                          data-width="48" data-height="48">
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                          Please Choose Step Image Icon!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image_alt_tag">Step Image Icon Alt Tag </label>
                        <input type="text" name="step_image_alt_tag[]" class="form-control image-check"
                          id="step_image_alt_tag"  placeholder="Step Image Icon Alt Tag" >
                        <div class="invalid-feedback">
                          Please Enter Step Image Icon Alt Tag!
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
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_title">Step Title</label>
                        <input type="text" name="step_title[]" class="form-control" id="step_title"
                          placeholder="Step Title" required>
                        <div class="invalid-feedback">
                          Please provide a Service Title!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_sub_title">Step Subtitle</label>
                        <input type="text" name="step_sub_title[]" class="form-control" id="step_sub_title"
                          placeholder="Step Subtitle" required>
                        <div class="invalid-feedback">
                          Please provide a Service Title!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image">Step Image Icon
                        </label><span class="text-small text-danger">( Image size must be 48 x 48 px )</span>
                        <input type="file" name="step_image[]" class="form-control image-check" id="step_image" required
                          data-width="48" data-height="48">
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                          Please Choose Step Image Icon!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image_alt_tag">Service Image Icon Alt Tag </label>
                        <input type="text" name="step_image_alt_tag[]" class="form-control image-check"
                          id="step_image_alt_tag" placeholder="Step Image Icon Alt Tag">
                        <div class="invalid-feedback">
                          Please Enter Step Image Icon Alt Tag!
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