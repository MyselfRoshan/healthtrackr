<?php

require_view('user/balanced-nutrition.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/nepali-datepicker.min.js'",
        "type='module' src='/resources/js/sendReminder.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module' src='/resources/js/balanced-nutrition.js'",
    ]
]);
