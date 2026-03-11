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
                                                    <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                    <input type="text" name="highlighted_title" class="form-control" id="highlighted_title" placeholder="Highlighted Title"  required>
                                                     <div class="invalid-feedback">
                                                        Please Enter Highlighted Title!
                                                    </div>   
                                                </div>
                                            </div>
                                              
                                        </div>
                                       

                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Question Title</label>
                                                    <input type="text" name="question_title" class="form-control" id="question_title" placeholder="Question Title"  required>
                                                     <div class="invalid-feedback">
                                                        Please Enter Question Title!
                                                    </div>   
                                                </div>
                                            </div>
                                               <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="answer_title">Answer Title</label>
                                                    <input type="text" name="answer_title" class="form-control" id="answer_title" placeholder="Answer Title"  required>
                                                     <div class="invalid-feedback">
                                                        Please Enter Answer Title!
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                      

                                  
                                       
                            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                <div class="card-header">
                                    <h4 class="card-title">Faq Step
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                
                                          <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_title">Question</label>
                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Question"  required>
                                                        <div class="invalid-feedback">
                                                            Please Enter Question!
                                                        </div>
                                                    </div>
                                                </div>
                                             </div> 
                                    
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Answer</label>
                                                        <textarea type="text" class="form-control" name="step_description[]" id="step_description" placeholder="Answer" rows="2"  required></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Answer!
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
                                                        <label class="form-label" for="step_title">Question</label>
                                                        <input type="text" class="form-control" name="step_title[]" id="step_title" placeholder="Question"  required>
                                                        <div class="invalid-feedback">
                                                            Please Enter Question!
                                                        </div>
                                                    </div>
                                                </div>
                                             </div> 
                                    
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="step_description">Answer</label>
                                                        <textarea type="text" class="form-control" name="step_description[]" id="step_description" placeholder="Answer" rows="2"  required></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Answer!
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