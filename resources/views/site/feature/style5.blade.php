@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section ptb-120">
    <div class="container">
        <div class="feature-color bg-primary-soft px-5 rounded-custom position-relative">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5 col-md-12">
                    <div class="feature-content-wrap pe-lg-4 ptb-60 p-lg-0 mb-5 mb-lg-0">
                        <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                        <h2>{{ $decodeData['title'] }}</h2>
                        <p>{{ $decodeData['description'] }}</p>

                        @if($decodeData['button_text'] !== null)
                        <a href="{{ $decodeData['button_url']  }}" class="btn btn-primary mt-4">{{ $decodeData['button_text'] }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="row align-items-center justify-content-center position-relative mt--100 z-2">

                       @if(isset($decodeData['step_data'][0]))
                        <div class="col-md-6">
                            <div class="cta-card rounded-custom text-center shadow p-5 bg-white my-4">
                                <div class="feature-icon d-inline-block rounded mb-4">
                                    <img src="{{ asset("storage/uploads/". $decodeData['step_data'][0]['step_image']) }}" alt="{{ $decodeData['step_data'][0]['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                                </div>
                                <h3 class="h5 fw-bold">{{ $decodeData['step_data'][0]['step_title'] }}</h3>
                                <p class="mb-0">{{ $decodeData['step_data'][0]['step_description'] }} </p>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                       @if(isset($decodeData['step_data'][1]))
                            <div class="cta-card rounded-custom text-center shadow p-5 bg-white my-4">
                                <div class="feature-icon d-inline-block  rounded mb-4">
                                    <img src="{{ asset("storage/uploads/".$decodeData['step_data'][1]['step_image']) }}" alt="{{ $decodeData['step_data'][1]['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                                </div>
                                <h3 class="h5 fw-bold">{{$decodeData['step_data'][1]['step_title'] }}</h3>
                                <p class="mb-0">{{ $decodeData['step_data'][1]['step_description'] }} </p>
                            </div>
                            @endif

                       @if(isset($decodeData['step_data'][2]))

                            <div class="cta-card rounded-custom text-center shadow p-5 bg-white my-4">
                                <div class="feature-icon d-inline-block rounded mb-4">
                                    <img src="{{ asset("storage/uploads/".$decodeData['step_data'][2]['step_image']) }}" alt="{{ $decodeData['step_data'][2]['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                                </div>
                                <h3 class="h5 fw-bold">{{ $decodeData['step_data'][2]['step_title'] }}</h3>
                                <p class="mb-0">{{ $decodeData['step_data'][2]['step_description'] }}</p>
                            </div>
                            @endif

                        </div>


                        <!--animated shape start-->
                        <ul class="position-absolute animate-element parallax-element z--1" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                            <li class="layer" data-depth="0.06" style="position: relative; display: block; left: 0px; top: 0px; transform: translate3d(12.8743px, -39.3239px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                                <img src="{{ asset("site/assets/img/shape/shape-bg-3.svg") }}" alt="shape" class="img-fluid">
                            </li>
                        </ul>
                        <!--animated shape end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>