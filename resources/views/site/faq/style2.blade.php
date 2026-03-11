@php
$decodeData=decodeData($page_data);
@endphp
            <!--faq section start-->
            <section class="faq-section ptb-120">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-12">
                            <div class="section-heading mb-5 text-center">
                                <h5 class="h6 text-primary">{{ $decodeData['subtitle'] }}</h5>
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-12">
                            <div class="accordion faq-accordion" id="accordionExample">
                   @php
                    $i=1;
                    @endphp
                    @foreach ($decodeData['step_data'] as $itemservice)
                                <div class="accordion-item border border-2 {{ $i===1 ? 'active' : '' }}">
                                    <h5 class="accordion-header" id="faq-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}" aria-expanded="true">
                                        {{ $itemservice['faq_question'] }}
                                        </button>
                                    </h5>
                                    <div id="collapse-{{ $i }}" class="accordion-collapse collapse {{ $i===1 ? 'show' : '' }}" aria-labelledby="faq-1" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                        {{ $itemservice['faq_answer'] }}
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
            <!--faq section end-->