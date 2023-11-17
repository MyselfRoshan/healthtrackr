<?php

require_view('user/stay-hydrated.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module' src='/resources/js/stay-hydrated.js'",
        "src='/resources/js/nepali-datepicker.min.js'"
    ]
]);
