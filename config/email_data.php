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
    ], 'morning_exercise' => [
        'subject' => "Good Morning: Embrace the Outdoors with Exercise!",
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
    <div class="header" style="background-color: #f39c12; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Good Morning: Embrace the Outdoors with Exercise!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>We hope you're ready to kickstart your day! 😊 In the morning, embrace the outdoors with activities like jogging or playing a round of badminton. Outdoor exercises are a great way to invigorate your body and mind.</p>

        <p>Benefits of morning outdoor exercise:</p>
        <ul>
            <li>Boosts energy and mood</li>
            <li>Enhances cardiovascular health</li>
            <li>Improves focus and productivity</li>
        </ul>

        <p>Get out there, enjoy the fresh air, and make the most of your morning!</p>

        <p class="signature">Stay active,<br>
        Health Trackr Team</p>
    </div>
    Body,
    ],

    'night_exercise' => [
        'subject' => "Good Night: Unwind with Relaxing Evening Exercises!",
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
    <div class="header" style="background-color: #3498db; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Good Night: Unwind with Relaxing Evening Exercises!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>As the day winds down, it's time to unwind with some gentle indoor exercises. Consider activities like yoga to relax your body and calm your mind. Evening exercises can help you transition into a peaceful night's sleep.</p>

        <p>Benefits of evening indoor exercise:</p>
        <ul>
            <li>Promotes relaxation and stress relief</li>
            <li>Improves flexibility and balance</li>
            <li>Supports a restful night's sleep</li>
        </ul>

        <p>Create a serene environment, find a comfortable spot, and let your evening exercise routine guide you towards a peaceful night.</p>

        <p class="signature">Sleep well,<br>
        Health Trackr Team</p>
    </div>
    Body,
    ],
    'sleep_time' => [
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
    ], 'wakeup_time' => [
        'subject' => "Good Morning: Rise and Shine for a New Day!",
        'body' => <<<Body
    <style>
        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f39c12;
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
    <div class="header" style="background-color: #f39c12; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Good Morning: Rise and Shine for a New Day!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>Wake up and embrace the possibilities of a brand new day! 😊 A positive morning routine sets the tone for the hours ahead.</p>

        <p>Benefits of a morning wakeup routine:</p>
        <ul>
            <li>Boosts mood and positivity</li>
            <li>Enhances productivity and focus</li>
            <li>Provides a sense of accomplishment</li>
        </ul>

        <p>Take a moment to appreciate the morning, indulge in activities you enjoy, and set your intentions for the day. It's a fresh start!</p>

        <p class="signature">Rise and shine,<br>
        Health Trackr Team</p>
    </div>
    Body
    ]
];
