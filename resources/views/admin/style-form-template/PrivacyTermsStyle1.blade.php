<div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                  <div class="invalid-feedback">
                    Please Enter Title!
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="content">Content</label>
                  <textarea class="form-control ckeditor-classic" id="content" name="content" placeholder="Enter Data here"></textarea>
                </div>
              </div>
            </div>
            <script src="https://babvip.com/admin//libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
            <script>
            ClassicEditor.create(document.querySelector(".ckeditor-classic"))
                .then(function (e) {
                    e.ui.view.editable.element.style.height = "200px";
                })
                .catch(function (e) {
                    console.error(e);
                });
                </script>