@php
  $decodeData=decodeData($page_data);
@endphp
            <!--cat section start-->
            <section class="cta-section bg-dark ptb-120 position-relative overflow-hidden">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-5 col-md-12">
                            <div class="position-relative z-5">
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                                <a href="{{ $decodeData['button_url'] }}" class="btn btn-primary mt-4">{{ $decodeData['button_text'] }}</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row align-items-center justify-content-center position-relative z-2">
                                <div class="col-md-6">
                                    @if(isset($decodeData['steps'][0]))
                                     <div class="cta-card rounded-custom text-center shadow p-5 bg-white my-4">
                                        <h3 class="display-5 fw-bold">{{ $decodeData['steps'][0]['step_title'] }}</h3>
                                        <p class="mb-0">{{ $decodeData['steps'][0]['step_description'] }}</p>
                                    </div>
                                    @endif
                                    @if(isset($decodeData['steps'][1]))
                                    <div class="cta-card rounded-custom text-center shadow p-5 bg-white my-4">
                                    <h3 class="display-5 fw-bold">{{ $decodeData['steps'][1]['step_title'] }}</h3>
                                    <p class="mb-0">{{ $decodeData['steps'][1]['step_description'] }}</p>
                                    </div>
                                    @endif
                                </div>
                                    @if(isset($decodeData['steps'][2]))
                                <div class="col-md-6">
                                    <div class="cta-card rounded-custom text-center shadow p-5 bg-white">
                                    <h3 class="display-5 fw-bold">{{ $decodeData['steps'][2]['step_title'] }}</h3>
                                    <p class="mb-0">{{ $decodeData['steps'][2]['step_description'] }}</p>
                                    </div>
                                </div>
                                @endif
                                <div class="bg-circle rounded-circle position-absolute z--1">
                                    <img src="{{ asset('site/assets/img/shape/blob.svg') }}" alt="feature image" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-30"></div>
                    <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning left-5"></div>
                </div>
            </section>
            <!--cat section end-->

