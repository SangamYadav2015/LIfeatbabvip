@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section ptb-120 bg-light-subtle">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section-heading text-center">
                    <h4 class="h5 text-primary">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="feature-grid">
                @foreach ($decodeData['service_data'] as $itemservice)
                    <div class="feature-card border border-light border-2 rounded-custom p-5">
                        <div class="rounded mb-2 d-flex align-items-center">
                        <img src="{{ asset("storage/uploads/".$itemservice['service_image_icon']) }}" alt="{{ $itemservice['service_image_icon_alt_tag'] }}" class="img-fluid p-0">
                            <h3 class="h5 mb-0">{{ $itemservice['service_title'] }}</h3>
                        </div>
                        <div class="feature-content">
                            <p class="mb-0"> {{ $itemservice['service_description'] }}</p>
                        </div>
                        @if($itemservice['link_text'] && $itemservice['link_text']!='' )
                        <a href="{{ $itemservice['link_url'] }}" class="link-with-icon text-decoration-none mt-4">{{ $itemservice['link_text'] }} <i class="fas fa-arrow-right"></i></a>
                        @endif
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>