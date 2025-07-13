<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Approved & Payment Information</title>
    <style>
        /* Basic styling for email clients */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #4A90E2; /* A professional blue color */
            color: #ffffff;
            padding: 40px;
            text-align: center;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px 40px;
            color: #333333;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 22px;
            color: #333;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #4A90E2;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
        }
        .cta-button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background-color: #28a745; /* A positive green color */
            color: #ffffff !important;
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .footer {
            background-color: #333333;
            color: #dddddd;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .footer a {
            color: #4A90E2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.imgur.com/gY92p2a.png" alt="Alphainno Logo">
            <h1>Congratulations!</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $details['name'] }},</h2>
            <p>
                We are delighted to inform you that your application for admission to <strong>Alphainno</strong> has been successfully approved! Welcome to our family.
            </p>

            <div class="info-box">
                {{-- <strong>Application ID:</strong> {{ $details['application_id'] }}<br> --}}
                <strong>Next Step:</strong> Complete your payment and create your student account.
            </div>

            <p>
                To finalize your admission, please complete the payment process and create your student account through our secure portal. This is the final step to confirm your place.
            </p>

            <a href="{{ $details['link'] }}" class="cta-button">Complete Your Admission & Pay Now</a>

            <p>
                If you have any questions or face any issues, please do not hesitate to contact our admission office at <a href="mailto:admission@yourschool.com">admission@yourschool.com</a>.
            </p>

            <p>We look forward to welcoming you on campus!</p>

            <p>
                Best regards,<br>
                <strong>The Admission Team</strong><br>
                <em>Alphainno</em>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Alphainno. All Rights Reserved.</p>
            <p>123 Education Street, Khulna, Bangladesh</p>
        </div>
    </div>
</body>
</html>