@php
  $decodeData=decodeData($page_data);
@endphp
<!--cat subscribe start-->
            <section class="cta-subscribe ptb-120">
                <div class="container">
                    <div class="bg-dark ptb-120 position-relative overflow-hidden rounded-custom">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-8">
                                <div class="subscribe-info-wrap text-center position-relative z-2">
                                    <div class="section-heading">
                                    <h4 class="h5 text-warning">{{ $decodeData['sub_title'] }}</h4>
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                                    </div>
                                    <div class="form-block-banner mw-60 m-auto mt-5">
                                        <a href="{{ $decodeData['button_url'] }}" class="btn btn-primary">{{ $decodeData['button_text'] }}</a>
                                       @if($decodeData['video_button_text'])
                                        <a href="{{ $decodeData['video_button_url'] }}" class="text-decoration-none popup-youtube d-inline-flex align-items-center watch-now-btn ms-lg-3 ms-md-3 mt-3 mt-lg-0">
                                            <i class="fas fa-play"></i> {{ $decodeData['video_button_text'] }} </a>
                                        @endif
 
                                    </div>
                                    <ul class="nav justify-content-center subscribe-feature-list mt-4">
                                    @foreach ($decodeData['steps'] as $stepsclient)
                                    <li class="nav-item">
                                            <span><i class="far fa-check-circle text-primary me-2"></i>{{ $stepsclient['step_title'] }}</span>
                                        </li>
                                   @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
                        <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
                    </div>
                </div>
            </section>
            <!--cat subscribe end-->

        </div>