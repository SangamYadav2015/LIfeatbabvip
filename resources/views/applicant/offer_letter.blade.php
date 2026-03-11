@extends('applicant.body.app')

@section('content')

<div class="container my-5">
    <h2>Notification Details</h2>

    <div class="alert alert-info">
        @php
            // Decode the JSON data into an array
            $notificationData = json_decode($notification->data, true);
        @endphp

        <strong>Type:</strong> {{ $notificationData['type'] ?? 'N/A' }}
    </div>

    <p><strong>Message:</strong>
        <!-- Rendering the Message as Raw HTML -->
        @if(isset($notificationData['message']))
            {!! $notificationData['message'] !!}
        @else
            {!! $notification->data !!}
        @endif
    </p>

    <!-- Render the Offer Letter HTML if it exists -->
    @if(isset($notificationData['offer_letter_html']))
        <div class="offer-letter">
            {!! $notificationData['offer_letter_html'] !!}
        </div>
    @endif
    <form action="{{ route('offer.accept', $notification->id) }}" method="POST">
            @csrf
            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
            <button type="submit" class="btn btn-primary">Accept Offer</button>
        </form>
    <small><strong>Sent:</strong> {{ $notification->created_at->diffForHumans() }}</small>
</div>

@endsection
