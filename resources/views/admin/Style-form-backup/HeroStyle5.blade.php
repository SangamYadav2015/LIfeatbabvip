<div class="row">
                                            <div class="col-md-12">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="banner_title">Banner Title</label>
                                                       <input type="text" class="form-control" id="banner_title" name="banner_title" placeholder="Banner Title"  required>
                                                       <div class="invalid-feedback">
                                                           Please Enter Banner Title!
                                                       </div> 
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="banner_image">Banner BG Image </label><span
                                                            class="text-small text-danger">( Image size must be 876 x
                                                            690 px )</span>
                                                        <input type="file" name="banner_bg_image" class="form-control image-check"
                                                            id="banner_bg_image" required data-height="690"
                                                            data-width="876">
                                                        <div class="banner-img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose Banner Image!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_bg_img_alt">Banner BG Image Alt Tag</label>
                                                    <input type="text" class="form-control" id="banner_bg_img_alt" name="banner_bg_img_alt" placeholder="Banner BG Image Alt Tag" >
                                                    <div class="invalid-feedback">
                                                        Please Banner BG Image Alt Tag!
                                                    </div> 
                                                </div>
                                            </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="button_text1">Button 1 Text</label>
                                                       <input type="text" class="form-control" id="button_text1" name="button_text1" placeholder="Button 1 Text"  required>
                                                         <div class="invalid-feedback">
                                                           Please Enter Button 1 Text!
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="button_url1">Button 1 Url</label>
                                                       <input type="text" class="form-control" id="button_url1" name="button_url1"  placeholder="Button Url"  required>
                                                        <div class="invalid-feedback">
                                                           Please Enter Button 1 Url!
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="button_text2">Button 2 Text</label>
                                                       <input type="text" class="form-control" id="button_text2" name="button_text2" placeholder="Button 2 Text"  required>
                                                        <div class="invalid-feedback">
                                                           Please Enter Button 2 Text!
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="button_url2">Button 2 Url</label>
                                                       <input type="text" class="form-control" id="button_url2" name="button_url2" placeholder="Button 2 Url"  required>
                                                        <div class="invalid-feedback">
                                                           Please Enter Button 2 Url!
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="banner_image">Banner 
                                                           Image </label><span class="text-small text-danger">( Image size must be 620 x 646 px )</span>
                                                       <input type="file" name="banner_image" class="form-control image-check" id="banner_image" required  data-width="620" data-height="646">
                                                           <div class="img-alert"></div>
                                                       <div class="invalid-feedback">
                                                           Please Choose Banner Image!
                                                       </div>
                                                   </div>
                                               </div>
                                              
                                               <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_img_alt">Banner Image Alt Tag</label>
                                                    <input type="text" class="form-control" id="banner_img_alt" name="banner_img_alt" placeholder="Banner Image Alt Tag" >
                                                    <div class="invalid-feedback">
                                                        Please Banner Image Alt Tag!
                                                    </div> 
                                                </div>
                                            </div>
                                           </div>
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="banner_image">Our Top Client</label><span
                                                    class="text-small text-danger">( Image size must be 129 x
                                                    72 px  and Max 3 images are allowed)</span>
                                                    <input type="file" class="form-control" name="top_client_image[]"
                                                        id="top_client_image" multiple data-height="72" data-width="129"
                                                        accept="image/*">
                                                    <div class="top-client-img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Top Client Images!
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="client_icon_alt_tag"></div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                   <div class="mb-3">
                                                       <label class="form-label" for="banner_description">Banner Description</label>
                                                       <textarea type="text" class="form-control" name="banner_description"  id="banner_description" placeholder="Banner Description" rows="3" required></textarea> 
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

        $('#top_client_image').on('change', function () {
            var files = $(this)[0].files;
            var maxFiles = 3;
            if (files.length > maxFiles) {
                $(".top-client-img-alert").html('<span class="text-danger">You can only upload a maximum of ' + maxFiles + ' images.</span>');
                $(this).val('');
                return;
            }
            altHtml ='<div class="row">';
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var naturalWidth = this.naturalWidth;
                        var naturalHeight = this.naturalHeight;
                        var expectedWidth = parseInt($('#top_client_image').data('width'));
                        var expectedHeight = parseInt($('#top_client_image').data('height'));
                   if (naturalWidth !== expectedWidth || naturalHeight !== expectedHeight) {
                            $(".top-client-img-alert").html('<span class="text-danger">Image dimensions do not match expected values (' + expectedWidth + 'x' + expectedHeight + ').</span>');
                            $('#top_client_image').val('');
                            return;
                        }
                    };
                };

                reader.readAsDataURL(file);
                altHtml +='<div class="col-md-4">';
                altHtml +='<div class="mb-3">';
                altHtml +='<label class="form-label" for="button_url">Icon '+ parseInt(i + 1)+' Alt Tag</label>';
                altHtml +='<input type="text" class="form-control" name="icon_alt_tag[]" id="button_url" placeholder="Icon '+parseInt(i + 1)+' Alt Tag" required>';
                altHtml +='<div class="invalid-feedback">Please Enter Icon'+ parseInt(i + 1) +' Alt Tag!</div>';
                altHtml +='</div></div>';
            }
             altHtml +='</div>';

            $("#client_icon_alt_tag").html(altHtml);
        });
    </script>