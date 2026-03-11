@php
$decodeData=decodeData($page_data);
@endphp

<section class="crm-cta-section ptb-80 crm-bg-yellow-light position-relative z-1">
            <img src="{{ asset('site/assets/img/shape/circle-half.png') }}" alt="circle half" class="position-absolute circle-half z--1">
            <img src="{{ asset('site/assets/img/shape/dot-red.png') }}" alt="doted" class="position-absolute doted z--1 d-none d-md-block">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="crm-title text-center">
                            <span class="crm-subtitle">{{ $decodeData['sub_title'] }}<img src="{{ asset('site/assets/img/shape/arrow-red.png') }}" alt="arrow" class="ms-1"></span>
                            <h2 class="mt-2 mb-3 clr-text">{{ $decodeData['title'] }}</h2>
                            <p class="mb-0">{{ $decodeData['description'] }}</p>
                            @if($decodeData['button_text'] )
                            <a href="{{ $decodeData['button_url'] }}" class="btn crm-primary-btn mt-40" target="_blank">{{ $decodeData['button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>