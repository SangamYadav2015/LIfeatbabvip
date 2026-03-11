@php
  $decodeData=decodeData($page_data);
@endphp

            <!--hero section start-->
            <section class="hero-section ptb-120 position-relative overflow-hidden" style="background: url('{{ asset("storage/uploads/".$decodeData["banner_bg_image"]) }}')no-repeat center top">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-xl-8 col-lg-10 mb-5">
                            <div class="hero-content-wrap">
                                <h1 class="fw-bold display-5" data-aos="fade-up">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead" data-aos="fade-up" data-aos-delay="50">{{ $decodeData['banner_description'] }}</p>
                                <div class="action-btns text-center pt-4" data-aos="fade-up" data-aos-delay="100">
                                    <a href="{{ $decodeData['button_url1'] }}" class="btn btn-primary me-lg-3 me-sm-3">{{ $decodeData['button_text1'] }}</a>
                                    <a href="{{ $decodeData['button_url2'] }}" class="btn btn-outline-primary">{{ $decodeData['button_text2'] }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="position-relative" data-aos="fade-up" data-aos-delay="200">
                                <ul class="position-absolute animate-element parallax-element widget-img-wrap z-2">
                                    <li class="layer" data-depth="0.04">
                                        <img src="{{ asset("storage/uploads/".$decodeData["banner_image1"]) }}" alt="{{ $decodeData["banner_image1_alt_tag"] }}" class="img-fluid widget-img-1 position-absolute shadow-lg rounded-custom">
                                    </li>
                                    <li class="layer" data-depth="0.02">
                                        <img src="{{ asset("storage/uploads/".$decodeData["banner_image3"]) }}" alt="{{ $decodeData["banner_image3_alt_tag"] }}" class="img-fluid widget-img-3 position-absolute shadow-lg rounded-custom">
                                    </li>
                                </ul>
                                <img src="{{ asset("storage/uploads/".$decodeData["banner_image2"]) }}" alt="{{ $decodeData["banner_image2_alt_tag"] }}" class="img-fluid position-relative rounded-custom mt-lg-5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-dark position-absolute bottom-0 h-25 bottom-0 left-0 right-0 z--1 py-5"></div>
            </section> <!--hero section end-->

            <!--top review section start-->
            <section class="customer-review pb-120 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="section-heading text-center">
                            <h2 class="fw-medium h4">Rated 5 out of 5 stars by our customers</h2>
                        </div>
                    </div>
                    <div class="row">
                    @foreach ($decodeData['review'] as $itemClient)
                        <div class="col-lg-4 col-md-4">
                            <div class="review-info-wrap text-center rounded-custom d-flex flex-column h-100 p-lg-5 p-4">
                                <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" width="130" alt="{{ $itemClient['alt_tag'] }}" class="img-fluid m-auto">
                                <div class="review-info-content mt-2">
                                    <p class="mb-4">{{ $itemClient['review_description']}}</p>
                                </div>
                                <a href="{{ $itemClient['link_url'] }}" class="link-with-icon p-0 mt-auto text-decoration-none text-warning">{{ $itemClient['link_text'] }} <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                       @endforeach
                       
                    </div>
                </div>
            </section> 
