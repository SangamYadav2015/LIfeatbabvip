<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title">Banner
                                                        Title</label>
                                                    <input type="text" class="form-control" name="banner_title"
                                                        id="banner_title" placeholder="Banner Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Title!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="trusted_title">Trusted Title</label>
                                                    <input type="text" class="form-control" name="trusted_title"
                                                        id="trusted_title" placeholder="Trusted Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Trusted Title!
                                                    </div>
                                                </div>
                                            </div>
                                         </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="banner_image">Banner Image </label><span
                                                            class="text-small text-danger">( Image size must be 744 x
                                                            717px )</span>
                                                        <input type="file" name="banner_image" class="form-control image-check"
                                                            id="banner_image" required data-height="717"
                                                            data-width="744">
                                                        <div class="img-alert"></div>
                                                        <div class="invalid-feedback">
                                                            Please Choose Banner Image!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="banner_image_alt_tag">Banner Image Alt Tag </label>
                                                        <input type="text" name="banner_image_alt_tag" class="form-control"
                                                            id="banner_image_alt_tag" placeholder="Banner Image Alt Tag"  required >
                                                        <div class="invalid-feedback">
                                                            Please Enter Banner Image Alt Tag!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button Text</label>
                                                    <input type="text" class="form-control" id="button_text"
                                                        name="button_text" placeholder="Button Text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button Url</label>
                                                    <input type="text" class="form-control" name="button_url"
                                                        id="button_url" placeholder="Button Url" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="video_button_text">Video Button Text</label>
                                                    <input type="text" class="form-control" name="video_button_text"
                                                        id="video_button_text" placeholder="Video Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="video_button_link">Video Button Url</label>
                                                    <input type="url" class="form-control" name="video_button_link"
                                                        id="video_button_link" placeholder="Video Button Url">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="banner_image">Our Top Client</label><span
                                                    class="text-small text-danger">( Image size must be 160 x
                                                    64 px  and Max 3 images are allowed)</span>
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
                                                    <label class="form-label" for="banner_description">Banner
                                                        Description</label>
                                                    <textarea type="text" class="form-control" id="banner_description"
                                                        placeholder="Banner Description"name="banner_description" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Description!
                                                    </div>
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