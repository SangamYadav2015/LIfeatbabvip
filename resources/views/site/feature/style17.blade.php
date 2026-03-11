@php
$decodeData=decodeData($page_data);
@endphp
<section class="crm-brand ptb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center">
                            <h4 class="mb-0 fw-semibold clr-text">{{ $decodeData['title'] }}</h4>
                        </div>
                    </div>
                </div>
                @if($decodeData['step_data'])

                <div class="crm-brands-row mt-4">
                @foreach ($decodeData['step_data'] as $step)
                        <img src="{{ asset("storage/uploads/".$step['step_image']) }}" alt=" {{ $step['step_image_alt_tag'] }}" class="black img-fluid">
                   @endforeach
                </div>
                @endif
            </div>
        </section>