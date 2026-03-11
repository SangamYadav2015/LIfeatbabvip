<div class="row">
                                            <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="title">Title</label>
                                                     <input type="text" class="form-control" id="title" name="title" placeholder="Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                               <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                     <input type="text" class="form-control" id="highlighted_title" name="highlighted_title" placeholder="Highlighted Title"  required>
                                                     <div class="invalid-feedback">
                                                         Please Enter Highlighted Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                        </div>
                                      
                
                            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                <div class="card-header">
                                    <h4 class="card-title">Tab Data
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                
                                          <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tab_title">Tab Title</label>
                                                        <input type="text" class="form-control" name="tab_title[]" id="tab_title" placeholder="Tab Title"  required>
                                                        <div class="invalid-feedback">
                                                            Please Enter Tab Title!
                                                        </div>
                                                    </div>
                                                </div>
                                                   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="image">Image 
                                                            </label><span class="text-small text-danger">( Image size must be 628 x 517 px )</span>
                                                        <input type="file" name="tab_image[]" class="form-control image-check" id="image" required  data-width="628" data-height="517">
                                                        <div class="img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose  Image!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tab_image_alt_tag">Image Alt Tag </label>
                                                        <input type="text" name="tab_image_alt_tag[]" class="form-control image-check" id="tab_image_alt_tag" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Image Alt Tag!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tab_description">Tab Description</label>
                                                    <textarea class="form-control" name="tab_description[]" id="tab_description" placeholder="Tab Description"  required></textarea>
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
        $(document).ready(function() {
     var maxReviews = 2;
     var reviewIndex = 1;
 
     // Function to update indexes and IDs
     function updateIndexes() {
         $('.review-section').each(function(index) {
             var idx = index + 1;
             $(this).find('.tab-title').attr('id', 'tab_title_' + idx);
             $(this).find('.tab-title').attr('name', 'tab_title[]');
             $(this).find('.review-image').attr('id', 'tab_image_' + idx);
             $(this).find('.review-image').attr('name', 'tab_image[]');
             $(this).find('.button-text').attr('id', 'button_text_' + idx);
             $(this).find('.button-text').attr('name', 'button_text[]');
             $(this).find('.button-url').attr('id', 'button_url_' + idx);
             $(this).find('.button-url').attr('name', 'button_url[]');
             $(this).find('.tab-description').attr('id', 'tab_description_' + idx);
             $(this).find('.tab-description').attr('name', 'tab_description[]');
            
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
                                                        <label class="form-label" for="tab_title">Tab Title</label>
                                                        <input type="text" class="form-control" name="tab_title[]" id="tab_title" placeholder="Tab Title"  required>
                                                        <div class="invalid-feedback">
                                                            Please Enter Tab Title!
                                                        </div>
                                                    </div>
                                                </div>
                                                   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="image">Image 
                                                            </label><span class="text-small text-danger">( Image size must be 628 x 517 px )</span>
                                                        <input type="file" name="tab_image[]" class="form-control image-check" id="image" required  data-width="628" data-height="517">
                                                        <div class="img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose  Image!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tab_image_alt_tag">Image Alt Tag </label>
                                                        <input type="text" name="tab_image_alt_tag[]" class="form-control image-check" id="tab_image_alt_tag" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Image Alt Tag!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tab_description">Tab Description</label>
                                                    <textarea class="form-control" name="tab_description[]" id="tab_description" placeholder="Tab Description"  required></textarea>
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