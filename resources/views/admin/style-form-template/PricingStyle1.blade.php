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
                                    <h4 class="card-title">Client Review 
                                        <button class="btn btn-danger float-right" style="float: right;" type="button" id="add-review">+ Add More</button>
                                    </h4>
                                </div>
                                   <div class="card-body">
                                        <div id="review-sections">
                
                                         <div class="row">
                                             <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_title">Plan Title</label>
                                                    <input type="text" name="plan_title[]" class="form-control" id="plan_title" placeholder="Plan Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Plan Title!
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_type">Plan Type</label>
                                                    <select name="plan_type[]" class="form-control" id="plan_type" required>
                                                        <option value="">Select Plan Type</option>
                                                        <option value="monthly">Monthly</option>
                                                        <option value="yearly">Yearly</option>
                                                    </select>
                                                 </div>
                                            </div>
                                              
                                         </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_button_text">Plan Button Text</label>
                                                    <input type="text" name="plan_button_text[]" class="form-control" id="plan_button_text" placeholder="Plan Button Text"  required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Plan Button Text!
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_button_url">Plan Button Url</label>
                                                    <input type="text" name="plan_button_url[]" class="form-control" id="plan_button_url" placeholder="Plan Button Url"  required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Plan Button Url!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_price">Plan Price</label>
                                                    <input type="number" name="plan_price[]" class="form-control"  id="plan_price" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Plan Price!
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                     <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer1">Plan Offer 1</label>
                                                <input type="text" name="plan_offer1[]" class="form-control" id="plan_offer1" placeholder="Plan Offer 1">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 1!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer2">Plan Offer 2</label>
                                                <input type="text" name="plan_offer2[]" class="form-control" id="plan_offer2" placeholder="Plan Offer 2">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 2!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer3">Plan Offer 3</label>
                                                <input type="text" name="plan_offer3[]" class="form-control" id="plan_offer3" placeholder="Plan Offer 3">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 3!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer4">Plan Offer 4</label>
                                                <input type="text" name="plan_offer4[]" class="form-control" id="plan_offer4" placeholder="Plan Offer 4">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 4!
                                                </div>
                                                 </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer5">Plan Offer 5</label>
                                                <input type="text" name="plan_offer5[]" class="form-control" id="plan_offer5" placeholder="Plan Offer 5">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 5!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer6">Plan Offer 6</label>
                                                <input type="text" name="plan_offer6[]" class="form-control" id="plan_offer6" placeholder="Plan Offer 6">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 6!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer7">Plan Offer 7</label>
                                                <input type="text" name="plan_offer7[]" class="form-control" id="plan_offer7" placeholder="Plan Offer 7">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 7!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer8">Plan Offer 8</label>
                                                <input type="text" name="plan_offer8[]" class="form-control" id="plan_offer8" placeholder="Plan Offer 8">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 8!
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
             $(this).find('.plan-title').attr('id', 'plan_title_' + idx);
             $(this).find('.plan-title').attr('name', 'plan_title[]');
             $(this).find('.plan-type').attr('id', 'plan_type_' + idx);
             $(this).find('.plan-type').attr('name', 'plan_type[]');
             $(this).find('.plan-button-text').attr('id', 'plan_button_text_' + idx);
             $(this).find('.plan-button-text').attr('name', 'plan_button_text[]');
             $(this).find('.plan-button-url').attr('id', 'plan_button_url_' + idx);
             $(this).find('.plan-button-url').attr('name', 'plan_button_url[]');
             $(this).find('.plan-price').attr('id', 'plan_price_' + idx);
             $(this).find('.plan-price').attr('name', 'plan_price[]');
             $(this).find('.plan-description').attr('id', 'plan_description_' + idx);
             $(this).find('.plan-description').attr('name', 'plan_description[]');
            
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
                                     <label class="form-label" for="plan_title_${reviewIndex}">Plan Title</label>
                                     <input type="text" name="plan_title[]" class="form-control" id="plan_title_${reviewIndex}" placeholder="Plan Title" required>
                                     <div class="invalid-feedback">
                                         Please Enter Plan Title!
                                     </div>
                                  </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="mb-3">
                                     <label class="form-label" for="plan_type_${reviewIndex}">Plan Type</label>
                                     <select name="plan_type[]" class="form-control" id="plan_type_${reviewIndex}" required>
                                         <option value="">Select Plan Type</option>
                                         <option value="monthly">Monthly</option>
                                         <option value="yearly">Yearly</option>
                                     </select>
                                  </div>
                             </div>
                               
                          </div>
                     <div class="row">
                         <div class="col-md-4">
                                 <div class="mb-3">
                                     <label class="form-label" for="plan_button_text_${reviewIndex}">Plan Button Text</label>
                                     <input type="text" name="plan_button_text[]" class="form-control" id="plan_button_text_${reviewIndex}" placeholder="Plan Button Text"  required>
                                     <div class="invalid-feedback">
                                         Please Enter Plan Button Text!
                                     </div>
                                  </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="mb-3">
                                     <label class="form-label" for="plan_button_url_${reviewIndex}">Plan Button Url</label>
                                     <input type="text" name="plan_button_url[]" class="form-control" id="plan_button_url_${reviewIndex}" placeholder="Plan Button Url"  required>
                                     <div class="invalid-feedback">
                                         Please Enter Plan Button Url!
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="mb-3">
                                     <label class="form-label" for="plan_price_${reviewIndex}">Plan Price</label>
                                     <input type="number" name="plan_price[]" class="form-control"  id="plan_price_${reviewIndex}" required>
                                     <div class="invalid-feedback">
                                         Please Enter Plan Price!
                                     </div>
                                  </div>
                             </div>
                         </div>
                     <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer1_${reviewIndex}">Plan Offer 1</label>
                                                <input type="text" name="plan_offer1[]" class="form-control" id="plan_offer1_${reviewIndex}" placeholder="Plan Offer 1">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 1!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer2_${reviewIndex}">Plan Offer 2</label>
                                                <input type="text" name="plan_offer2[]" class="form-control" id="plan_offer2_${reviewIndex}" placeholder="Plan Offer 2">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 2!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer3_${reviewIndex}">Plan Offer 3</label>
                                                <input type="text" name="plan_offer3[]" class="form-control" id="plan_offer3_${reviewIndex}" placeholder="Plan Offer 3">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 3!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer4_${reviewIndex}">Plan Offer 4</label>
                                                <input type="text" name="plan_offer4[]" class="form-control" id="plan_offer4_${reviewIndex}" placeholder="Plan Offer 4">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 4!
                                                </div>
                                                 </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer5_${reviewIndex}">Plan Offer 5</label>
                                                <input type="text" name="plan_offer5[]" class="form-control" id="plan_offer5_${reviewIndex}" placeholder="Plan Offer 5">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 5!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer6_${reviewIndex}">Plan Offer 6</label>
                                                <input type="text" name="plan_offer6[]" class="form-control" id="plan_offer6_${reviewIndex}" placeholder="Plan Offer 6">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 6!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer7_${reviewIndex}">Plan Offer 7</label>
                                                <input type="text" name="plan_offer7[]" class="form-control" id="plan_offer7_${reviewIndex}" placeholder="Plan Offer 7">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 7!
                                                </div>
                                                 </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plan_offer8_${reviewIndex}">Plan Offer 8</label>
                                                <input type="text" name="plan_offer8[]" class="form-control" id="plan_offer8_${reviewIndex}" placeholder="Plan Offer 8">
                                                <div class="invalid-feedback">
                                                    Please Enter Plan Offer 8!
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