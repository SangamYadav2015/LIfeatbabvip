@php
$decodeData=decodeData($page_data);
@endphp

<section class="payment-counter payment-counter-bg ptb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 order-last order-md-first">
                        <div class="card-shape position-relative">
                            <div class="card-img mt-5 mt-lg-0">
                                <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}" class="img-fluid" >
                            </div>
                            @if($decodeData['step_data'])
                            @php
                            $i=1
                            @endphp
                            <ul class="list-unstyled m-0">
                            @foreach ($decodeData['step_data'] as $step)
                                <li>
                                    <div class="counter-circle">
                                        <h4 class="
                                       @if($i === 1) ' text-danger ' @endif
                                       @if($i === 2) ' text-success ' @endif
                                       @if($i === 3) ' text-warning ' @endif
                                        m-0">{{ $step['step_title'] }}</h4>
                                        <small>{{ $step['step_sub_title'] }}</small>
                                    </div>
                                </li>
                                @php
                                $i++;
                                @endphp
                            @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="payment-counter-right">
                            <h2 class="mb-4">{{ $decodeData['title'] }}</h2>
                            <div class="mb-3">
                                <h5 class="mb-2 h6">{{ $decodeData['sub_title1'] }}</h5>
                                <p class="m-0">{{ $decodeData['description1'] }}</p>
                            </div>
                            <div class="">
                                <h5 class="mb-2 h6">{{ $decodeData['sub_title1'] }}</h5>
                                <p class="m-0">{{ $decodeData['description2'] }}</p>
                            </div>
                            @if($decodeData['button_text'])
                            <a href="{{ $decodeData['button_url'] }}" class="btn-gradient-sqr mt-40" target="_blank"> {{ $decodeData['button_text'] }} </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>