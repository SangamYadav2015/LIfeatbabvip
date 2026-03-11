@extends('emails.layouts.email')

@section('title', 'Offer Letter')

<div class="email-wrapper">
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('admin/images/BABVIPLOGO.png') }}" alt="Logo" class="logo">
            <h1>Job Offer: Welcome to the Team!</h1>
        </div>

        <div class="email-body">
            <p>Dear {{ $applicantName }},</p>

            <p>We are pleased to extend an offer for the position of <strong>{{ $jobTitle }}</strong> at <strong>Babvip Softwares</strong>. After reviewing your application and interviewing you, we are confident that your skills and experience will be a valuable addition to our team.</p>

            <p><strong>Job Details:</strong></p>
           

            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Please review and sign the attached offer letter by deadline.</li>
                <li>Once signed, you will receive additional information about your onboarding process.</li>
            </ul>

            <p>If you have any questions or need further clarification, feel free to reach out to us</p>

            <p>We are excited to have you on board and look forward to working together!</p>

            <p>Best regards,</p>
            <p>Human Resources Team<br>Babvip Softwares</p>
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
