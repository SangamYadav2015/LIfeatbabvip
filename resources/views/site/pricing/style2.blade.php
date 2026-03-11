@php
$decodeData=decodeData($page_data);
@endphp
<!--pricing section start-->
<section class="pricing-section position-relative overflow-hidden bg-dark text-white pt-120" style="background: url('assets/img/page-header-bg.svg')no-repeat center center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="section-heading text-center z-5 position-relative">
                    <h4 class="h5 text-warning">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }} </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="pricing-content-wrap mb--100 bg-white rounded-custom shadow-lg border d-fle z-10 position-relative">
                    <div class="price-feature-col pricing-feature-info left-radius bg-primary-soft p-5 text-dark" style="color:#737373">
                        <ul class="list-unstyled pricing-feature-list pricing-included-list mb-0">

                            @if(isset($decodeData['plan_offer1']) && $decodeData['plan_offer1'] !== null)
                            <li><i class="fas fa-circle fa-2xs  text-primary me-2"></i> {{ $decodeData['plan_offer1'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer2']) && $decodeData['plan_offer2'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer2'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer3']) && $decodeData['plan_offer3'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer3'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer4']) && $decodeData['plan_offer4'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer4'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer5']) && $decodeData['plan_offer5'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer5'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer6']) && $decodeData['plan_offer6'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer6'] }}</li>
                            @endif

                            @if(isset($decodeData['plan_offer7']) && $decodeData['plan_offer7'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer7'] }}</li>
                            @endif
                            @if(isset($decodeData['plan_offer8']) && $decodeData['plan_offer8'] !== null)
                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> {{ $decodeData['plan_offer8'] }}</li>
                            @endif
                        </ul>
                    </div>
                    <div class="price-feature-col pricing-action-info p-5">
                        <ul class="nav nav-pills mb-4 pricing-tab-list" id="pills-tab" role="tablist">
                            @php
                            $i=1;
                            @endphp
                            @foreach ($decodeData['step_data'] as $itemservice)
                            <li class="nav-item" role="presentation">
                                <button class=" {{ $i=== 1 ? 'active' : '' }}" id="pills-tab" data-bs-toggle="pill" data-bs-target="#pills-tab-{{ $i }}" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ $itemservice['plan_type'] }}</button>
                            </li>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @php
                            $i=1;
                            @endphp
                            @foreach ($decodeData['step_data'] as $itemservice)
                            <div class="tab-pane fade  {{ $i=== 1 ? 'active show' : '' }} " id="pills-tab-{{ $i }}" role="tabpanel" aria-labelledby="pills-home">
                                <h3 class="h5">{{ $itemservice['plan_title'] }}</h3>
                                <p>{{ $itemservice['plan_description'] }}</p>
                                <div class="pricing-price mt-5">
                                    <h4 class="h1 fw-bold">${{ $itemservice['plan_price'] }} <span>/{{ $itemservice['plan_type'] }}</span></h4>
                                </div>
                                <a href="{{ $itemservice['plan_button_url'] }}" class="btn btn-primary mt-3">{{ $itemservice['plan_button_text'] }}</a>
                            </div>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning left-5"></div>
    <div class="white-space-100 bg-white w-100"></div>
</section>
<!--pricing section end-->