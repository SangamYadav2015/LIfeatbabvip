@php
$decodeData=decodeData($page_data);
@endphp
<section class="why-choose-us ptb-120">
            <div class="container">
                <div class="row justify-content-lg-between align-items-center">
                <div class="col-lg-6 col-12">
                        <div class="feature-img-holder mt-4 mt-lg-0 mt-xl-0">
                            <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" class="img-fluid" alt="feature-image">
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="why-choose-content">
                            <div class="icon-box rounded-custom shadow-sm d-inline-block">
                            <img src="{{ asset("storage/uploads/".$decodeData['icon_image']) }}" class="img-fluid" alt="feature-image">

                            </div>
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                            
                            @if($decodeData['link_text'])
                            <a href="{{ $decodeData['link_url']  }}" class="read-more-link text-decoration-none">{{ $decodeData['link_text'] }} <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        </div>
                    </div>
                  
                </div>
            </div>
        </section>