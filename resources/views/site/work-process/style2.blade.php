@php
$decodeData=decodeData($page_data);
@endphp
<!--our work process section start-->
<section class="work-process ptb-120 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6">
                <div class="section-heading text-center">
                    <h4 class="h5 text-primary">{{ $decodeData['subtitle'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            @php
            $i=1;
            @endphp
            @foreach ($decodeData['step_data'] as $itemservice)
            <div class="col-md-6 col-lg-3">
                <div class="process-card-two text-center px-4 py-5 rounded-custom shadow-hover mt-4">
                    <div class="process-icon border border-light bg-custom-light rounded-custom">
                    <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                    </div>
                    <h3 class="h5">{{  $itemservice['step_title'] }}</h3>
                    <p class="mb-0">{{  $itemservice['step_description'] }}.</p>
                </div>
            </div>
            @php
            $i++;
            @endphp
            @endforeach
        </div>
    </div>
</section>
<!--our work process section end-->