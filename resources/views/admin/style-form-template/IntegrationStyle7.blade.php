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
                                                     <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                     <input type="text" class="form-control" id="highlighted_title" name="highlighted_title" placeholder="Highlighted Title"  required>
                                                     <div class="invalid-feedback">
                                                         Please Enter Highlighted Title!
                                                     </div>
                                                 </div>
                                             </div> 
                                               <div class="col-md-4">
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
                                                <label class="form-label" for="banner_image">Banner 
                                                    Image</label><span class="text-small text-danger">( Image size must be 1021 x 338 px )</span>
                                                <input type="file" name="banner_image" class="form-control image-check" id="banner_image" required  data-width="1021" data-height="338">
                                                <div class="img-alert"></div>
                                                <div class="invalid-feedback">
                                                    Please Choose Banner Image!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">    
                                            <div class="mb-3">
                                                    <label class="form-label" for="banner_image_alt_tag">Banner Image Alt Tag</label>
                                                    <input type="text" name="banner_image_alt_tag" class="form-control"  id="banner_image_alt_tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner  Alt Tag!
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