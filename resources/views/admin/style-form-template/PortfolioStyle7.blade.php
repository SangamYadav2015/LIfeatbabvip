<div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                  <div class="invalid-feedback">
                    Please Enter Title!
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="title">Subtitle</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle" required>
                  <div class="invalid-feedback">
                    Please Enter Subtitle!
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="image1">Image
                  </label><span class="text-small text-danger">( Image size must be 648 x 433 px )</span>
                  <input type="file" name="image1" class="form-control image-check" id="image1" required data-width="648" data-height="433">
                  <div class="img-alert"></div>
                  <div class="invalid-feedback">
                    Please Choose Image Thumbnail!
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="title">Image Alt Tag</label>
                  <input type="text" class="form-control" id="image1_alt_tag" name="image1_alt_tag" placeholder="Image Alt Tag" >
                </div>
              </div>
              </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="button_text">Button Text</label>
                  <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Button Text">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="button_url">Button URL</label>
                  <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Button URL">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="link_text">Link Text</label>
                  <input type="text" class="form-control" id="link_text" name="link_text" placeholder="Link Text">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="link_url">Link URL</label>
                  <input type="text" class="form-control" id="link_url" name="link_url" placeholder="Link URL">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="description">Description </label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                  <div class="invalid-feedback">
                    Please Enter Description!
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