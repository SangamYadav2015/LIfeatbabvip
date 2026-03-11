@php
$decodeData=decodeData($page_data);
$departments= getlocationData();
@endphp
<section class="team-section ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="section-heading text-center">
                    <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                    <h2>{{ $decodeData['title'] }}</h2>
                    <p>
                        {{ $decodeData['description'] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($departments as $item)

            <div class="col-lg-3 col-md-6">
                <div class="team-single-wrap mt-5">
                    <div class="team-img rounded-custom">
                        <img src="{{ asset('storage/'.$item->department_image) }}" alt="{{ $item->department_image }}" class="img-fluid position-relative">
                    </div>
                    <div class="team-info mt-4 text-center">
                        <h5 class="h6 mb-1">{{ $item->Department_name }}</h5>
                        <!-- <p class="text-muted small mb-0">{{ $item->designation }}</p> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>