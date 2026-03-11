@php
  $decodeData=decodeData($page_data);
@endphp

            <!--hero section start-->
            <section class="hero-section ptb-120" style="background: url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}')no-repeat bottom center">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-xl-5 col-lg-5">
                            <div class="hero-content-wrap text-center text-xl-start text-lg-start" data-aos="fade-right">
                                <h1 class="fw-bold display-5">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead">{{ $decodeData['banner_description'] }}</p>
                                <div class="hero-subscribe-form-wrap pt-4 position-relative m-auto m-xl-0 d-none d-md-block d-lg-block d-xl-block">
                                    <form id="subscribe-form" name="email-form" method="post" class="hero-subscribe-form d-block d-lg-flex d-md-flex subscribenewsletter">
                                    @csrf
                                        <input type="email" class="form-control me-2" name="email" data-name="Email" placeholder="Enter Your Email Address" id="email-address" required="">
                                        <input type="submit" value="Subscribe" data-wait="Please wait..." class="btn btn-primary mt-3 mt-lg-0 mt-md-0 submitbtnsubs">
                                    </form>
                                     <ul class="nav subscribe-feature-list mt-3">
                                        @if(isset($decodeData['banner_tag_line1']) && $decodeData['banner_tag_line1'] !== null)
                                        <li class="nav-item">
                                            <span class="ms-0"><i class="far fa-check-circle text-primary me-2"></i>{{  $decodeData['banner_tag_line1'] }}</span>
                                        </li>
                                        @endif
                                         @if(isset($decodeData['banner_tag_line2']) && $decodeData['banner_tag_line2'] !== null)
                                        <li class="nav-item">
                                            <span class="ms-0"><i class="far fa-check-circle text-primary me-2"></i>{{  $decodeData['banner_tag_line2'] }}</span>
                                        </li>
                                        @endif
                                    </ul> 
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mt-4 mt-xl-0">
                            <div class="hero-img-wrap position-relative" data-aos="fade-left">
                                <!--animated shape start-->
                                <ul class="position-absolute animate-element parallax-element shape-service hide-medium">
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('site/assets/img/color-shape/image-1.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-1">
                                    </li>
                                    <li class="layer" data-depth="0.02">
                                        <img src="{{ asset('site/assets/img/color-shape/feature-2.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-2 z-5">
                                    </li>
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('site/assets/img/color-shape/feature-3.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-3">
                                    </li>
                                </ul>
                                <!--animated shape end-->
                                <div class="hero-img-wrap position-relative">
                                    <div class="hero-screen-wrap">
                                        <div class="phone-screen">
                                            <img src="{{ asset("storage/uploads/".$decodeData["banner_image1"]) }}" alt="{{ $decodeData['banner_image1_alt_tag'] }}" class="position-relative img-fluid">
                                        </div>
                                        <div class="mac-screen">
                                            <img src="{{ asset("storage/uploads/".$decodeData["banner_image2"]) }}" alt="{{ $decodeData['banner_image2_alt_tag'] }}" class="position-relative img-fluid rounded-custom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--hero section end-->
