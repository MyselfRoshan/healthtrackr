<?php

require_view('passwordReset/index.view.php', [
    'token_expired' => isset($token_expired) ?? false,
    'scripts' => [
        'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
        'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
        'src="resources/js/input.js"',
    ]
]);
