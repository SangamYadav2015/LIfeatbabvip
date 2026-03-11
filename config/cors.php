<?php
return [
    'paths' => ['api/*', 'login', 'logout', 'csrf-token','applicant'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5176', 'http://localhost:5177', 'https://www.lifeatbabvip.com','https://lifeatbabvip.com'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],
    'exposed_headers' => ['Authorization'], // Important if you need the frontend to read headers
    'max_age' => 0,
    'supports_credentials' => true,
    
];
