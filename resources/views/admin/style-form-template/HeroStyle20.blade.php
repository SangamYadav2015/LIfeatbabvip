<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title">Banner Title</label>
                                                    <input type="text" name="banner_title" class="form-control"
                                                        id="banner_title" placeholder="Banner Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Title!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="highlighted_title">Highlighted Title</label>
                                                    <input type="text" name="highlighted_title" class="form-control"
                                                        id="highlighted_title" placeholder="Highlighted Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Highlighted Title!
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                     

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_image">Banner
                                                        Image</label><span class="text-small text-danger">( Image size
                                                        must be 506 x 512 px )</span>
                                                    <input type="file" name="banner_image"
                                                        class="form-control image-check" id="banner_image" required
                                                         data-width="506" data-height="512">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Banner Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_1_image_alt_tag">Banner Image
                                                        Alt Tag</label>
                                                    <input type="text" name="banner_1_image_alt_tag" class="form-control"
                                                        id="banner_1_image_alt_tag" placeholder="Banner Image Alt Tag"
                                                        >
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="you_tube_url">You Tube Video URL</label>
                                                    <input type="text" class="form-control" id="you_tube_url" name="you_tube_url"
                                                        placeholder="You Tube Video URL">
                                                </div>
                                            </div>
                                        </div>
                                       



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button  Text</label>
                                                    <input type="text" name="button_text" class="form-control"
                                                        id="button_text" placeholder="Button Text" value="">
                                                    <div class="invalid-feedback">
                                                        Please Enter Button Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button URL</label>
                                                    <input type="text" class="form-control" id="button_url" name="button_url"
                                                        placeholder="Button URL">
                                                   
                                                </div>
                                            </div>
                                        </div>


                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_description">Banner
                                                        Description</label>
                                                    <textarea type="text" class="form-control" id="banner_description"
                                                        name="banner_description" placeholder="Banner Description"
                                                        required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Banner Description!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <script>
                                            $(document).ready(function () {
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