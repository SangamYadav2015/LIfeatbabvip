<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title!
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="highlighted_title">Highlighted
                                                        Title</label>
                                                    <input type="text" class="form-control" id="highlighted_title"
                                                        name="highlighted_title" placeholder="Highlighted Title"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Highlighted Title!
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image">
                                                        Image</label><span class="text-small text-danger">( Image size
                                                        must be 516 x 350 px )</span>
                                                    <input type="file" name="image" class="form-control image-check"
                                                        id="image" required data-width="516" data-height="350">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image_alt_tag">Image Alt Tag</label>
                                                    <input type="text" name="image_alt_tag" class="form-control"
                                                        id="image_alt_tag" placeholder="Image Alt Tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter Alt Tag!
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
                                                    <div class="invalid-feedback">
                                                        Please Choose Button Text!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="button_url">Button Url</label>
                                                    <input type="text" class="form-control" name="button_url"
                                                        id="button_url" placeholder="Button Url" required>
                                                    <div class="invalid-feedback">
                                                        Please Choose Button Url!
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