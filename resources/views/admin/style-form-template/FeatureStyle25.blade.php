<div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        placeholder="Title" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Title!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="sub_title">Subtitle</label>
                                                    <input type="text" name="sub_title" class="form-control"
                                                        id="sub_title" placeholder="Subtitle" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Subtitle!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1">Image 1
                                                    </label><span class="text-small text-danger">( Image size must be
                                                        570 x 588 px )</span>
                                                    <input type="file" name="image1" class="form-control image-check"
                                                        id="image1" required="" data-width="570" data-height="588">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Image 1!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1_alt_tag"> Image 1 Alt
                                                        Tag</label>
                                                    <input type="text" name="image1_alt_tag" class="form-control"
                                                        id="image1_alt_tag" placeholder="Image 1 Alt Tag">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="video_url">Video URL </label>
                                                    <input type="text" name="video_url" class="form-control"
                                                        id="video_url" required="" palceholder="Video URL">
                                                    <div class="invalid-feedback">
                                                        Please Enter Video URL!
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">Description </label>
                                                    <textarea name="description" class="form-control" id="description"
                                                        placeholder="Description " required=""></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Description!
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="card card  bg-gradient"
                                            style="background-color: rgb(220 221 225) !important;">
                                            <div class="card-header">
                                                <h4 class="card-title">Steps
                                                    <button class="btn btn-danger float-right" style="float: right;"
                                                        type="button" id="add-review">+ Add
                                                        More</button>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="review-sections">

                                                  


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_title">Step
                                                                    Title</label>
                                                                <input type="text" name="step_title[]"
                                                                    class="form-control" id="step_title" required
                                                                    placeholder="Step Title">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Title!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_sub_title">Step
                                                                    Subtitle</label>
                                                                <input type="text" name="step_sub_title[]"
                                                                    class="form-control" id="step_sub_title" required
                                                                    placeholder="Step Subtitle">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Subtitle!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_description">Step
                                                                    Description</label>
                                                                <textarea name="step_description[]" class="form-control"
                                                                    id="step_description" placeholder="Step Description"
                                                                    required></textarea>
                                                                <div class="invalid-feedback">
                                                                    Please Enter Step Description!
                                                                </div>
                                                            </div>
                                                        </div>
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


                                        <script>
                                            $(document).ready(function () {
                                                var maxReviews = 1;
                                                var reviewIndex = 1;

                                                // Function to update indexes and IDs
                                                function updateIndexes() {
                                                    $('.review-section').each(function (index) {
                                                        var idx = index + 1;

                                                    });
                                                }

                                                // Add more review sections
                                                $('#add-review').click(function () {
                                                    if ($('.review-section').length < maxReviews) {
                                                        reviewIndex++;
                                                        var newReviewSection = `
                             <div class="review-section mt-3" style="border-top: 7px solid #fff;">
                                       

                                                       <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_title">Step Title</label>
                                                                <input type="text" name="step_title[]"
                                                                    class="form-control" id="step_title"
                                                                    required placeholder="Step Title">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Title!
                                                                </div>
                                                            </div>
                                                        </div>
                                                           <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_sub_title">Step Subtitle</label>
                                                                <input type="text" name="step_sub_title[]"
                                                                    class="form-control" id="step_sub_title"
                                                                    required placeholder="Step Subtitle">
                                                                <div class="invalid-feedback">
                                                                    Please Choose Step Subtitle!
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="step_description">Step
                                                                   Description</label>
                                                                <textarea name="step_description[]"
                                                                    class="form-control" id="step_description"
                                                                    placeholder="Step Description" required></textarea>
                                                                <div class="invalid-feedback">
                                                                    Please Enter Step Description!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

           
                                                <div class="col-md-12 text-end">
                                                    <button type="button" class="btn btn-danger remove-review">Remove</button>
                                                </div>
                                            </div>
                                            `;

                                                        $('#review-sections').append(newReviewSection);
                                                        //for dynamic image change//
                                                        $(".image-check").change(function () {
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

                                                        })
                                                        //for dynamic image change//

                                                        updateIndexes();
                                                    } else {
                                                        $('#add-review').attr('disabled', true)
                                                    }
                                                });

                                                // Remove review section
                                                $(document).on('click', '.remove-review', function () {
                                                    $(this).closest('.review-section').remove();
                                                    $('#add-review').attr('disabled', false)
                                                    updateIndexes();
                                                });
                                            });

                                        </script>

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