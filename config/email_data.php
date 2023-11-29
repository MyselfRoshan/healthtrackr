<?php

$EMAIL = [
    'water' => [
        'subject' => "Stay Hydrated: It's Time to Drink Water!",
        'body' => <<<Body
    <style>
        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #3498db;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #fff;
        }

        .content {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        p {
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            margin-bottom: 15px;
        }

        li {
            margin-left: 20px;
        }

        .signature {
            margin-top: 20px;
            color: #777;
        }
    </style>
    <div class="header" style="background-color: #3498db; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Stay Hydrated: It's Time to Drink Water!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>We hope you're having a great day! 😊 Just a friendly reminder to stay hydrated by drinking enough water. Proper hydration is essential for your health and well-being.</p>

        <p>Here are a few benefits of staying hydrated:</p>
        <ul>
            <li>Helps maintain overall health</li>
            <li>Supports digestion</li>
            <li>Boosts energy levels</li>
            <li>Enhances skin health</li>
        </ul>

        <p>Take a break now and grab a refreshing glass of water. Your body will thank you!</p>

        <p class="signature">Cheers,<br>
        Health Trackr Team</p>
    </div>
    Body,
    ], 'exercise' => [
        'subject' => "Get Moving: It's Time for Your Daily Exercise!",
        'body' => <<<Body
    <style>
        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #2ecc71;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #fff;
        }

        .content {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        p {
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            margin-bottom: 15px;
        }

        li {
            margin-left: 20px;
        }

        .signature {
            margin-top: 20px;
            color: #777;
        }
    </style>
    <div class="header" style="background-color: #2ecc71; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Get Moving: It's Time for Your Daily Exercise!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>We hope you're doing well! 😊 It's time to prioritize your health and well-being by engaging in some daily exercise. Regular physical activity has numerous benefits for your body and mind.</p>

        <p>Benefits of daily exercise include:</p>
        <ul>
            <li>Improves cardiovascular health</li>
            <li>Boosts mood and reduces stress</li>
            <li>Enhances muscle strength and flexibility</li>
            <li>Supports weight management</li>
        </ul>

        <p>Take a break from your routine and incorporate some exercise today. Your body will thank you for it!</p>

        <p class="signature">Stay active,<br>
        Health Trackr Team</p>
    </div>
    Body,
    ], 'sleep' => [
        'subject' => "Good Night: Prioritize Quality Sleep for a Better Tomorrow!",
        'body' => <<<Body
    <style>
        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #9b59b6;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #fff;
        }

        .content {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        p {
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            margin-bottom: 15px;
        }

        li {
            margin-left: 20px;
        }

        .signature {
            margin-top: 20px;
            color: #777;
        }
    </style>
    <div class="header" style="background-color: #9b59b6; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Good Night: Prioritize Quality Sleep for a Better Tomorrow!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>We hope you had a wonderful day! 😴 It's crucial to prioritize quality sleep for overall health and well-being. Adequate sleep contributes to better mood, cognitive function, and physical health.</p>

        <p>Benefits of quality sleep:</p>
        <ul>
            <li>Enhances mood and reduces stress</li>
            <li>Supports cognitive function and memory</li>
            <li>Boosts immune system</li>
            <li>Promotes overall well-being</li>
        </ul>

        <p>Create a peaceful bedtime routine and ensure you get the rest you deserve. Sweet dreams!</p>

        <p class="signature">Sleep well,<br>
        Health Trackr Team</p>
    </div>
    Body,
    ], 'password_reset' => [
        'subject' => "Click Here to Reset Your Password",
        'body' => <<<HTMLBody
    <p>Hello there,</p>
    <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
    <p>If you did request a password reset, please click the link below to reset your password:</p>

    <p>
        <a href="{$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">Reset Password</a>
    </p>

    <p>If the above link doesn't work, you can copy and paste the following URL into your browser:</p>

    <p> {$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}</p>

    <p>This link will expire in 1 hour for security reasons.</p>

    <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

    <p>Best regards,<br>Health Trackr Team</p>
    HTMLBody,
        'text_body' => <<<TEXTBODY
    Hello there,

    We received a request to reset your password. If you didn't make this request, you can ignore this email.

    If you did request a password reset, please copy and paste the following URL into your browser:

    {$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}

    This link will expire in 1 hour for security reasons.

    If you have any questions or need further assistance, please don't hesitate to contact us.

    Best regards,
    Health Trackr Team
    TEXTBODY
    ]
];
