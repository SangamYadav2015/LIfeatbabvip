@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section soft-bg ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="feature-subtitle">
                    <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>

                </div>
                <div class="row mt-5">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['step_data'] as $itemservice)
                    <div class="col-12 col-md-6">
                        <h6 class="fw-bold display-5 text-primary mb-4">20+</h6>
                        <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                        <p>{{ $itemservice['step_description'] }}</p>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="feature-img mt-5 mt-lg-0">
                    <img src="{{ asset("storage/uploads/".$decodeData['image']) }}" class="img-fluid rounded-custom shadow" alt="{{ $decodeData['image_alt_tag'] }}">
                </div>
            </div>
        </div>
    </div>
</section>