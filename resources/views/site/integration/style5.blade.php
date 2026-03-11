@php
$decodeData=decodeData($page_data);
@endphp

<section class="image-feature pt-60 pb-120">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-12">
                        <div class="feature-img-content">
                            <div class="section-heading aos-init aos-animate" data-aos="fade-up">
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                            </div>
                            <ul class="list-unstyled d-flex flex-wrap list-two-col mt-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                            @if($decodeData['step_data'])
                            @foreach ($decodeData['step_data'] as $itemservice)
                                <li>
                                    <div class="icon-box">
                                    <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" class="img-fluid" alt="{{ $itemservice['step_image_icon_alt_tag'] }}">
                                    </div>
                                    <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                                    <p>{{ $itemservice['step_description'] }}.</p>
                                </li>
                                @endforeach
                             @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="feature-img-holder p-lg-5 pb-3">
                            <div class="bg-danger-soft p-lg-5 p-3 rounded-custom position-relative d-block feature-img-wrap">
                                <div class="position-relative">
                                    <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image1_alt_tag'] }}"  class="img-fluid rounded-custom position-relative aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">
                                    <img src="{{ asset("storage/uploads/".$decodeData['banner_image1']) }}" alt="{{ $decodeData['banner_image1_alt_tag'] }}" class="img-fluid rounded-custom shadow position-absolute top--100 right--100 hide-medium aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                </div>
                                <div class="position-absolute bg-dark-soft z--1 dot-mask dm-size-12 dm-wh-250 bottom-left"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>