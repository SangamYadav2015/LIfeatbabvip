@php
  $decodeData=decodeData($page_data);
@endphp

<section class="app-two-cta ptb-120 text-white bg-purple" style="background-image:
      url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}');     background-size: cover;">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 col-xl-6">
                        <div class="app-two-mockup position-relative text-center pe-5">
                            <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt'] }}" class="img-fluid position-relative z-5">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-10">
                        <div class="app-two-cta-right px-md-0 pt-5 pt-md-0">
                            <div class="section-heading text-white">
                                <h2 class="text-white">
                                {{ $decodeData['title'] }}
                                </h2>
                                <p>
                                {{ $decodeData['description'] }}
                                </p>
                            </div>
                            @if($decodeData['step_data'])
                            <div class="cta-count">
                                <ul class="list-unstyled d-flex">
                                @foreach ($decodeData['step_data'] as $step)
                                    <li class="me-4">
                                        <h3 class="text-white mb-0"> {{ $step['step_title'] }}</h3>
                                        <span>{{ $step['step_sub_title'] }}</span>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            @endif
                            @if($decodeData['button_text'])
                            <div class="action-btns mt-5">
                                <a href="{{ $decodeData['button_url'] }}" class="btn btn-outline-light">{{ $decodeData['button_text'] }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>