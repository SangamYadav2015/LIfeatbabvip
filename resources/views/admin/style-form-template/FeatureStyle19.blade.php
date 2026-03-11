<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title1">Title 
                                                    </label>
                                                    <input type="text" name="title" class="form-control"
                                                        id="title" placeholder="Title" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title !
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner_title2">SubTitle
                                                    </label>
                                                    <input type="text" name="sub_title" class="form-control"
                                                        id="sub_title" placeholder="SubTitle" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please Enter SubTitle!
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                     
                                  
                                       

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Image 1</label><span
                                                        class="text-small text-danger">( Image size
                                                        must be 672 x 700 px )</span>
                                                    <input type="file" name="image1" class="form-control image-check"
                                                        id="image1" required="" data-width="672" data-height="700">
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
                                                        id="image1_alt_tag" placeholder="Image 1 Alt Tag">
                                                </div>
                                            </div>
                                          
                                        </div>

                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2">Image 2</label><span
                                                        class="text-small text-danger">( Image size
                                                        must be 774 x 447 px )</span>
                                                    <input type="file" name="image2" class="form-control image-check"
                                                        id="image2" required="" data-width="774" data-height="447">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 2!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2_alt_tag">Image 2
                                                        Alt Tag</label>
                                                    <input type="text" name="image2_alt_tag" class="form-control"
                                                        id="image2_alt_tag" placeholder="Image 2 Alt Tag">
                                                </div>
                                            </div>
                                       
                                        </div>





                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button Text</label>
                                                    <input type="text" name="button_text" class="form-control"
                                                        id="button_text" placeholder="Button Text" value="">
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button URL</label>
                                                    <input type="text" class="form-control" id="button_url"
                                                        name="button_url" placeholder="Button URL">
                                                </div>
                                            </div>
                                        </div>

                                          <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea  name="description" class="form-control"
                                                        id="description" placeholder="Description" value=""></textarea>
                                                   
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