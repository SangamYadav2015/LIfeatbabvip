@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section-two ptb-120 bg-light-subtle">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <h4 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                    <ul class="list-unstyled mt-5">
                        @php
                        $i=1;
                        @endphp
                        @foreach ($decodeData['step_data'] as $itemservice)
                        <li class="d-flex align-items-start mb-4">
                            <div class="icon-box rounded me-4">
                                <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                            </div>
                            <div class="icon-content">
                                <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                                <p>{{ $itemservice['step_description'] }} </p>
                            </div>
                        </li>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-7">
            
                <div class="feature-img-wrap position-relative d-flex flex-column align-items-end">
                <ul class="img-overlay-list list-unstyled position-absolute">
                                  
                                @if(isset($decodeData['banner_tag_line1']) && $decodeData['banner_tag_line1'] !== null)
                                    <li class="d-flex align-items-center bg-white rounded shadow-sm p-3">
                                        <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                        <h6 class="mb-0">{{ $decodeData['banner_tag_line1'] }}</h6>
                                    </li>
                                 @endif
                                 @if(isset($decodeData['banner_tag_line2']) && $decodeData['banner_tag_line2'] !== null)
                                    <li class="d-flex align-items-center bg-white rounded shadow-sm p-3">
                                        <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                        <h6 class="mb-0">{{ $decodeData['banner_tag_line2'] }}</h6>
                                    </li>
                                 @endif
                                 @if(isset($decodeData['banner_tag_line3']) && $decodeData['banner_tag_line3'] !== null)
                                    <li class="d-flex align-items-center bg-white rounded shadow-sm p-3">
                                        <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                        <h6 class="mb-0">{{ $decodeData['banner_tag_line3'] }}</h6>
                                    </li>
                                 @endif
                               
                                    
                                </ul>
                    <img src="{{ asset("storage/uploads/".$decodeData['image']) }}" alt="{{ $decodeData['image_alt_tag'] }}" class="img-fluid rounded-custom">
                </div>
            </div>
        </div>
    </div>
</section>