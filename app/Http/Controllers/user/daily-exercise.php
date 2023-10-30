<?php


require_view('user/daily-exercise.view.php', [
    'scripts' => [
        "defer type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "defer nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "defer src='/resources/js/dashboardSidebar.js'",
        "defer src='/resources/js/daily-exercise.js'",
        "defer src='/resources/js/nepali-datepicker.min.js'",
    ]
]);
