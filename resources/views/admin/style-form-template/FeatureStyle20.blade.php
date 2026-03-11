<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title
                                                    </label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        placeholder="Title" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="sub_title">Subtitle
                                                    </label>
                                                    <input type="text" name="sub_title" class="form-control"
                                                        id="sub_title" placeholder="Subtitle" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Subtitle!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Image 1</label><span
                                                        class="text-small text-danger">( Image size
                                                        must be 300 x 317 px )</span>
                                                    <input type="file" name="image1" class="form-control image-check"
                                                        id="image1" required="" data-width="300" data-height="317">
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
                                                        must be 300 x 449 px )</span>
                                                    <input type="file" name="image2" class="form-control image-check"
                                                        id="image2" required="" data-width="300" data-height="449">
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
                                                    <label class="form-label" for="image3">Image 3</label><span
                                                        class="text-small text-danger">( Image size
                                                        must be 300 x 272 px )</span>
                                                    <input type="file" name="image3" class="form-control image-check"
                                                        id="image3" required="" data-width="300" data-height="272">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 3!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image3_alt_tag">Image 3
                                                        Alt Tag</label>
                                                    <input type="text" name="image3_alt_tag" class="form-control"
                                                        id="image3_alt_tag" placeholder="Image 3 Alt Tag">
                                                </div>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_text">Button 1 Text</label>
                                                    <input type="text" name="button_text" class="form-control"
                                                        id="button_text" placeholder="Button 1 Text" value="">
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button 1 URL</label>
                                                    <input type="text" class="form-control" id="button_url"
                                                        name="button_url" placeholder="Button 1 URL">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button2_text">Button 2 Text</label>
                                                    <input type="text" name="button2_text" class="form-control"
                                                        id="button2_text" placeholder="Button 2 Text" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button2_url">Button 2 URL</label>
                                                    <input type="text" class="form-control" id="button2_url"
                                                        name="button2_url" placeholder="Button 2 URL">
                                                </div>
                                            </div>
                                        </div>
                                              
                                      <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">description</label>
                                                    <textarea  name="description" class="form-control"
                                                        id="description" placeholder="description"></textarea>
                                                   
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