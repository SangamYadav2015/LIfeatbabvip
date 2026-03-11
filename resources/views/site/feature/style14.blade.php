@php
$decodeData=decodeData($page_data);
@endphp

<section class="payment-news-letter pt-60 pb-120">
            <div class="container">
                <div class="row ptb-120 align-items-center">
                    <div class="col-lg-5">
                        <div class="mb-5 me-3 mb-lg-0">
                            <h2 class="mb-4">{{ $decodeData['title1'] }}</h2>
                            <p>{{ $decodeData['description1'] }}</p>
                            @if($decodeData['step_data'])
                           
                            <div class="payment-store-btn mt-4">
                            <ul class="list-unstyled m-0">
                            @foreach ($decodeData['step_data'] as $step)
                                    <li class="d-inline-block me-2 mb-3 mb-md-0">
                                        <a class="d-flex align-items-center text-decoration-none rounded shadow-lg" href="{{$step['step_image_url']}}">
                                        <img src="{{ asset("storage/uploads/".$step['step_image']) }}" alt=" {{ $step['step_image_alt_tag'] }}" class="img-fluid">
                                    </a>
                                    </li>
                            @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-cta-right position-relative mt-5 mt-lg-0">
                            <div class="p-cta-img text-center position-relative">
                                <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}">
                            </div>
                            <ul class="payment-cta-shape list-unstyled">
                                <li>
                                    <img src="{{ asset("storage/uploads/".$decodeData['image1']) }}" alt="{{ $decodeData['image1_alt_tag'] }}" class="shadow-md">
                                </li>
                                <li><img src="{{ asset("storage/uploads/".$decodeData['image2']) }}" alt="{{ $decodeData['image2_alt_tag'] }}"></li>
                                <li>
                                    <img src="{{ asset("storage/uploads/".$decodeData['image3']) }}" alt="{{ $decodeData['image3_alt_tag'] }}" class="shadow-lg rounded-circle" >
                                </li>
                                <li>
                                    <img src="{{ asset("storage/uploads/".$decodeData['image4']) }}" alt="{{ $decodeData['image4_alt_tag'] }}" class="rouned-circle shadow-md">
                                </li>
                                <li><img src="{{ asset("storage/uploads/".$decodeData['image5']) }}" alt="{{ $decodeData['image5_alt_tag'] }}"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <h3>{{ $decodeData['title2'] }}</h3>
                            <p >{{ $decodeData['description2'] }}</p>
                            <form method="post" class="subscribenewsletter">
                                <div class="payment-email-form d-flex position-relative">
                                    <input type="text" class="mail-input form-control shadow-none" placeholder="Enter your email">
                                    <button class="payment-btn position-absolute end-0" type="submit">
                                        Subscribe Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>