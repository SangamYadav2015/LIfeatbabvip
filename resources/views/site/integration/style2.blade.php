@php
$decodeData=decodeData($page_data);
@endphp
<!--integration section start-->
<section class="integration-section bg-light-subtle ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-7 col-md-12">
                <div class="section-heading">
                    <h5 class="h6 text-primary">{{ $decodeData['title'] }}</h5>
                    <h2>{{ $decodeData['subtitle'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
            @if($decodeData['button_text'] )
            <div class="col-lg-4 col-md-12">
                <div class="text-lg-end mb-5 mb-lg-0">
                    <a href="{{$decodeData['button_url']}}" target="_blank" class="btn btn-primary">{{ $decodeData['button_text'] }}</a>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="integration-wrapper position-relative w-100">
                    <ul class="integration-list list-unstyled mt-5">
                        @php
                        $i=1;
                        @endphp
                        @foreach ($decodeData['step_data'] as $itemservice)
                        <li>
                            <div class="single-integration">
                                <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid">
                                <h6 class="mb-0 mt-4">{{$itemservice['step_title'] }}</h6>
                            </div>
                        </li>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--integration section end-->