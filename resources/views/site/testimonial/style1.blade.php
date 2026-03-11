@php
  $decodeData=decodeData($page_data);
@endphp
<section class="testimonial-section ptb-120 ">
                <div class="container">
                    <div class="row justify-content-center align-content-center">
                        <div class="col-md-10 col-lg-6">
                            <div class="section-heading text-center">
                                <h4 class="h5 text-primary">{{ $decodeData['sub_title'] }}</h4>
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="position-relative w-100">
                                <div class="swiper testimonialSwiper">
                                <div class="swiper-wrapper">
                                @foreach ($decodeData['review'] as $itemClient)

                                        <div class="swiper-slide">
                                            <div class="border border-2 p-5 rounded-custom position-relative">
                                                <img src="{{ asset('site/assets/img/testimonial/quotes-dot.svg') }}" alt="quotes" width="100" class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                                <div class="d-flex mb-32 align-items-center">
                                                    <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" alt="{{ $itemClient['alt_tag'] }}"  class="img-fluid me-3 rounded" width="60">
                                                    <div class="author-info">
                                                        <h6 class="mb-0">{{ $itemClient['client_name'] }}</h6>
                                                        <small>{{ $itemClient['designation'] }}</small>
                                                    </div>
                                                </div>
                                                <blockquote>
                                                    <h6>{{ $itemClient['review_title'] }}</h6>
                                                    {{ $itemClient['review_description'] }}
                                                </blockquote>
                                                <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                    @for($i= 1; $i <= $itemClient['client_rating']; $i++)
                                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                    @endfor
                                                </ul>
                                                <img src="{{ asset('site/assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                            </div>
                                        </div>
                                @endforeach

                                    </div>
                                </div>
                                <div class="swiper-nav-control">
                                    <span class="swiper-button-next"></span>
                                    <span class="swiper-button-prev"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 