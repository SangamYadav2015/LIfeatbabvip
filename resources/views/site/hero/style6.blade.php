@php
  $decodeData=decodeData($page_data);
@endphp
<!--hero section start-->
            <section class="hero-section ptb-120 min-vh-100 d-flex align-items-center bg-dark text-white position-relative overflow-hidden" style="background: url('assets/img/page-header-bg.svg')no-repeat bottom right">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="hero-content-wrap">
                                <h5 class="text-warning">{{ $decodeData['banner_title']}}</h5>
                                <h1 class="fw-bold display-5" data-aos="fade-up">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead" data-aos="fade-up">{{ $decodeData['banner_description'] }}</p>
                                <div class="action-btns mt-5">
                                    <a href="{{ $decodeData['button_url1'] }}" class="btn btn-primary me-lg-3 me-sm-3">{{ $decodeData['button_text1'] }}</a>
                                    <a href="{{ $decodeData['button_url2'] }}" class="btn btn-outline-light">{{ $decodeData['button_text2'] }}</a>

                                </div>
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
                        <div class="col-lg-6 col-md-8 mt-5 mt-lg-0">
                            <div class="animated-img-wrap">
                                <!--animated shape start-->
                                <ul class="animate-element parallax-element animated-hero-1">
                                    <li class="layer" data-depth="0.02">
                                        <img src="{{ asset('/storage/uploads/'.$decodeData['banner_image1']) }}" alt="{{ $decodeData['banner_image1_alt_tag'] }}" class="img-fluid position-absolute type-0">
                                    </li>
                                </ul>
                                <!--animated shape end-->
                                <img src="{{ asset('/storage/uploads/'.$decodeData['banner_image2']) }}" alt="{{ $decodeData['banner_image2_alt_tag'] }}" class="position-relative img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--hero section end-->

