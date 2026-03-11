@php
$decodeData=decodeData($page_data);
@endphp
<section class="why-us ptb-120">
    <div class="container">
        <div class="row justify-content-center align-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="section-heading text-center mb-4">
                    <h5 class="h6 text-primary">{{ $decodeData['sub_title'] }}</h5>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav justify-content-center feature-tab-list mt-4" id="nav-tab" role="tablist">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['tab_data'] as $itemClient)

                    <li class="nav-item">
                        <a class="nav-link {{ $i === 1 ? 'active' : ''}}" href="#tab-{{ $i }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $i }}" role="tab" aria-selected="true">{{ $itemClient['tab_title'] }}</a>
                    </li>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </ul>
                <div class="tab-content bg-white text-white rounded-custom" id="nav-tabContent">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['tab_data'] as $itemClient)
                    <div class="tab-pane fade {{ $i === 1 ? 'show active' : ''}}" id="tab-{{ $i }}" role="tabpanel">
                        <div class="row justify-content-center text-center p-50 pb-0">
                            <div class="col-lg-8">
                                <div class="feature-tab-info">
                                    <p class="lead">{{ $itemClient['tab_description'] }}</p>
                                    <a href="{{ $itemClient['button_url'] }}" class="btn btn-outline-primary text-decoration-none">{{ $itemClient['button_text'] }}</a>
                                </div>

                                <img src="{{ asset("storage/uploads/".$itemClient['tab_image']) }}" alt="{{ $itemClient['tab_image_alt_tag'] }}" class="img-fluid mt-5">
                            </div>
                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>