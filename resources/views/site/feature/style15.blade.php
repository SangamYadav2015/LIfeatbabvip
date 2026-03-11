@php
$decodeData=decodeData($page_data);
@endphp

<section class="mk-feature-section pt-5 pt-lg-0 pb-40 bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <div class="mk-title text-center">
                            <span class="mk-subtitle fw-bold">{{ $decodeData['sub_title'] }}</span>
                            <h2 class="mt-3 mb-0 mk-heading">{{ $decodeData['title1'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-4 col-lg-7">
                            <div class="mk-feature-content">
                                <h3 class="mk-heading mb-3 lh-lg">{{ $decodeData['title1'] }}</h3>
                                <p class="mb-30">{{ $decodeData['description'] }}</p>

                               @if($decodeData['link_text'])
                                <a href="{{ $decodeData['link_url'] }}" class="mk-explore-btn fw-bold">{{ $decodeData['link_text'] }}
                                    <span class="ms-1">
                                      <svg width="53" height="8" viewBox="0 0 53 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M0 4.00049L48.7939 4.00049" stroke="#FF724B" stroke-width="0.995794"></path>
                                      <path d="M52.7742 3.99978L46.7994 7.44931L46.7994 0.550246L52.7742 3.99978Z" fill="#FF724B"></path>
                                      </svg>
                                  </span>
                                </a>
                                @endif

                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="mk-feature-dashboard position-relative mt-5 mt-xl-0">
                                <img src="{{ asset('site/assets/img/shape/mk-doted.png') }}" alt="doted" class="position-absolute mk-feature-dot">
                                <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}"  class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>