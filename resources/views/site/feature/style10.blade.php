@php
$decodeData=decodeData($page_data);
@endphp

<section class="feature-section pt-60 pb-120">
    <div class="container">
        <div class="row align-items-lg-center justify-content-between">
            <div class="col-lg-5 mb-7 mb-lg-0">
                <div class="mb-4 aos-init aos-animate" data-aos="fade-up">
                    <h2>{{ $decodeData['title2'] }}</h2>
                    <p>{{ $decodeData['description'] }} </p>
                </div>
                @if($decodeData['step_data'])

                <ul class="list-unstyled d-flex flex-wrap list-two-col mt-5 aos-init aos-animate" data-aos="fade-up">
                    @foreach ($decodeData['step_data'] as $step)

                    <li>
                        <span class="d-block mb-4">
                            <img src="{{ asset("storage/uploads/".$step['step_image']) }}" alt="{{ $step['image_icon_alt_tag'] }}" class="img-fluid">
                        </span>
                        <h3 class="h5">{{ $step['step_title'] }}</h3>
                        <p>{{ $step['step_description'] }}</p>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="pr-lg-4 position-relative aos-init aos-animate" data-aos="fade-up">
                    <!--animated shape start-->
                    <ul class="position-absolute animate-element parallax-element shape-service z--1 hide-medium" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                        <li class="layer" data-depth="0.03" style="position: relative; display: block; left: 0px; top: 0px; transform: translate3d(17.8637px, -15.4023px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                            <img src="{{ asset('site/assets/img/color-shape/image-3.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-1">
                        </li>
                        <li class="layer" data-depth="0.02" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(11.9091px, -10.2682px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                            <img src="{{ asset('site/assets/img/color-shape/feature-1.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-2 z-5">
                        </li>
                        <li class="layer" data-depth="0.03" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(17.8637px, -15.4023px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
                            <img src="{{ asset('site/assets/img/color-shape/feature-3.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-3">
                        </li>
                    </ul>
                    <!--animated shape end-->
                    <div class="bg-light-subtle text-center shadow-sm rounded-custom overflow-hidden pt-5 px-3 px-lg-5 mx-lg-auto">
                        <div class="mb-5">
                            <h3 class="fw-medium h4">{{ $decodeData['title'] }}</h3>
                        </div>
                        <div class="position-relative w-75 mx-auto">
                            <img class="position-relative z-2 w-100 h-auto" src="{{ asset('site/assets/img/screen/half-iphone.svg') }}" alt="Image Description">
                            <img class="position-absolute half-screen" src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>