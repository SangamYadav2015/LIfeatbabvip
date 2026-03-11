@php
$decodeData=decodeData($page_data);
@endphp
<!--our work process start-->
<section class="work-process ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section-heading text-center">
                    <h4 class="h5 text-primary">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 col-md-12 order-1 order-lg-0">
                <div class="img-wrap">
                    <img src="{{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}" class="img-fluid rounded-custom">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 order-0 order-lg-1">
                <ul class="work-process-list list-unstyled">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['step_data'] as $itemservice)
                    <li class="d-flex align-items-start mb-4">
                        <div class="process-icon-2 border border-2 rounded-custom bg-white me-4 mt-2">
                        <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                        </div>
                        <div class="icon-content">
                            <span class="text-primary h6">{{  $itemservice['step_title'] }}</span>
                            <h3 class="h5 mb-2">{{  $itemservice['step_subtitle'] }}</h3>
                            <p>{{  $itemservice['step_description'] }}</p>
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
</section> <!--our work process end-->