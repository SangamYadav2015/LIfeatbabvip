<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
</head>
<body>
<p>Hello {{ $first_name }},</p>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>

    <p>
        <a href="{{ $url }}" style="display:inline-block;padding:10px 20px;background-color:#3490dc;color:#fff;text-decoration:none;border-radius:5px;">
            Verify Email
        </a>
    </p>

    <p>This link will expire in 10 minutes.</p>

    <p>If you did not create an account, please ignore this email.</p>

    <p>Regards,<br>The Team</p>
</body>
</html>
