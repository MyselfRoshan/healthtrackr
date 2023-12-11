<?php

require_view('admin/user/add.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/nepali-datepicker.min.js'",
        "type='module' src='/resources/js/profile.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "src='/resources/js/user-add.js'",
    ],
    'user' => [],
    'alerts' => []
]);
