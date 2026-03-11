@php
  $decodeData=decodeData($page_data);
@endphp
<section class="app-two-download-cta ptb-120" style="background: url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}')no-repeat
        center center / cover">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-xl-6 col-md-10">
                        <div class="section-heading text-center">
                            <h2 class="text-white">{{ $decodeData['title'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-12">
                        <div class="action-btns mt-3">
                            <ul class="list-unstyled text-center">
                                <li class="d-inline-block me-2 mb-lg-0">
                                    <a class="d-flex align-items-center text-decoration-none rounded active " href="{{ $decodeData['icon_1_url'] }}" target="_blank"><i class="fab fa-apple pe-2"></i>
                                        <span>Available on the <span>App Store</span></span></a>
                                </li>
                                <li class="d-inline-block me-2 mb-lg-0">
                                    <a class="d-flex align-items-center text-decoration-none rounded" href="{{ $decodeData['icon_2_url'] }}" target="_blank"><i class="fab fa-google-play pe-2"></i>
                                        <span>Available on the <span>Google Play</span></span></a>
                                </li>
                                <li class="d-inline-block mb-lg-0">
                                    <a class="d-flex align-items-center text-decoration-none rounded" href="{{ $decodeData['icon_3_url'] }}" target="_blank"><i class="fab fa-windows pe-2"></i>
                                        <span>Available on the <span>Google Play</span></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>