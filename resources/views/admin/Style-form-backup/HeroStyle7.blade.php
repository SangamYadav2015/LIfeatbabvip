<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title">Banner Title</label>
                                                    <input type="text" class="form-control" name="banner_title" id="banner_title" placeholder="Title"  required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Title!
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="trusted_title">Trusted Company Title</label>
                                                    <input type="text" class="form-control" name="trusted_title" id="trusted_title" placeholder="Trusted Comapany Title"  required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Trusted Company Title!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="banner_bg_image">Banner 
                                                          BG  Image</label><span class="text-small text-danger">( Image size must be 1340 x 250 px )</span>
                                                        <input type="file" name="banner_bg_image" class="form-control image-check" id="banner_bg_image" required  data-width="1340" data-height="250">
                                                            <div class="img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose Banner BG Image!
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="banner_img1_alt_tag">Banner Image 1 Alt Tag</label>
                                                        <input type="text" class="form-control" name="banner_img1_alt_tag" id="banner_img1_alt_tag" placeholder="Banner Image 1 Alt Tag" >
                                                        <div class="invalid-feedback">
                                                            Please Enter Banner Image 1 Alt Tag!
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_image">Banner 
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
                                                    <label class="form-label" for="banner_img1_alt_tag">Banner Image 1 Alt Tag</label>
                                                    <input type="text" class="form-control" name="banner_img1_alt_tag" id="banner_img1_alt_tag" placeholder="Banner Image 1 Alt Tag" >
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Image 1 Alt Tag!
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
                                                    <label class="form-label" for="banner_img2_alt_tag">Banner Image 2 Alt Tag</label>
                                                    <input type="text" class="form-control" name="banner_img2_alt_tag" id="banner_img2_alt_tag" placeholder="Banner Image 2 Alt Tag" >
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Image 2 Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                        
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="banner_image">Our Top Client</label><span
                                                    class="text-small text-danger">( Image size must be 160 x
                                                    64 px  and Max 8 images are allowed)</span>
                                                    <input type="file" class="form-control" name="top_client_image[]"
                                                        id="top_client_image" multiple data-height="64" data-width="160"
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
                                        <textarea type="text" class="form-control" id="banner_description" name="banner_description" placeholder="Description" rows="3" required></textarea>  
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
            var maxFiles = 8;
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
                altHtml +='<input type="text" class="form-control" name="icon_alt_tag[]" id="button_url" placeholder="Icon '+parseInt(i + 1)+' Alt Tag">';
                altHtml +='<div class="invalid-feedback">Please Enter Icon'+ parseInt(i + 1) +' Alt Tag!</div>';
                altHtml +='</div></div>';
            }
             altHtml +='</div>';

            $("#client_icon_alt_tag").html(altHtml);
        });
    </script>