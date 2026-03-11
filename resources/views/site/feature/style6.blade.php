@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-section two-bg-dark-light ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-6">
                <div class="image-wrap">
                    <img src="{{ asset("storage/uploads/".$decodeData['image']) }}" alt="{{ $decodeData['image_alt_tag'] }}" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="feature-content-wrap">
                    <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                    <ul class="list-unstyled mt-5">
                        @php
                        $i=1;
                        @endphp
                        @foreach ($decodeData['step_data'] as $itemservice)
                        <li class="d-flex align-items-start mb-4">
                            <div class="icon-box  rounded me-4">
                                <img src="{{ asset("storage/uploads/".$itemservice['step_image']) }}" alt="{{ $itemservice['step_image_icon_alt_tag'] }}" class="img-fluid p-0">
                            </div>
                            <div class="icon-content">
                                <h3 class="h5">{{ $itemservice['step_title'] }}</h3>
                                <p>{{ $itemservice['step_description'] }}</p>
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