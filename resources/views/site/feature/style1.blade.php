@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section ptb-120">
    <div class="container">
        <div class="row align-content-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="section-heading mb-5">
                    <h4 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
                @php
                $i=1;
                @endphp
                @foreach ($decodeData['step_data'] as $itemservice)
                <div class="single-feature d-flex mb-4">
                <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">

                    <div class="ms-4 mt-2">
                        <h5>{{ $itemservice['step_title'] }}</h5>
                        <p>{{ $itemservice['step_description'] }} </p>
                    </div>
                </div>
                @php
                $i++;
                @endphp
                @endforeach

            </div>
            <div class="col-lg-6 col-md-8">
                <div class="feature-shape-img position-relative mt-5 mt-lg-0">
                    <div class="img-bg-shape position-absolute">
                        <img src="{{ asset("site/assets/img/integations/shape.svg") }}" alt="integations">
                    </div>
                    <img src="{{ asset("storage/uploads/".$decodeData['image']) }}" class="img-fluid skewed-img-right rounded-custom shadow-lg" alt="{{ $decodeData['image_alt_tag'] }}">
                </div>
            </div>
        </div>
    </div>
</section>