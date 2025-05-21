<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Verify Your Email Address</h2>
    <p>Dear {{$name}},</p>
    <p>Thank you for registering! Please click the button below to verify your email address:</p>
    <a href="{{$link}}" class="button" target='_blank'>Verify Email Address</a>
    <p>If the button doesn't work, you can copy and paste the following link into your browser:</p>
    <p>{{$link}}</p>
    <div class="footer">
        <p>If you did not create an account, no further action is required.</p>
    </div>
</body>
</html>
