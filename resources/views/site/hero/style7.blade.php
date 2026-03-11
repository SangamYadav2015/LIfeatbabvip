@php
  $decodeData=decodeData($page_data);
@endphp
        
            <!--hero section start-->
            <section class="hero-section ptb-120 bg-dark text-white" style="background: url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}')no-repeat bottom left">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-xl-5 col-lg-5">
                            <div class="hero-content-wrap text-center text-xl-start text-lg-start mt-5 mt-lg-0 mt-xl-0" data-aos="fade-up">
                            <h1 class="fw-bold display-5" data-aos="fade-up">{{ $decodeData['banner_title'] }}</h1>
                                <p class="lead" data-aos="fade-up">{{ $decodeData['banner_description'] }}</p>
                                <div class="hero-subscribe-form-wrap pt-4 position-relative m-auto m-xl-0 d-none d-md-block d-lg-block d-xl-block">
                                    <form id="subscribe-form" name="email-form" class="hero-subscribe-form d-block d-lg-flex d-md-flex subscribenewsletter" method="post">
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
                        <div class="col-xl-6 col-lg-6 mt-lg-5 mt-4">
                            <div class="hero-img-wrap position-relative" data-aos="fade-up">
                                <div class="hero-screen-wrap">
                                    <div class="phone-screen">
                                        <img src="{{ asset('storage/uploads/'.$decodeData['banner_image1']) }}" alt="{{ $decodeData['banner_img1_alt_tag'] }}" class="position-relative img-fluid">
                                    </div>
                                    <div class="mac-screen">
                                        <img src="{{ asset('storage/uploads/'.$decodeData['banner_image2']) }}" alt="{{ $decodeData['banner_img2_alt_tag'] }}" class="position-relative img-fluid rounded-custom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--hero section end-->

            <!--customer section start-->
            <div class="customer-section pb-120 bg-dark">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-12">
                            <ul class="customer-logos-grid text-center list-unstyled mb-0">
                            @foreach ($decodeData['top_client_image'] as $itemClient)

                                <li>
                                    <img src="{{ asset("storage/uploads/".$itemClient['top_client_image']) }}" width="150" alt="{{ $itemClient['icon_alt_tag'] }}" class="img-fluid customer-logo p-1 p-md-2 p-lg-3 m-auto" data-aos="fade-up" data-aos-delay="50">
                                </li>
                                @endforeach

                            </ul>
                            <p class="text-center mt-lg-5 mt-4 mb-0" data-aos="fade-up" data-aos-delay="200">{{ $decodeData['trusted_title'] }}</p>
                        </div>
                    </div>
                </div>
            </div> <!--customer section end-->

