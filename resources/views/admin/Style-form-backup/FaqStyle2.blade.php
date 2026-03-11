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
                                                    <label class="form-label" for="subtitle">Subtitle</label>
                                                    <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Subtitle"  required>  
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
                                                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" rows="3"  required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Description!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                            <div class="card card  bg-gradient" style="background-color: rgb(220 221 225) !important;">
                                <div class="card-header">
                                    <h4 class="card-title">Faq Steps
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                                         <div class="row">
                                           <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="faq_question">FAQ Question</label>
                                                        <input type="text"  name="faq_question[]" class="form-control" id="faq_question" required>
                                                     </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <div class="mb-3">
                                                       <label class="form-label" for="faq_answer">FAQ Answer</label>
                                                        <textarea name="faq_answer[]" class="form-control" id="faq_answer" required></textarea>
                                                     </div>
                                                </div>
                                            </div>    
                                    </div>
                                    </div>
                                </div>

 <script>
        $(document).ready(function() {
     var maxReviews = 12;
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
                                     <label class="form-label" for="faq_question_${reviewIndex}">FAQ Question</label>
                                     <input type="text"  name="faq_question[]" class="form-control" id="faq_question_${reviewIndex}" required>
                                  </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="mb-3">
                                    <label class="form-label" for="faq_answer_${reviewIndex}">FAQ Answer</label>
                                     <textarea name="faq_answer[]" class="form-control" id="faq_answer_${reviewIndex}" required></textarea>
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