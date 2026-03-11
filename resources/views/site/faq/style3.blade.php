@php
$decodeData=decodeData($page_data);
@endphp

<section class="app-two-feature-three bg-light-subtle ptb-120">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-5 col-xl-5 col-sm-12">
                        <div class="app-two-feature-three-left">
                            <div class="app-content-feature-wrap">
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }} </p>
                            </div>
                            @if($decodeData['step_data'])
                             @php
                             $i=1;
                             @endphp
                            <div class="accordion faq-accordion mt-5" id="accordionExample{{ $i }}">
                            @foreach ($decodeData['step_data'] as $step)
                            <div class="accordion-item active border-0">
                                    <h5 class="accordion-header" id="faq-{{ $i }}">
                                        <button class="accordion-button {{ $i !== 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}" aria-expanded="true">
                                        @if($i===1)    
                                        <i class="far fa-bell pe-3"></i> 
                                        @elseif($i===2)
                                        <i class="fas fa-bars pe-3"></i> 
                                        @else
                                        <i class="fas fa-link pe-3"></i> 
                                        @endif  
                                            {{ $step['faq_question'] }}
                                        </button>
                                    </h5>
                                    <div id="collapse-{{ $i }}" class="accordioncollapse collapse {{ $i === 1 ? 'show' : '' }}" aria-labelledby="faq-{{ $i }}" data-bs-parent="#accordionExample{{ $i }}" style="">
                                        <div class="accordion-body">
                                        {{ $step['faq_answer'] }}
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
                    <div class="col-lg-6 col-xl-6 col-sm-12">
                        <div class="app-two-feature-three-img position-relative text-center mt-5 mt-lg-0">
                            <div class="feature-three-shape">
                                <img src="{{ asset("site/assets/img/app-two-feature-blob-shape.png") }}" alt="app screen" class="feature-three-blob img-fluid">
                            </div>
                            <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}"  class="position-relative z-5">
                            <div class="img-peice d-none d-lg-block">
                                <img src="{{ asset("storage/uploads/".$decodeData['image1']) }}" alt="{{ $decodeData['image1_alt'] }}" class="img-one position-absolute custom-shadow">
                                <img src="{{ asset("storage/uploads/".$decodeData['image2']) }}" alt="{{ $decodeData['image2_alt'] }}" class="img-two position-absolute custom-shadow">
                                <img src="{{ asset("storage/uploads/".$decodeData['image3']) }}" alt="{{ $decodeData['image3_alt'] }}" class="img-three position-absolute custom-shadow">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>