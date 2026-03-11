@php
$decodeData=decodeData($page_data);
@endphp
@if(isset($decodeData['step_data']) && $decodeData['step_data']!== null)
<section class="contact-promo ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            @php
            $i=1;
            @endphp
            @foreach ($decodeData['step_data'] as $step)
            <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                <div class="contact-us-promo p-5 bg-white rounded-custom custom-shadow text-center d-flex flex-column h-100">
                    @if(isset($step['step_image']) && $step['step_image'] !== null)
                    <div class="integration-logo  p-2 d-inline-block" style="box-shadow: none;">
                    <img src="{{ asset("storage/uploads/".$step['step_image']) }}" class="img-fluid">
                    </div>
                    @endif

                    <div class="contact-promo-info mb-4">
                        <h5>{{ isset($step['step_title']) && $step['step_title'] !== null ? $step['step_title']: '' }}</h5>
                        <p>{{ isset($step['step_description']) && $step['step_description'] !== null ? $step['step_description']: '' }}</strong>
                        </p>
                    </div>
                    @if(isset($step['link_text']) && $step['link_text'] !== null)
                    <a href="{{  $step['link_url'] }}" class="{{ $i === 2 ? 'btn btn-primary mt-auto' : 'btn btn-link mt-auto'}}">{{ $step['link_text'] }}</a>
                    @endif
                </div>
            </div>
            @php
            $i++;
            @endphp
            @endforeach

        </div>
    </div>
</section>
@endif

<section class="contact-us-form pt-60 pb-120" style="background: url('assets/img/shape/contact-us-bg.svg')no-repeat center bottom">
            <div class="container">
                <div class="row justify-content-lg-between align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-heading">
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                        </div>
                        <form action="#" class="register-form contactForm" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="firstName" class="mb-1">First name <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="firstName" required="" placeholder="First name" aria-label="First name" name="first_name">
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="lastName" class="mb-1">Last name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last name" aria-label="Last name" name="last_name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone" class="mb-1">Phone <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="phone" required="" placeholder="Phone" aria-label="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="email" class="mb-1">Email<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" id="email" required="" placeholder="Email" aria-label="Email" name="email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="subject" class="mb-1">Subject<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="subject" required="" placeholder="Subject" aria-label="subject" name="subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourMessage" class="mb-1">Message <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="yourMessage" required="" placeholder="How can we help you?" style="height: 120px" name="message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 submitbtn">Get in Touch</button>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-10">
                        <div class="contact-us-img">
                            <img src="{{ asset('storage/uploads/'.$decodeData['image']) }}" alt="contact us" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>