@php
$decodeData=decodeData($page_data);
@endphp
<!--integration section start-->
<section class="integration-section ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3">
                <div class="integration-list-wrap">

                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['left_icon'] as $leftIcon)
                    <a href="#" class="integration-{{  $i }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Brand Name">
                        <img src="{{ asset("storage/uploads/".$leftIcon['left_image_icon']) }}" alt="{{ $leftIcon['left_icon_alt_tag'] }}" class="img-fluid rounded-circle">
                    </a>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="section-heading text-center my-5 my-lg-0 my-xl-0">
                    <h5 class="h6 text-primary">{{ $decodeData['title'] }}</h5>
                    <h2>{{ $decodeData['subtitle'] }}</h2>
                    <a href="{{ $decodeData['button_url'] }}" class="mt-4 btn btn-primary">{{ $decodeData['button_text'] }}</a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="col-lg-4">
                    <div class="integration-list-wrap">
                        @php
                        $i=7;
                        @endphp
                        @foreach ($decodeData['right_icon'] as $rightIcon)
                        <a href="#" class="integration-{{  $i }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Brand Name">
                            <img src="{{ asset("storage/uploads/".$rightIcon['right_image_icon']) }}" alt="{{ $rightIcon['right_icon_alt_tag'] }}" class="img-fluid rounded-circle">
                        </a>
                        @php
                        $i++;
                        @endphp
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-100">
            @php
            $i=1;
            @endphp
            @foreach ($decodeData['step_data'] as $itemservice)
            <div class="col-lg-5 col-md-12">
                <a href="#" class="mb-4 mb-md-0 mb-xl-0 position-relative text-decoration-none connected-app-single border border-light border-2 rounded-custom d-block overflow-hidden p-5">
                    <div class="position-relative connected-app-content">
                        <div class="integration-logo bg-custom-light rounded-circle shadow-sm p-2 d-inline-block">
                            <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" width="40" alt="{{ $itemservice['step_image_icon_alt_tag'] }}"  class="img-fluid">
                        </div>
                        <h5>{{ $itemservice['step_title'] }}</h5>
                        <p class="mb-0 text-muted">{{ $itemservice['step_description'] }}</p>
                    </div>
                    <!-- <span class="position-absolute integration-badge badge px-3 py-2 bg-primary-soft text-primary">Connect</span> -->
                </a>
            </div>
            @php
            $i++;
            @endphp
            @endforeach

        </div>
    </div>
</section>
<!--integration section end-->