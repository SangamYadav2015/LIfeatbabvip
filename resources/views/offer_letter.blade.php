<!-- resources/views/offer_letter.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Offer Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
        }
        .content {
            margin: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Offer Letter</h1>
        <h2>{{ $applicant->full_name }}</h2>
        <p>Date: {{ date('F j, Y') }}</p>
    </div>
    <div class="content">
        <p>Dear {{ $applicant->full_name }},</p>
        <p>We are pleased to offer you the position of {{ $position }} at {{ $company_name }}.</p>
        <p>Your starting date will be {{ $start_date }}. You will receive a salary of {{ $salary }}.</p>
        <p>We look forward to having you on our team.</p>
        <p>Sincerely,</p>
        <p>{{ $hr_representative }}</p>
        <p>{{ $company_name }}</p>
    </div>
    <div class="footer">
        <p>This is a computer-generated document and does not require a signature.</p>
    </div>
</body>
</html>
