@php
$decodeData=decodeData($page_data);
@endphp
<section class="feature-tab-section ptb-120 bg-light-subtle">
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
                <ul class="nav justify-content-center feature-tab-list-2 mt-4" id="nav-tab-2" role="tablist">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['tab_data'] as $itemClient)

                    <li class="nav-item">
                        <a class="nav-link {{ $i === 1 ? 'active' : ''}}" href="#tab-2-{{ $i }}" data-bs-toggle="tab" data-bs-target="#tab-2-{{ $i }}" role="tab" aria-selected="false">
                            {{ $itemClient['tab_title'] }}
                        </a>
                    </li>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                </ul>
                <div class="tab-content" id="nav-tabContent-2">
                    @php
                    $j=1;
                    @endphp
                    @foreach ($decodeData['tab_data'] as $itemClient)

                    <div class="tab-pane fade pt-60 {{ $j === 1 ? 'active show' : ''}} " id="tab-2-{{ $j }}" role="tabpanel">
                        @if(($j % 2) === 0)
                        <div class="row justify-content-center align-items-center justify-content-around">
                            <div class="col-lg-5">
                                <div class="feature-tab-info">
                                    <h3>{{ $itemClient['tab_title'] }}</h3>
                                    <p>{{ $itemClient['tab_description'] }}</p>
                                    <a href="{{ $itemClient['button_url'] }}" class="read-more-link text-decoration-none mt-4 d-block">{{ $itemClient['button_text'] }}
                                        <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <img src="{{ asset("storage/uploads/".$itemClient['tab_image']) }}" alt="feature tab" class="img-fluid mt-4 mt-lg-0 mt-xl-0">
                            </div>
                        </div>
                        @else
                        <div class="row justify-content-center align-items-center justify-content-around">
                            <div class="col-lg-5">
                                <img src="{{ asset("storage/uploads/".$itemClient['tab_image']) }}" alt="feature tab" class="img-fluid mt-4 mt-lg-0 mt-xl-0">
                            </div>
                            <div class="col-lg-5">
                                <div class="feature-tab-info">
                                    <h3>{{ $itemClient['tab_title'] }}</h3>
                                    <p>{{ $itemClient['tab_description'] }}</p>
                                    <a href="{{ $itemClient['button_url'] }}" class="read-more-link text-decoration-none mt-4 d-block">{{ $itemClient['button_text'] }}
                                        <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>

                    @php
                    $j++;
                    @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>