@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section">
    <div class="container-fluid">
        <div class="feature-container mx-lg-5 position-relative bg-dark p-100 rounded-custom">
            <img src="{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}" alt="{{ $decodeData['banner_bg_alt_tag'] }}" class="feature-bg-mockup position-absolute w-100 h-100 left-0 right-0 top-0 bottom-0 rounded-custom">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="feature-bg-img-content position-relative z-5">
                            <div class="section-heading">
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }}</p>
                            </div>

                            <ul class="list-unstyled d-flex flex-wrap list-two-col mt-5 mb-0">
                                @php
                                $i=1;
                                @endphp
                                @foreach ($decodeData['step_data'] as $itemservice)
                                <li class="py-3">
                                    <h3 class="feature-number text-primary mb-2">{{ $itemservice['step_title'] }}</h3>
                                    <p>{{ $itemservice['step_description'] }} </p>
                                </li>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>