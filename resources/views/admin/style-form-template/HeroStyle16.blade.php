<div class="card card  bg-gradient"
                              style="background-color: rgb(220 221 225) !important;">
                              <div class="card-header">
                                  <h4 class="card-title">Steps
                                      <button class="btn btn-danger float-right"
                                          style="float: right;" type="button"
                                          id="add-review">+ Add More</button>
                                  </h4>
                              </div>
                              <div class="card-body">
                                  <div id="review-sections">

                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_image">Background Image
                                                  </label><span
                                                      class="text-small text-danger">(
                                                      Image size must be 1917 x 878 px
                                                      )</span>
                                                  <input type="file" name="step_image[]"
                                                      class="form-control image-check"
                                                      id="step_image"
                                                      data-width="1917" data-height="878" required>
                                                  <div class="img-alert"></div>
                                                  <div class="invalid-feedback">
                                                      Please Choose Background Image!
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="title">Title</label>
                                                  <input type="text" name="title[]"
                                                      class="form-control" id="title"
                                                      placeholder="Title" required>
                                                  <div class="invalid-feedback">
                                                      Please Enter a Title
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_text1">Highlighted Title</label>
                                                  <input type="text" name="highlighted_title[]"
                                                      class="form-control" id="highlighted_title"
                                                      placeholder="Highlighted Title" required>
                                                  <div class="invalid-feedback">
                                                      Please Enter Highlighted Title
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="button_text">Button Text</label>
                                                <input type="text" name="button_text[]" class="form-control"
                                                    id="button_text" placeholder="Button Text" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="button_link">Button URL</label>
                                                <input type="text" class="form-control" id="button_link" name="button_link[]"
                                                    placeholder="Button URL">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_description">
                                                    Description</label>
                                                <textarea type="text" class="form-control" id="description"
                                                    name="description[]" placeholder="Description"
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
<script>
$(document).ready(function () {
var maxReviews = 2;
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
                                          <div class="col-md-12">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_image">Background Image
                                                  </label><span
                                                      class="text-small text-danger">(
                                                      Image size must be 1917 x 878 px
                                                      )</span>
                                                  <input type="file" name="step_image[]"
                                                      class="form-control image-check"
                                                      id="step_image"
                                                      data-width="1917" data-height="878" required>
                                                  <div class="img-alert"></div>
                                                  <div class="invalid-feedback">
                                                      Please Choose Background Image!
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="title">Title</label>
                                                  <input type="text" name="title[]"
                                                      class="form-control" id="title"
                                                      placeholder="Title" required>
                                                  <div class="invalid-feedback">
                                                      Please Enter a Title
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_text1">Highlighted Title</label>
                                                  <input type="text" name="highlighted_title[]"
                                                      class="form-control" id="highlighted_title"
                                                      placeholder="Highlighted Title" required>
                                                  <div class="invalid-feedback">
                                                      Please Enter Highlighted Title
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="button_text">Button Text</label>
                                                <input type="text" name="button_text[]" class="form-control"
                                                    id="button_text" placeholder="Button Text" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="button_link">Button URL</label>
                                                <input type="text" class="form-control" id="button_link" name="button_link[]"
                                                    placeholder="Button URL">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_description">
                                                    Description</label>
                                                <textarea type="text" class="form-control" id="description"
                                                    name="description[]" placeholder="Description"
                                                    required></textarea>
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