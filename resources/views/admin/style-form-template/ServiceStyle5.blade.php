<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                required>
                            <div class="invalid-feedback">
                                Please Enter Title!
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="banner_image"> Image
                            </label><span class="text-small text-danger">( Image size must be 720 x 525 px )</span>
                            <input type="file" name="banner_image" class="form-control image-check" id="banner_image"
                                required data-width="720" data-height="525">
                            <div class="img-alert"></div>
                            <div class="invalid-feedback">
                                Please Choose Image!
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="icon_image"> Image Icon
                            </label><span class="text-small text-danger">( Image size must be 65 x 65 px )</span>
                            <input type="file" name="icon_image" class="form-control image-check" id="icon_image"
                                required data-width="65" data-height="65">
                            <div class="img-alert"></div>
                            <div class="invalid-feedback">
                                Please Choose Image Icon!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="link_text">Link Text</label>
                            <input type="text" class="form-control" id="link_text" name="link_text"
                                placeholder="Link Text" >
                            <div class="invalid-feedback">
                                Please Enter Link Text!
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="link_url">Link Text</label>
                            <input type="text" class="form-control" id="link_url" name="link_url" placeholder="Link Url"
                                >
                            <div class="invalid-feedback">
                                Please Enter Link Url!
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" name="description"
                                placeholder="Description" rows="2" required></textarea>
                            <div class="invalid-feedback">
                                Please Enter Description!
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