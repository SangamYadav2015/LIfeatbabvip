@extends('emails.layouts.email')

@section('title', 'Contact Us Message')
@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
<div class="email-wrapper">
<div class="email-container">
<div class="header">
    <img src="{{ asset('admin/images/BABVIPLOGO.png') }}" alt="Logo" class="logo">
    <h1>Invalid login Attempt!</h1>
</div>
<div class="email-body">
    <p>Dear  ,{{ $name }}</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click <a href="{{ url('/applicant/password/reset', $token) }}?email={{ $email }}">here</a> to reset your password.</p>
    <p>The link will expire in 15 minutes.</p>
</div>
<div class="social-media">
        <p>Follow us on social media:</p>
        <a href="https://www.facebook.com/babvipcreations" target="_blank">
            <i class="material-icons">facebook</i>
        </a>
        <a href="https://www.instagram.com/babvipcreations/" target="_blank">
            <i class="material-icons">instagram</i>
        </a>
        <a href="https://www.linkedin.com/company/babvipcreations" target="_blank">
            <i class="material-icons">linkedin</i>
        </a>
    </div>

<!-- Footer Section -->
<div class="footer">
    <p>© 2024 Babvip Softwares. All rights reserved.</p>
    <p>Sahastradhara Road, Dehradun, UK 248001 , INDIA <a href="#">Unsubscribe</a></p>
</div>
</div>
</div>