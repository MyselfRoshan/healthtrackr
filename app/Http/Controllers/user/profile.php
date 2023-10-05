<?php

require_view('dashboard/profile.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/input.js'",
        "src='/resources/js/profile.js'",
        "src='/resources/js/dashboardSidebar.js'"
    ]
]);
