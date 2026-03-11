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
                                            <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="title1">Title 1</label>
                                                     <input type="text" class="form-control" id="title1" name="title1" placeholder="Title 1"  required>
                                                      <div class="invalid-feedback">
                                                         Please Enter Title 1!
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
                                       
                                    <div class="row">
                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="image1">
                                                    Image 1</label><span class="text-small text-danger">( Image size must be 537 x 537 px )</span>
                                                <input type="file" name="image1" class="form-control image-check" id="image1" required  data-width="537" data-height="537">
                                                <div class="img-alert"></div>
                                                <div class="invalid-feedback">
                                                    Please Choose Image 1!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="image1_alt_tag">
                                                    Image 1 Alt Tag</label>
                                                     <input type="text" class="form-control" id="image1_alt_tag" name="image1_alt_tag" placeholder="Image 1 Alt Tag" >
                                                 </div>
                                             </div> 
                                      </div>

                                      <div class="row">
                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="image2">
                                                    Image 2</label><span class="text-small text-danger">( Image size must be 341 x 341 px )</span>
                                                <input type="file" name="image2" class="form-control image-check" id="image2" required  data-width="341" data-height="341">
                                                <div class="img-alert"></div>
                                                <div class="invalid-feedback">
                                                    Please Choose Image 2!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="image2_alt_tag">
                                                    Image 2 Alt Tag</label>
                                                     <input type="text" class="form-control" id="image2_alt_tag" name="image2_alt_tag" placeholder="Image 2 Alt Tag" >
                                                 </div>
                                             </div> 
                                      </div>

                                     
                                      <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button1_text">Button 1 Text</label>
                                                    <input type="text" class="form-control" id="button1_text" name="button1_text" placeholder="Button 1 Text" required="">
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 1 Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button1_url">Button 1 Url</label>
                                                    <input type="text" class="form-control" name="button1_url" id="button1_url" placeholder="Button 1 Url" required="">
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 1 Url!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button2_text">Button 2 Text</label>
                                                    <input type="text" class="form-control" id="button2_text" name="button2_text" placeholder="Button 2 Text" required="">
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 2 Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button1_url">Button 2 Url</label>
                                                    <input type="text" class="form-control" name="button2_url" id="button2_url" placeholder="Button 2 Url" required="">
                                                    <div class="invalid-feedback">
                                                        Please Choose Button 2 Url!
                                                    </div>
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