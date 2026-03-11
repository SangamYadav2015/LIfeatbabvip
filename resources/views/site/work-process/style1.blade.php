@php
$decodeData=decodeData($page_data);
@endphp
<!--our work process section start-->
    <section class="work-process ptb-120">
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
                    <div class="process-card text-center px-4 py-lg-5 py-4 rounded-custom shadow-hover mb-3 mb-lg-0">
                        <div class="process-icon border border-light bg-custom-light rounded-custom p-3"  style="display:inline-block; width:200px;">
                            <span class="h6 mb-0 text-primary fw-bold">{{ $itemservice['step_title'] }}</span>
                        </div>
                        <h3 class="h6">{{ $itemservice['step_subtitle'] }}</h3>
                        <p class="mb-0">{{ $itemservice['step_description'] }}</p>
                    </div>
                </div>
                <div class="dots-line first {{$i === 4 ? 'd-none' : ''}}"></div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
        
            </div>
        </div>
    </section>
    <!--our work process section end-->