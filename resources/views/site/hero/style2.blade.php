@php
  $decodeData=decodeData($page_data);
@endphp
            <!--hero section start-->
            <section class="hero-section ptb-120 text-white bg-gradient" style="background: url('assets/img/hero-dot-bg.png')no-repeat center right">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="hero-content-wrap mt-5 mt-lg-0 mt-xl-0">
                                <h1 class="fw-bold display-5">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead">{{ $decodeData['banner_description'] }}</p>
                                <div class="action-btn mt-5 align-items-center d-block d-sm-flex d-lg-flex d-md-flex">
                                    <a href="{{ $decodeData['button_url'] }}" class="btn btn-primary me-3">{{ $decodeData['button_text'] }}</a>
                                    <a href="{{ $decodeData['video_button_link'] }}" class="text-decoration-none popup-youtube d-inline-flex align-items-center watch-now-btn mt-3 mt-lg-0 mt-md-0"> <i
                                            class="fas fa-play"></i> {{ $decodeData['video_button_text'] }} </a>
                                </div>
                                <div class="row justify-content-lg-start mt-60">
                                    <h6 class="text-white-70 mb-2">Our Top Clients:</h6>
                                    @foreach ($decodeData['top_client_image'] as $itemClient)
                                    
                                    <div class="col-4 col-sm-3 my-2 ps-lg-0">
                                        <img src="{{ asset("storage/uploads/".$itemClient['top_client_image']) }}" alt="{{ $itemClient['icon_alt_tag'] }}" class="img-fluid">
                                    </div>
                                    
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 mt-5">
                            <div class="hero-img position-relative circle-shape-images">
                                <!--animated shape start-->
                                <!-- <ul class="position-absolute animate-element parallax-element circle-shape-list">
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-0 hero-1">
                                    </li>
                                    <li class="layer" data-depth="0.02">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-1 hero-1">
                                    </li>
                                    <li class="layer" data-depth="0.04">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-2 hero-1">
                                    </li>
                                    <li class="layer" data-depth="0.04">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-3 hero-1">
                                    </li>
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-4 hero-1">
                                    </li>
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('/site/assets/img/shape/circle-1.svg') }}" alt="shape" class="circle-shape-item type-5 hero-1">
                                    </li>
                                </ul> -->
                                <!--animated shape end-->
                                <img src="{{ asset('/storage/uploads/'.$decodeData['banner_image']) }}" alt="hero img" class="img-fluid position-relative z-5">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--hero section end-->
