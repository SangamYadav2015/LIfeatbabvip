@php
$decodeData=decodeData($page_data);
@endphp
<style>
    .about-icon-box .img-iconnew {
    padding: 0px;
  
}
</style>
<section class="ptb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left text-lg-center mb-32 mb-lg-0">
                            <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}"  class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right">
                            <h4 class="text-primary h5 mb-3">{{ $decodeData['sub_title'] }}</h4>
                            <h2 class="mb-4">{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                            <ul class="list-unstyled d-flex flex-wrap list-two-col mt-4 mb-4">
                                <li class="py-1">
                                    <div class="d-flex about-icon-box align-items-center">
                                        <div class="me-3">
                                            <img src="{{ asset("storage/uploads/".$decodeData['image1']) }}" alt="{{ $decodeData['image1_alt_tag'] }}"  class="img-fluid img-iconnew">
                                        </div>
                                        <div>
                                            <h5>{{ $decodeData['image_1_title'] }}</h5>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="d-flex about-icon-box align-items-center">
                                        <div class="me-3">
                                        <img src="{{ asset("storage/uploads/".$decodeData['image2']) }}" alt="{{ $decodeData['image1_alt_tag'] }}" class="img-fluid img-iconnew">
                                        </div>
                                        <div>
                                        <h5>{{ $decodeData['image_2_title'] }}</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @if($decodeData['step_data'])
                            <ul class="list-unstyled d-flex flex-wrap list-two-col mt-4 mb-4">
                            @foreach ($decodeData['step_data'] as $step)
                                <li class="py-1">
                                    <i class="fas fa-check-circle me-2 text-primary"></i>{{ $step['step_title'] }}</li>
                                @endforeach
                            </ul>
                            @endif

                            @if($decodeData['button_text'])
                            <a href="{{ $decodeData['button_url'] }}" class="link-with-icon text-decoration-none mt-3 btn btn-primary">
                            {{ $decodeData['button_text'] }}
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>