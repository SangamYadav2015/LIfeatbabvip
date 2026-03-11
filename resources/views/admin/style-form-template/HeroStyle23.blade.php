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
                                           
                                           <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="subscription_title">Subscription Title</label>
                                                    <input type="text" name="subscription_title" class="form-control"
                                                        id="subscription_title" placeholder="Subscription Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Subscription Title!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_image">Banner
                                                        Image</label><span class="text-small text-danger">( Image size
                                                        must be 511 x 465 px )</span>
                                                    <input type="file" name="banner_image"
                                                        class="form-control image-check" id="banner_image" required
                                                         data-width="511" data-height="465">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Banner Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_1_image_alt_tag">Banner Image 1
                                                        Alt Tag</label>
                                                    <input type="text" name="banner_1_image_alt_tag" class="form-control"
                                                        id="banner_1_image_alt_tag" placeholder="Banner Image 1 Alt Tag"
                                                        >
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Image 1</label><span class="text-small text-danger">( Image size
                                                        must be 725 x 507 px )</span>
                                                    <input type="file" name="image1"
                                                        class="form-control image-check" id="image1" required
                                                         data-width="725" data-height="507">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 1!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1_alt_tag">Image 1
                                                        Alt Tag</label>
                                                    <input type="text" name="image1_alt_tag" class="form-control"
                                                        id="image1_alt_tag" placeholder="Image 1 Alt Tag"
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2">Image 2</label><span class="text-small text-danger">( Image size
                                                        must be 115 x 109 px )</span>
                                                    <input type="file" name="image2"
                                                        class="form-control image-check" id="image2" required
                                                         data-width="115" data-height="109">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 2!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1_alt_tag">Image 2
                                                        Alt Tag</label>
                                                    <input type="text" name="image2_alt_tag" class="form-control"
                                                        id="image2_alt_tag" placeholder="Image 2 Alt Tag"
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                      



                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_text1">Step Text 1</label>
                                                    <input type="text" name="step_text1" class="form-control"
                                                        id="step_text1" placeholder="Step Text 1" value="">
                                                </div>
                                            </div>

                                              <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_text2">Step Text 2</label>
                                                    <input type="text" name="step_text2" class="form-control"
                                                        id="step_text2" placeholder="Step Text 2" value="">
                                                </div>
                                            </div>

                                              <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="step_text3">Step Text 3</label>
                                                    <input type="text" name="step_text3" class="form-control"
                                                        id="step_text3" placeholder="Step Text 3" value="">
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