@php
  $decodeData=decodeData($page_data);
@endphp
  <!--hero section start-->
            <section class="hero-section ptb-120 text-white bg-dark" style="background: url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}')no-repeat center right">
                <div class="container">
                    <div class="row justify-content-center text-center text-lg-start align-items-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="hero-content-wrap mt-5 mt-lg-0 mt-xl-0">
                                <h1 class="fw-bold display-5" data-aos="fade-up">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead" data-aos="fade-up">{{ $decodeData['banner_description'] }}</p>
                                <div class="action-btns mt-5" data-aos="fade-up" data-aos-delay="50">
                                    <a href="{{ $decodeData['button_url1'] }}" class="btn btn-primary me-lg-3 me-sm-3">{{ $decodeData['button_text1'] }}</a>
                                    <a href="{{ $decodeData['button_url2'] }}" class="btn btn-outline-light">{{ $decodeData['button_text2'] }}</a>
                                </div>
                            
                                
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

                                <div class="d-flex justify-content-center justify-content-lg-start mt-5" data-aos="fade-up" data-aos-delay="150">
                                @foreach ($decodeData['top_client_image'] as $itemClient)
                                <img src="{{ asset("storage/uploads/".$itemClient['top_client_image']) }}" alt="{{ $itemClient['icon_alt_tag'] }}" class="me-4 img-fluid">
                                @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8">
                        <div class="hero-img-wrap position-relative app-screen-bg mt-5"style="background-image: url({{ asset('site/assets/img/shape/shape-bg-3.svg') }})"data-aos="fade-up"data-aos-delay="200">
                                <!--animated shape start-->
                                <ul class="position-absolute animate-element parallax-element shape-service d-none d-lg-block">
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('site/assets/img/color-shape/image-4.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-1">
                                    </li>
                                    <li class="layer" data-depth="0.02">
                                        <img src="{{ asset('site/assets/img/color-shape/feature-2.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-2 z-5">
                                    </li>
                                    <li class="layer" data-depth="0.03">
                                        <img src="{{ asset('site/assets/img/color-shape/feature-3.svg') }}" alt="shape" class="img-fluid position-absolute color-shape-3">
                                    </li>
                                </ul>
                                <!--animated shape end-->
                                <img src="{{ asset('storage/uploads/'.$decodeData['banner_image']) }}"  alt="{{ $decodeData['banner_img_alt'] }}" class="img-fluid position-relative z-5">
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--hero section end-->

