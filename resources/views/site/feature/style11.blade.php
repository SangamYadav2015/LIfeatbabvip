@php
$decodeData=decodeData($page_data);
@endphp

<section class="app-two-feature-two pt-60 pb-120">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 col-xl-6 col-md-12">
                        <div class="app-two-feature-two-img">
                            <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="app-two-feature-two-right">
                            <div class="feature-content-wrap">
                                <h4 class="h6">{{ $decodeData['sub_title'] }}</h4>
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }} </p>
                            </div>
                            <div class="app-two-feature-two-content">
                            @if($decodeData['step_data'])
                                <ul class="list-unstyled d-flex flex-wrap list-two-col mt-4">
                                @foreach ($decodeData['step_data'] as $step)
                                    <li class="py-1">
                                        <i class="fas fa-check-circle me-2"></i>{{ $step['step_title'] }}
                                    </li>
                                  @endforeach
                                </ul>
                                @endif
                                @if($decodeData['button_text'])
                                <div class="action-btns mt-5">
                                    <a href="{{ $decodeData['button_link'] }}" class="btn app-two-btn" target="_blank">{{ $decodeData['button_text'] }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>