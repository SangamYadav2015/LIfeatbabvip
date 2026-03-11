@php
$decodeData=decodeData($page_data);
@endphp

<section class="mk-business bg-white">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-7">
                        <div class="mk-business-pr position-relative">
                            <img src="assets/img/shape/mk-doted-lg.png" alt="not found" class="position-absolute mk-doted-lg">
                            <img src="{{ asset("storage/uploads/".$decodeData['image1']) }}" alt="{{ $decodeData['image1_alt_tag'] }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="mk-business-content">
                            <h3 class="mk-heading mb-3">{{ $decodeData['title'] }}</h3>
                            <p class="mb-30">{{ $decodeData['description1'] }}</p>

                            @if($decodeData['step_data'])
                            <ul class="mk-business-reports p-0">
                            @foreach ($decodeData['step_data'] as $step)
                            <li class="d-flex align-items-start mk-bg-secondary">
                                 <span class="d-inline-flex align-items-center justify-content-center rounded flex-shrink-0">
                                    <img src="{{ asset("storage/uploads/".$step['step_image']) }}" alt=" {{ $step['step_image_alt_tag'] }}" class="img-fluid">
                                  </span>
                                    <div class="ms-4">
                                        <h6 class="mk-heading mb-2">{{ $step['step_title'] }}</h6>
                                        <p class="mb-0">{{ $step['step_description'] }}</p>
                                    </div>
                                </li>
                               @endforeach
                            </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="mk-sass-platform bg-white pt-120 pt-xl-0">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5">
                        <div class="mk-sass-content">
                            <span class="mk-subtitle mb-3 fw-bold">{{ $decodeData['sub_title'] }}</span>
                            <h3 class="mk-heading lh-lg mb-3">{{ $decodeData['title1'] }}</h3>
                            <p class="mb-0">{{ $decodeData['description2'] }}</p>
                            @if($decodeData['button_text'])
                            <a href="{{ $decodeData['button_url'] }}" class="btn btn-primary mt-40" target="_blank">{{ $decodeData['button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mk-sass-dashboard mt-4 mt-xl-0">
                            <img src="{{ asset("storage/uploads/".$decodeData['image2']) }}" alt="{{ $decodeData['image2_alt_tag'] }}"  class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>