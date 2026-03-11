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
                                                     <label class="form-label" for="sub_title">Subtitle</label>
                                                     <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Subtitle"  required>
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
                                                <textarea class="form-control" name="description" id="description" name="description" placeholder="Description" rows="2" required></textarea> 
                                                 <div class="invalid-feedback">
                                                Please Enter Description!
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
                                                            </label><span class="text-small text-danger">( Image size must be 1059 x 453 px )</span>
                                                        <input type="file" name="tab_image[]" class="form-control image-check" id="image" required  data-width="1059" data-height="453">
                                                        <div class="img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose Review Image!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tab_image_alt_tag">Image Alt Tag </label>
                                                        <input type="text" name="tab_image_alt_tag[]" class="form-control image-check" id="tab_image_alt_tag" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Review Image Alt Tag!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button Text</label>
                                                    <input type="text" name="button_text[]" class="form-control" id="button_text" placeholder="Button Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please provide a Button Text!
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button Url</label>
                                                    <input type="text" name="button_url[]" class="form-control" id="button_url" placeholder="Button Url"  required>
                                                    <div class="invalid-feedback">
                                                        Please provide a Button Url!
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
     var maxReviews = 8;
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
                                         <label class="form-label" for="tab_title_${reviewIndex}">Tab Title</label>
                                         <input type="text" class="form-control" name="tab_title[]" id="tab_title_${reviewIndex}" placeholder="Tab Title"  required>
                                         <div class="invalid-feedback">
                                             Please Enter Tab Title!
                                         </div>
                                     </div>
                                 </div>
                                    <div class="col-md-4">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_image_${reviewIndex}">Image 
                                             </label><span class="text-small text-danger">( Image size must be 1059 x 453 px )</span>
                                         <input type="file" name="tab_image[]" class="form-control image-check" id="tab_image_${reviewIndex}" required  data-width="1059" data-height="453">
                                         <div class="img-alert"></div>
                                         <div class="invalid-feedback">
                                             Please Choose  Image!
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-4">
                                     <div class="mb-3">
                                         <label class="form-label" for="tab_image_alt_tag${reviewIndex}">Review Image Alt Tag </label>
                                         <input type="text" name="tab_image_alt_tag[]" class="form-control image-check" id="tab_image_alt_tag${reviewIndex}" >
                                         <div class="invalid-feedback">
                                             Please Enter Image Alt Tag!
                                         </div>
                                     </div>
                                 </div>
                             </div>
                                 
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="mb-3">
                                     <label class="form-label" for="button_text_${reviewIndex}">Button Text</label>
                                     <input type="text" name="button_text[]" class="form-control" id="button_text_${reviewIndex}" placeholder="Button Text"  required>
                                     <div class="invalid-feedback">
                                         Please provide a Button Text!
                                     </div> 
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="mb-3">
                                     <label class="form-label" for="button_url_${reviewIndex}">Button Url</label>
                                     <input type="text" name="button_url[]" class="form-control" id="button_url_${reviewIndex}" placeholder="Button Url"  required>
                                     <div class="invalid-feedback">
                                         Please provide a Button Url!
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