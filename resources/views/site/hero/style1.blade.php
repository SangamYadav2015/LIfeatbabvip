  @php
  $decodeData=decodeData($page_data);
  @endphp
  <section class="page-header position-relative overflow-hidden ptb-120 bg-dark" style="background: url('{{ asset("storage/uploads/".$decodeData["banner_bg_image"]) }}')no-repeat bottom left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <h1 class="display-5 fw-bold"> {{ $decodeData['banner_title'] }}</h1>
                        <p class="lead"> {{ $decodeData['banner_description'] }} </p>
                    </div>
                </div>
                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light right-5"></div>
            </div>
        </section>