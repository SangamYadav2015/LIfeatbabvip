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
                                                     <label class="form-label" for="subtitle">Subtitle</label>
                                                     <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle"  required>
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
                                    <h4 class="card-title">Services 
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                
                                             <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="service_title">Service Title</label>
                                                        <input type="text" name="service_title[]" class="form-control" id="service_title" placeholder="Service Title" required>
                                                        <div class="invalid-feedback">
                                                            Please provide a Service Title!
                                                        </div>
                                                     </div>
                                                </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_image_icon">Service Image Icon 
                                                        </label><span class="text-small text-danger">( Image size must be 90 x 90 px )</span>
                                                    <input type="file" name="service_image_icon[]" class="form-control image-check" id="service_image_icon" required  data-width="90" data-height="90">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Service Image Icon!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_image_icon_alt_tag">Service Image Icon Alt Tag </label>
                                                    <input type="text" name="service_image_icon_alt_tag[]" class="form-control image-check" id="service_image_icon_alt_tag" >
                                                    <div class="invalid-feedback">
                                                        Please Enter Service Image Icon Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>


                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="link_text">Link Text</label>
                                                        <input type="text" name="link_text[]" class="form-control" id="link_text" placeholder="Link Text" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Link Text!
                                                        </div>
                                                     </div>
                                                </div>
                                           
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="link_url">Link Url</label>
                                                    <input type="text" name="link_url[]" class="form-control image-check" id="link_url" placeholder="">
                                                    <div class="invalid-feedback">
                                                        Please Enter Link URL!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>


                                               <div class="row">
                                                <div class="col-md-12">
                                                <div class="mb-3">
                                                <label class="form-label" for="service_description">Service Description</label>
                                                <textarea type="text" name="service_description[]" class="form-control" id="service_description" placeholder="Service Description" required></textarea>
                                                 <div class="invalid-feedback">
                                                    Please Choose Service Description!
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
             $(this).find('.service-title').attr('id', 'service_title_' + idx);
             $(this).find('.service-title').attr('name', 'service_title[]');
             $(this).find('.service-image-icon').attr('id', 'service_image_icon_' + idx);
             $(this).find('.service-image-icon').attr('name', 'service_image_icon[]');
             $(this).find('.service-description').attr('id', 'service_description_' + idx);
             $(this).find('.service-description').attr('name', 'service_description[]');
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
                                     <label class="form-label" for="service_title_${reviewIndex}">Service Title</label>
                                     <input type="text" name="service_title[]" class="form-control" id="service_title_${reviewIndex}" placeholder="Service Title" required>
                                     <div class="invalid-feedback">
                                         Please provide a Service Title!
                                     </div>
                                  </div>
                             </div>
                         <div class="col-md-4">
                             <div class="mb-3">
                                 <label class="form-label" for="service_image_icon_${reviewIndex}">Service Image Icon 
                                     </label><span class="text-small text-danger">( Image size must be 90 x 90 px )</span>
                                 <input type="file" name="service_image_icon[]" class="form-control image-check" id="service_image_icon_${reviewIndex}" required  data-width="90" data-height="90">
                                 <div class="img-alert"></div>
                                 <div class="invalid-feedback">
                                     Please Choose Service Image Icon!
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="mb-3">
                                 <label class="form-label" for="service_image_icon_alt_tag_${reviewIndex}">Service Image Icon Alt Tag </label>
                                 <input type="text" name="service_image_icon_alt_tag[]" class="form-control image-check" id="service_image_icon_alt_tag_${reviewIndex}" >
                                 <div class="invalid-feedback">
                                     Please Enter Service Image Icon Alt Tag!
                                 </div>
                             </div>
                         </div>
                         </div>
                         
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="link_text_${reviewIndex}">Link Text</label>
                                                        <input type="text" name="link_text[]" class="form-control" id="link_text_${reviewIndex}" placeholder="Link Text" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Link Text!
                                                        </div>
                                                     </div>
                                                </div>
                                           
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="link_url_${reviewIndex}">Link Url</label>
                                                    <input type="text" name="link_url[]" class="form-control image-check" id="link_url_${reviewIndex}" placeholder="">
                                                    <div class="invalid-feedback">
                                                        Please Enter Link URL!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                            <div class="row">
                             <div class="col-md-12">
                                 <div class="mb-3">
                                 <label class="form-label" for="service_description_${reviewIndex}">Service Description</label>
                                 <textarea type="text" name="service_description[]" class="form-control" id="service_description_${reviewIndex}" placeholder="Service Description" required></textarea>
                                  <div class="invalid-feedback">
                                     Please Choose Service Description!
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