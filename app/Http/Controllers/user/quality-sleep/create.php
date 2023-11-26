<?php

require_view('user/quality-sleep.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'",
        "src='/resources/js/timepicker.min.js'",
        "src='/resources/js/nepali-datepicker.min.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module' src='/resources/js/quality-sleep.js'",
        "type='module' src='/resources/js/Notification.js'",
        "type='module' src='/resources/js/sendReminder.js'",
    ]
]);
