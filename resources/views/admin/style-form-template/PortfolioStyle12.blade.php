<div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                  <div class="invalid-feedback">
                    Please Enter Title!
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="highlighted_title">Highlighted Title</label>
                  <input type="text" class="form-control" id="highlighted_title" name="highlighted_title"
                    placeholder="Highlighted Title" required>
                  <div class="invalid-feedback">
                    Please Enter Highlighted Title!
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="subtitle">Subtitle</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle" required>
                  <div class="invalid-feedback">
                    Please Enter Subtitle!
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
                        <label class="form-label" for="step_image_icon">Image
                        </label><span class="text-small text-danger">( Image size must be 311 x 359 px )</span>
                        <input type="file" name="step_image_icon[]" class="form-control image-check"
                          id="step_image_icon" required data-width="311" data-height="359">
                        <div class="img-alert"></div>
                        <div class="invalid-feedback">
                          Please Choose Image !
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="step_image__icon_alt_tag">Image Alt Tag </label>
                        <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check"
                          id="step_image_icon_alt_tag" placeholder="Image  Alt Tag">
                        <div class="invalid-feedback">
                          Please Enter Image Alt Tag!
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
        var maxReviews = 15;
        var reviewIndex = 1;
        var maxWidth = 0;
        var maxheight = 0;
        // Add more review s
        // Function to update indexes and IDs
        function updateIndexes() {

        }

        $('#add-review').click(function () {
          if ($('.review-section').length < maxReviews) {
            if (reviewIndex === 1) { maxWidth = 312; maxheight = 366; }
            if (reviewIndex === 2) { maxWidth = 424; maxheight = 366; }
            if (reviewIndex === 3) { maxWidth = 424; maxheight = 366; }
            if (reviewIndex === 4) { maxWidth = 536; maxheight = 366; }
            if (reviewIndex === 5) { maxWidth = 312; maxheight = 366; }
            reviewIndex++;
            var newReviewSection = `
                <div class="review-section" style="border-top: 7px solid #fff;">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image_icon">Image
                          </label><span class="text-small text-danger">( Image size must be 311 x 359 px )</span>
                          <input type="file" name="step_image_icon[]" class="form-control image-check"
                            id="step_image_icon" required data-width="311" data-height="359">
                          <div class="img-alert"></div>
                          <div class="invalid-feedback">
                            Please Choose Image !
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="step_image__icon_alt_tag">Image Alt Tag </label>
                          <input type="text" name="step_image_icon_alt_tag[]" class="form-control image-check"
                            id="step_image_icon_alt_tag" placeholder="Image  Alt Tag">
                          <div class="invalid-feedback">
                            Please Enter Image  Alt Tag!
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