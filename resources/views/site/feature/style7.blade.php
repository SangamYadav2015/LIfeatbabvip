@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-heading text-center">
                    <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @php
                $i=1;
                @endphp
                @foreach ($decodeData['step_data'] as $itemservice)
                @if($i === 1)
                <div class="feature-grid mt-5">
                    <div class="feature-card border border-light border-2 bg-white highlight-card rounded-custom p-5">
                        <div class="feature-icon rounded  mb-32">
                            <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                        </div>
                        <div class="feature-content">
                            <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                            <p>{{ $itemservice['step_description'] }} </p>

                        </div>
                    </div>

                    @else
                    <div class="feature-card border border-light border-2 bg-white rounded-custom p-5">
                        <div class="feature-icon rounded mb-32">
                            <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                        </div>
                        <div class="feature-content">
                            <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                            <p>{{ $itemservice['step_description'] }} </p>
                        </div>
                    </div>
                    @endif


                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>