<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title"  required>
             <div class="invalid-feedback">
                Please Enter Title!
            </div>   
        </div>
    </div>
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_bg_image">Banner BG Image
            </label><span class="text-small text-danger">( Image size must be 2628 x 690 px )</span>
            <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image"
                required data-width="2628" data-height="690">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose Banner BG Image!
            </div>
        </div>
    </div>   
</div>

<div class="row">
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_image">Banner Image
            </label><span class="text-small text-danger">( Image size must be 753 x 507 px )</span>
            <input type="file" name="banner_image" class="form-control image-check" id="banner_image"
                required data-width="753" data-height="507">
            <div class="img-alert"></div>
            <div class="invalid-feedback">
                Please Choose Banner Image!
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="banner_image_alt">Banner Image Alt tag</label>
            <input type="text" class="form-control" id="banner_image_alt" name="banner_image_alt" placeholder="Banner Image Alt tag"
                >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
         <div class="mb-3">
            <label class="form-label" for="banner_image">Button Text
            </label>
            <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Button Text"
                >
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="button_url">Button Url</label>
            <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Button Url"
                >
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" rows="3"  required></textarea>
            <div class="invalid-feedback">
                Please Enter Description!
            </div>
        </div>
    </div>
</div>  
    <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
<div class="card-header">
<h4 class="card-title">Steps
<button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
</h4>
</div>
<div class="card-body">
<div id="review-sections">
 <div class="row">
   <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="step_title">Step Title</label>
                <input type="text"  name="step_title[]" class="form-control" id="step_title" required>
             </div>
        </div>
 
            <div class="col-md-6">
            <div class="mb-3">
               <label class="form-label" for="step_sub_title">Sub Title</label>
               <input type="text"  name="step_sub_title[]" class="form-control" id="step_sub_title" required>
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
$(this).find('.step-title').attr('id', 'step_title_' + idx);
$(this).find('.step-title').attr('name', 'step_title[]');
});
}

// Add more review sections 
$('#add-review').click(function() {
if ($('.review-section').length < maxReviews) {
reviewIndex++;
var newReviewSection = `
<div class="review-section" style="border-top: 7px solid #fff;">
<div class="row">
   <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="step_title">Step Title</label>
                <input type="text"  name="step_title[]" class="form-control" id="step_title" required>
             </div>
        </div>
 
            <div class="col-md-6">
            <div class="mb-3">
               <label class="form-label" for="step_sub_title">Sub Title</label>
               <input type="text"  name="step_sub_title[]" class="form-control" id="step_sub_title" required>
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