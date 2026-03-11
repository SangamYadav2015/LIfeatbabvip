@php
$decodeData=decodeData($page_data);
@endphp
<section class="services-section ptb-120">
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
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['service_data'] as $itemservice)
                    <div class="feature-card border border-light border-2 bg-white rounded-custom p-5">
                        <div class="feature-icon rounded mb-3">
                            <img src="{{ asset("storage/uploads/".$itemservice['service_image_icon']) }}" alt="{{ $itemservice['service_image_icon_alt_tag'] }}" class="img-fluid p-0">
                        </div>
                        <div class="feature-content">
                            <h3 class="h5">{{ $itemservice['service_title'] }}</h3>
                            <p>{{ $itemservice['service_description'] }}</p>
                            <h6 class="mt-4">{{ $itemservice['step_title'] ? $itemservice['step_title'] : ''}}</h6>
                            <ul class="list-unstyled mb-0">
                                @if(isset($itemservice['step_text1']) && $itemservice['step_text1'] !== null)
                                <li class="py-1"><i class="fas fa-check-circle me-2 text-primary"></i>{{ $itemservice['step_text1'] }}</li>
                                @endif
                                @if(isset($itemservice['step_text2']) && $itemservice['step_text2'] !== null)
                                <li class="py-1"><i class="fas fa-check-circle me-2 text-primary"></i>{{ $itemservice['step_text2'] }}</li>
                                @endif
                                @if(isset($itemservice['step_text3']) && $itemservice['step_text3'] !== null)
                                <li class="py-1"><i class="fas fa-check-circle me-2 text-primary"></i>{{ $itemservice['step_text3'] }}</li>
                                @endif
                            </ul>

                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>