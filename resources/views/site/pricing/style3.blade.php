@php
$decodeData=decodeData($page_data);
@endphp
<!--pricing section start-->
            <section class="pricing-section ptb-120">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="section-heading text-center">
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }}. </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['step_data'] as $itemservice)
                        <div class="col-lg-4 col-md-6">
                            <div class="position-relative single-pricing-wrap rounded-custom  custom-shadow p-5 mb-4 mb-lg-0 {{ $i === 2 ? 'bg-dark text-white': 'bg-white'}}">
                                <div class="pricing-header mb-32">
                                    <h3 class="package-name text-primary d-block">{{ $itemservice['plan_title'] }}</h3>
                                    <h4 class="display-6 fw-semi-bold">${{ $itemservice['plan_price'] }}<span>/{{ $itemservice['plan_type'] }}</span></h4>
                                </div>
                                <div class="pricing-info mb-4">
                                <ul class="pricing-feature-list list-unstyled">
                                        @if(isset($itemservice['plan_offer1']) && $itemservice['plan_offer1'] !== null)
                                          <li><i class="fas fa-circle fa-2xs  {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer1'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer2']) && $itemservice['plan_offer2'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer2'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer3']) && $itemservice['plan_offer3'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer3'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer4']) && $itemservice['plan_offer4'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer4'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer5']) && $itemservice['plan_offer5'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer5'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer6']) && $itemservice['plan_offer6'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer6'] }}</li>
                                        @endif

                                        @if(isset($itemservice['plan_offer7']) && $itemservice['plan_offer7'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer7'] }}</li>
                                        @endif
                                        @if(isset($itemservice['plan_offer8']) && $itemservice['plan_offer8'] !== null)
                                          <li><i class="fas fa-circle fa-2xs {{ $i === 2 ? ' text-warning': ' text-primary'}} me-2"></i> {{ $itemservice['plan_offer8'] }}</li>
                                        @endif
                                       
                                    </ul>                                </div>
                                <a href="{{ $itemservice['plan_button_url'] }}" class="btn btn-outline-primary mt-2">{{ $itemservice['plan_button_text'] }}</a>

                                <!--pattern start-->
                                <div class="dot-shape-bg position-absolute z--1 left--40 bottom--40">
                                    <img src="{{ asset('site/assets/img/shape/dot-big-square.svg') }}" alt="shape">
                                </div>
                                <!--pattern end-->
                            </div>
                        </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                    </div>
                </div>
            </section>
            <!--pricing section end-->