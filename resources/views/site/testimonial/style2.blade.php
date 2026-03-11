@php
  $decodeData=decodeData($page_data);
@endphp
<section class="customer-review-tab ptb-120 bg-light-subtle position-relative z-2">
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
                            <div class="tab-content" id="testimonial-tabContent">
                            @php 
                            $i=1;
                            @endphp
                            @foreach ($decodeData['review'] as $itemClient)
                                <div class="tab-pane fade  {{ $i === 1 ? 'active show' : ''}}" id="testimonial-tab-{{  $i }}" role="tabpanel">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="testimonial-tab-content mb-5 mb-lg-0 mb-md-0">
                                                <img src="{{ asset('site/assets/img/testimonial/quotes-left.svg') }}" alt="testimonial quote" width="65" class="img-fluid mb-32">
                                                <div class="blockquote-title-review mb-4">
                                                    <h3 class="mb-0 h4 fw-semi-bold">{{ $itemClient['review_title'] }}
                                                        it!</h3>
                                                    <ul class="review-rate mb-0 list-unstyled list-inline">
                                                    @for($j= 1; $j <= $itemClient['client_rating']; $j++)
                                                    <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                    @endfor
                                                        
                                                    </ul>
                                                </div>

                                                <blockquote class="blockquote">
                                                    <p>{{ $itemClient['review_description'] }}</p>
                                                </blockquote>
                                                <div class="author-info mt-4">
                                                    <h6 class="mb-0">{{ $itemClient['client_name'] }}</h6>
                                                    <span>{{ $itemClient['designation'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-6">
                                            <div class="author-img-wrap pt-5 ps-5">
                                                <div class="testimonial-video-wrapper position-relative">
                                                    <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" class="img-fluid rounded-custom shadow-lg  w-100" alt="testimonial author">
                                                    <div class="customer-info text-white d-flex align-items-center">
                                                        <a href="{{ $itemClient['video_link'] }}" class="video-icon popup-youtube text-decoration-none"><i
                                                                class="fas fa-play"></i> <span
                                                                class="text-white ms-2 small"> Watch Video</span></a>
                                                    </div>
                                                    <div class="position-absolute bg-secondary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @php 
                            $i++;
                            @endphp
                         @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills testimonial-tab-menu mt-60" id="testimonial" role="tablist">
                            @php 
                            $i=1;
                            @endphp
                            @foreach ($decodeData['review'] as $itemClient)  
                            <li class="nav-item" role="presentation">
                                    <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link  {{ $i === 1 ? 'active' : ''}}" data-bs-toggle="pill" data-bs-target="#testimonial-tab-{{ $i }}" role="tab" aria-selected="false">
                                        <div class="testimonial-thumb me-3">
                                            <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" width="50" class="rounded-circle" alt="testimonial thumb">
                                        </div>
                                        <div class="author-info">
                                            <h6 class="mb-0">{{ $itemClient['client_name'] }}</h6>
                                            <span>{{ $itemClient['designation'] }}</span>
                                        </div>
                                    </div>
                                </li>
                             @php 
                             $i++;
                            @endphp
                         @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>