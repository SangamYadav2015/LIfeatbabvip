<div class="row">
                                            <div class="col-md-12">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_title">Banner Title</label>
                                                      <input type="text" class="form-control" id="banner_title"  name="banner_title" placeholder="Banner Title"  required>
                                                      <div class="invalid-feedback">
                                                          Please Enter Banner Title!
                                                      </div> 
                                                  </div>
                                              </div>
                                         </div>
                                         <div class="row">
                                               <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label" for="banner_bg_image">Banner BG 
                                                      Image</label><span class="text-small text-danger">( Image size must be 1340 x 250 px )</span>
                                                  <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required  data-width="1340" data-height="250">
                                                      <div class="img-alert"></div>
                                                  <div class="invalid-feedback">
                                                      Please Choose Banner BG Image!
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_bg_img_alt">Banner BG Image Alt Tag</label>
                                                      <input type="text" class="form-control" id="banner_bg_img_alt"  name="banner_bg_img_alt" placeholder="Banner BG Image Alt Tag"  required>
                                                      <div class="invalid-feedback">
                                                          Please Enter Banner BG Image Alt Tag!
                                                      </div> 
                                                  </div>
                                              </div>
                                       </div>   
                                           
                                           <div class="row">
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_image1">Banner 
                                                          Image 1</label><span class="text-small text-danger">( Image size must be 433 x 871 px )</span>
                                                      <input type="file" name="banner_image1" class="form-control image-check" id="banner_image1" required  data-width="433" data-height="871">
                                                          <div class="img-alert"></div>
                                                      <div class="invalid-feedback">
                                                          Please Choose Banner 1 Image!
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_image1_alt_tag">Banner Image1 Alt Tag</label>
                                                      <input type="text" class="form-control" id="banner_image1_alt_tag"  name="banner_image1_alt_tag" placeholder="Banner Image1 Alt Tag"  required>
                                                      <div class="invalid-feedback">
                                                          Please Enter Banner Image1 Alt Tag!
                                                      </div> 
                                                  </div>
                                              </div>
                                              </div>
                                              <div class="row">
                                              <div class="col-md-6">    
                                                  <div class="mb-3">
                                                          <label class="form-label" for="banner_image2">Banner Image 2</label><span class="text-small text-danger">( Image size must be 1234 x 720 px )</span>
                                                          <input type="file" name="banner_image2" class="form-control image-check"  id="banner_image2" required  data-width="1234" data-height="720">
                                                          <div class="img-alert"></div>
                                                          <div class="invalid-feedback">
                                                              Please Choose Banner 2 Image!
                                                          </div> 
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_image2_alt_tag">Banner Image2 Alt Tag</label>
                                                      <input type="text" class="form-control" id="banner_image2_alt_tag"  name="banner_image2_alt_tag" placeholder="Banner Image2 Alt Tag"  required>
                                                      <div class="invalid-feedback">
                                                          Please Enter Banner Image2 Alt Tag!
                                                      </div> 
                                                  </div>
                                              </div>
                                           </div>
                                        <div class="row">
                                               <div class="col-md-12">
                                                  <div class="mb-3">
                                                      <label class="form-label" for="banner_description">Banner Description</label>
                                                      <textarea type="text" class="form-control" id="banner_description" name="banner_description"  placeholder="Banner Description" rows="3" required></textarea> 
                                                       <div class="invalid-feedback">
                                                          Please Enter Banner Description!
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