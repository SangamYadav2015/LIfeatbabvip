@php
$decodeData=decodeData($page_data);
@endphp
<section class="testimonial-section ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-12 col-lg-5">
                <div class="section-heading">
                    <h4 class="h5 text-primary">{{ $decodeData['sub_title'] }}</h4>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>{{ $decodeData['description'] }}</p>
                    <a href="{{ $decodeData['button_url'] }}" class="btn btn-primary mt-4">{{ $decodeData['button_text'] }}</a>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 mt-5 mt-lg-0">
                <div class="tab-content" id="nav-tabContent">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['review'] as $itemClient)

                    <div class="tab-pane fade {{ $i === 1 ? 'active show' : ''}}" id="testimonial-tab--new{{  $i }}" role="tabpanel">
                        <div class="testimonial-content-wrap position-relative">
                            <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" alt="client logo" width="130" class="img-fluid">
                            <ul class="review-rate list-unstyled list-inline mt-3">
                                @for($j= 1; $j <= $itemClient['client_rating']; $j++) <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    @endfor
                            </ul>
                            <blockquote class="lead">
                                {{ $itemClient['review_description'] }}
                            </blockquote>
                            <div class="author-info mt-4">
                                <h6 class="mb-0">{{ $itemClient['client_name'] }}</h6>
                                <small>{{ $itemClient['designation'] }}</small>
                            </div>
                            <img src="{{ asset('site/assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1">
                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                </div>
                <ul class="nav testimonial-tab-list mt-4" id="nav-tab" role="tablist">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['review'] as $itemClient)
                    <li class="nav-item">
                        <a class="{{ $i === 1 ? 'active' : ''}}" href="#testimonial-tab-1" data-bs-toggle="tab" data-bs-target="#testimonial-tab-new{{ $i }}" role="tab" aria-selected="true">
                            <img src="{{ asset("storage/uploads/".$itemClient['image']) }}" class="img-fluid rounded-circle" width="60" alt="user">
                        </a>
                    </li>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>