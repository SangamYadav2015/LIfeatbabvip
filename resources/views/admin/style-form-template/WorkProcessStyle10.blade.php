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
                                                    <label class="form-label" for="title">Subtitle</label>
                                                    <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Subtitle"  required>
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
                                                    <textarea name="description" class="form-control" id="description" placeholder="Description"  required></textarea>
                                                     <div class="invalid-feedback">
                                                        Please Enter Description!
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                       
                            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                <div class="card-header">
                                    <h4 class="card-title"> 
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
                                    
                                        <div class="row">
                                           <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Step Description</label>
                                                        <textarea class="form-control" name="step_description[]" id="step_description" placeholder="Step Description"  required></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Step Description!
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                        
                                       
                                             
                                    </div>
                                    </div>
                                </div>          
                             <script>
        $(document).ready(function() {
     var maxReviews =3;
     var reviewIndex = 1;
 
     // Function to update indexes and IDs
     function updateIndexes() {
         $('.review-section').each(function(index) {
             var idx = index + 1;
             $(this).find('.step-subtitle').attr('id', 'step_title_' + idx);
             $(this).find('.step-subtitle').attr('name', 'step_title[]');
             $(this).find('.step-image-icon').attr('id', 'step_image_icon_' + idx);
             $(this).find('.step-image-icon').attr('name', 'step_image_icon[]');
             $(this).find('.step-description').attr('id', 'step_description_' + idx);
             $(this).find('.step-description').attr('name', 'step_description[]');
            
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
                                                        <label class="form-label" for="step_title">Step Title</label>
                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Step Title"  required>
                                                        <div class="invalid-feedback">
                                                            Please Enter Step Title!
                                                        </div>
                                                    </div>
                                                </div>
                                             </div> 
                                    
                                        <div class="row">
                                           <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Step Description</label>
                                                        <textarea class="form-control" name="step_description[]" id="step_description" placeholder="Step Description"  required></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Step Description!
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