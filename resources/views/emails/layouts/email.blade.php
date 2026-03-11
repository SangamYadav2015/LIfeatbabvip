<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #dda529, #926d8b);
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 30px 20px;
            color: #555555;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 20px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #fa0505, #fe6e0f);
            color: #ffffff;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 25px;
            text-align: center;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }
        .cta-button:hover {
            background: linear-gradient(135deg, #fe6e0f, #fabb05);
        }
        .highlight-text {
            color: #9b0c44;
            font-weight: bold;
            font-size: 18px;
        }
        .social-media {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #fabb05, #82619f);
        }
        .social-media a {
            margin: 0 10px;
            text-decoration: none;
            color: #ffffff;
            font-size: 16px;
        }
        .footer {
            background: linear-gradient(135deg, #fa1706, #fd550c);
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #fabb05;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .email-body{
            padding: 10px;
        }
    </style>
       <style>
        .social-media {
            font-family: 'Material Icons', sans-serif;
        }
        .social-media a {
            text-decoration: none;
            color: #000;
            margin-right: 10px;
        }
        .social-media i {
            font-size: 24px;
        }
    </style>
</head>
<body>
   
@yield('content')
      
</body>
</html>
