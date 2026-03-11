@php
$decodeData=decodeData($page_data);
@endphp

<section class="hd-faq-section pb-80">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-xl-5 col-lg-8">
                <div class="hd-chat-box">
                    <h3 class="text-white mb-3">{{ $decodeData['title1'] }}</h3>
                    <p class="text-white mb-4">{{ $decodeData['description'] }} </p>
                    @if($decodeData['link_text'])
                    <a href="{{ $decodeData['link_url'] }}" class="read-more-link text-warning">{{ $decodeData['link_text'] }} <i class="fas fa-angle-right ms-1"></i></a>
                    @endif
                    <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}"  class="img-fluid mt-4">
                </div>
            </div>
            <div class="col-xl-7 col-lg-8 align-self-end">
                <div class="hd-faq-wrapper">
                    <div class="hd-title">
                        <h2 class="clr-text">{{ $decodeData['title'] }} <mark class="bg-transparent p-0 position-relative">{{ $decodeData['highlited_title'] }} <img src="{{ asset('site/assets/img/shape/line-shape.png') }}" alt="line shape" class="position-absolute line-shape"></mark></h2>
                    </div>
                    @if($decodeData['step_data'])
                    <div class="accordion hd-accordion hd-accordion2 mt-60" id="hd_accordion-1">
                        @php
                        $i=1;
                        @endphp

                        @foreach ($decodeData['step_data'] as $itemservice)
                        <div class="accordion-item 
                        @if($i === 1) 
                         active
                         @endif

                         ">
                            <div class="accordion-header">
                                <a href="#hd2_acc-{{ $i }}" class="collapsed" data-bs-toggle="collapse">{{ $itemservice['faq_question'] }}</a>
                            </div>
                            <div class="accordion-collapse collapse
                         @if($i === 1) 
                         show
                         @endif
                            " id="hd2_acc-{{ $i }}" data-bs-parent="#hd_accordion-{{ $i }}">
                                <div class="accordion-body pt-0">
                                    <p class="mb-0">{{ $itemservice['faq_answer'] }}</p>
                                </div>
                            </div>
                        </div>
                    @php
                    $i++;
                    @endphp
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>