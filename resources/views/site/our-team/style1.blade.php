@php
$decodeData=decodeData($page_data);
$teams= getLatestTeamMember();
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
            @foreach ($teams as $item)

            <div class="col-lg-3 col-md-6">
                <div class="team-single-wrap mt-5">
                    <div class="team-img rounded-custom">
                        <img src="{{ asset('storage/uploads/'.$item->team_image) }}" alt="{{ $item->team_image }}" class="img-fluid position-relative">
                        <ul class="list-unstyled team-social-list d-flex flex-column mb-0">
                            @if($item->linkedin_url !== null)
                            <li class="list-inline-item">
                                <a href="{{ $item->linkedin_url }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                            @endif

                            @if($item->instagram_url !== null)
                            <li class="list-inline-item">
                                <a href="{{ $item->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                            @endif

                            @if($item->facebook_url !== null)
                            <li class="list-inline-item">
                                <a href="{{ $item->facebook_url }}" target="_blank"><i class="fab fa-facebook"></i></a>
                            </li>
                            @endif
                            
                        </ul>

                    </div>
                    <div class="team-info mt-4 text-center">
                        <h5 class="h6 mb-1">{{ $item->name. ' '. $item->lastname }}</h5>
                        <p class="text-muted small mb-0">{{ $item->designation }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>