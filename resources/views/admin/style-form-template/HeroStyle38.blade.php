<div class="row">
                                            <div class="col-md-12">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="title">Title</label>
                                                     <input type="text" class="form-control" id="title" name="title" placeholder="Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_bg_image">Banner BG
                                                    Image</label><span class="text-small text-danger">( Image size must be 1917 x 578 px )</span>
                                                <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required  data-width="1917" data-height="578">
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
                                                <label class="form-label" for="banner_image">Banner
                                                    Image</label><span class="text-small text-danger">( Image size must be 719 x 540 px )</span>
                                                <input type="file" name="banner_image" class="form-control image-check" id="banner_image" required  data-width="719" data-height="540">
                                                <div class="img-alert"></div>
                                                <div class="invalid-feedback">
                                                    Please Choose Banner Image!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="banner_image_alt_tag">Banner
                                                    Image Alt Tag</label>
                                                     <input type="text" class="form-control" id="banner_image_alt_tag" name="banner_image_alt_tag" placeholder="Banner
                                                    Image Alt Tag" >
                                                 </div>
                                             </div> 
                                      </div>
                                      <div class="row">
                                         <div class="col-md-12">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="description">Description</label>
                                                     <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                                                    <div class="invalid-feedback">
                                                            Please Enter Description!
                                                    </div>
                                                 </div>
                                             </div> 
                                      </div>

                                 <div class="row">
                                            <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step1_title">Step 1 Title</label>
                                                     <input type="text" class="form-control" id="step1_title" name="step1_title" placeholder="Step 1 Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Step 1 Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                            
                                               <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step1_sub_title">Step 1 SubTitle</label>
                                                     <input type="text" class="form-control" id="step1_sub_title" name="step1_sub_title" placeholder="Step 1 SubTitle"  required>
                                                     <div class="invalid-feedback">
                                                         Please Enter Step 1 SubTitle!
                                                     </div>
                                                 </div>
                                             </div> 
                                        </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step2_title">Step 2 Title</label>
                                                     <input type="text" class="form-control" id="step2_title" name="step2_title" placeholder="Step 2 Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Step 2 Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                            
                                               <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step2_sub_title">Step 2 SubTitle</label>
                                                     <input type="text" class="form-control" id="step2_sub_title" name="step2_sub_title" placeholder="Step 2 SubTitle"  required>
                                                     <div class="invalid-feedback">
                                                         Please Enter Step 2 SubTitle!
                                                     </div>
                                                 </div>
                                             </div> 
                                        </div>

                                             <div class="row">
                                            <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step3_title">Step 3 Title</label>
                                                     <input type="text" class="form-control" id="step3_title" name="step3_title" placeholder="Step 3 Title"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Step 3 Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                            
                                               <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="step3_sub_title">Step 3 SubTitle</label>
                                                     <input type="text" class="form-control" id="step3_sub_title" name="step3_sub_title" placeholder="Step 3 SubTitle"  required>
                                                     <div class="invalid-feedback">
                                                         Please Enter Step 3 SubTitle!
                                                     </div>
                                                 </div>
                                             </div> 
                                        </div>
                                     
                                           
                              
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