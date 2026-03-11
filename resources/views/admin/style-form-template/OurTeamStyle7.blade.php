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
                                                    <label class="form-label" for="sub_title">Subtitle</label>
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
                                                    <label class="form-label" for="banner_bg_image">Banner BG 
                                                        Image</label><span class="text-small text-danger">( Image size must be 1920 x 468 px )</span>
                                                    <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required data-width="1920" data-height="468" >
                                                        <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Banner BG Image!
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