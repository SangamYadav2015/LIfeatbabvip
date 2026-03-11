<div class="row">
                                            <div class="col-md-4">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="title">Title</label>
                                                     <input type="text" class="form-control" id="title" name="title" placeholder="Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Title!
                                                     </div>
                                                     
                                                 </div>
                                             </div> 
                                               <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image"> 
                                                        Image</label><span class="text-small text-danger">( Image size must be 1280 x 965 px )</span>
                                                    <input type="file" name="image" class="form-control image-check" id="image" required  data-width="1280" data-height="965">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">    
                                                <div class="mb-3">
                                                        <label class="form-label" for="image_alt_tag">Image Alt Tag</label>
                                                        <input type="text" name="image_alt_tag" class="form-control"  id="image_alt_tag">
                                                        <div class="invalid-feedback">
                                                            Please Enter  Alt Tag!
                                                        </div> 
                                                </div>
                                            </div>
                                        </div>
                                
                                           <div class="row">
                                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text1">Button 1 Text</label>
                                                    <input type="text" class="form-control" id="button_text1" name="button_text1" placeholder="Button Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 1 Text!
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url1">Button 1 Url</label>
                                                    <input type="text" class="form-control" name="button_url1" id="button_url1" placeholder="Button Url"  required>
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 1 Url!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                              
                                            <div class="row">
                                               <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text2">Button 2 Text</label>
                                                    <input type="text" class="form-control" id="button_text2" name="button_text2" placeholder="Button Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 2 Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url1">Button 2 Url</label>
                                                    <input type="text" class="form-control" name="button_url2" id="button_url2" placeholder="Button Url"  required>
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 2 Url!
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
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="step_title">Step Title</label>
                                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Step Title"  required>
                                                                        <div class="invalid-feedback">
                                                                            Please Enter Step Title!
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                             </div> 
                                                             
                                                    </div>
                                                    </div>
                                                </div>          
                                             

<script>
 $(document).ready(function() {
     var maxReviews = 5;
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
                         <div class="col-md-12">
                             <div class="mb-3">
                                 <label class="form-label" for="step_title_${reviewIndex}">Step Title</label>
                                 <input type="text" class="form-control" name="step_title[]" id="step_title_${reviewIndex}" placeholder="Step Title"  required>
                                 <div class="invalid-feedback">
                                     Please Enter Step Title!
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