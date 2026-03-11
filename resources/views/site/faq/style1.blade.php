@php
$decodeData=decodeData($page_data);
@endphp
<section class="faq-section ptb-120 bg-light-subtle">
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
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 col-12">
                <div class="faq-wrapper">
                    @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['step_data'] as $itemservice)
                    <div class="faq-item mb-5">
                        <h5><span class="h3 text-primary me-2">{{ $i }}.</span>{{ $itemservice['faq_question'] }}</h5>
                        <p>{{ $itemservice['faq_answer'] }}</p>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center mt-4 mt-lg-0 mt-md-0">
                    <img src=" {{ asset("storage/uploads/".$decodeData['banner_image']) }}" alt="{{ $decodeData['banner_image_alt_tag'] }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>