<div class="row">
              <div class="col-xl-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="mb-3">
                                      <label class="form-label" for="banner_title">Banner Title</label>
                                      <input type="text" name="banner_title" class="form-control"
                                          id="banner_title" placeholder="Banner Title" value="" required>
                                      <div class="invalid-feedback">
                                          Please Enter Banner Title!
                                      </div>
                                  </div>
                              </div>
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label class="form-label" for="banner_bg_image">Banner BG 
                                          Image</label><span class="text-small text-danger">( Image size must be 1440 x 376 px )</span>
                                      <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required data-height="376" data-width="1440">
                                          <div class="img-alert"></div>
                                      <div class="invalid-feedback">
                                          Please Choose Banner BG Image!
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label class="form-label" for="title">Main Title</label>
                                      <input type="text" class="form-control" id="title"
                                          name="title" placeholder="Title" required>
                                      <div class="invalid-feedback">
                                          Please Enter Title!
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="mb-3">
                                      <label class="form-label" for="banner_description">Banner
                                          Description</label>
                                      <textarea type="text" class="form-control" id="banner_description"  name="banner_description"
                                          placeholder="Banner Description" required></textarea>
                                      <div class="invalid-feedback">
                                          Please Enter Banner Description!
                                      </div>
                                  </div>
                              </div>
                          </div>

                        

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
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_image">Step Image Icon
                                                  </label><span
                                                      class="text-small text-danger">(
                                                      Image size must be 36 x 65 px
                                                      )</span>
                                                  <input type="file" name="step_image_icon[]"
                                                      class="form-control image-check"
                                                      id="step_image"
                                                      data-width="36" data-height="65">
                                                  <div class="img-alert"></div>
                                                  <div class="invalid-feedback">
                                                      Please Choose Step Image Icon!
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="service_image_icon_alt_tag">Step
                                                      Image Icon Alt Tag </label>
                                                  <input type="text"
                                                      name="step_image_icon_alt_tag[]"
                                                      class="form-control image-check"
                                                      id="step_image_icon_alt_tag">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_text">Step Text</label>
                                                  <input type="text" name="step_text[]"
                                                      class="form-control" id="step_text"
                                                      placeholder="Step Text" required>
                                                  <div class="invalid-feedback">
                                                      Please provide a Step Text
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label"
                                                      for="step_text1">Text Url</label>
                                                  <input type="text" name="text_url[]"
                                                      class="form-control" id="text_url"
                                                      placeholder="Text Url">
                                                  <div class="invalid-feedback">
                                                      Please provide a Text Url
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
<div class="col-md-6">
  <div class="mb-3">
      <label class="form-label"
          for="step_image${reviewIndex}">Step Image Icon
      </label><span
          class="text-small text-danger">(
          Image size must be 36 x 65 px
          )</span>
      <input type="file" name="step_image_icon[]"
          class="form-control image-check"
          id="step_image${reviewIndex}"
          data-width="36" data-height="65">
      <div class="img-alert"></div>
      <div class="invalid-feedback">
          Please Choose Step Image Icon!
      </div>
  </div>
</div>
<div class="col-md-6">
  <div class="mb-3">
      <label class="form-label"
          for="step_image_icon_alt_tag${reviewIndex}">Step
          Image Icon Alt Tag </label>
      <input type="text"
          name="step_image_icon_alt_tag[]"
          class="form-control image-check"
          id="step_image_icon_alt_tag${reviewIndex}">
  </div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="mb-3">
      <label class="form-label"
          for="step_text${reviewIndex}">Step Text</label>
      <input type="text" name="step_text[]"
          class="form-control" id="step_text${reviewIndex}"
          placeholder="Step Text" required>
      <div class="invalid-feedback">
          Please provide a Step Text
      </div>
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
      <label class="form-label"
          for="text_url_${reviewIndex}">Text Url</label>
      <input type="text" name="text_url[]"
          class="form-control" id="text_url_${reviewIndex}"
          placeholder="Text Url">
      <div class="invalid-feedback">
          Please provide a Text Url
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