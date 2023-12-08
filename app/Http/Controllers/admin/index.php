<?php

use Database\Database;

$query = "SELECT
  COUNT(*) AS total_users,
  COUNT(CASE WHEN is_admin = false THEN 1 END) AS normal_users,
  COUNT(CASE WHEN is_admin = true THEN 1 END) AS admin_users
FROM
  users;";
$count = Database::select($query)->fetch();
require_view('admin/index.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/dashboardSidebar.js'",
        // "src='/resources/js/jquery.min.js'",
        // "src='https://cdn.jsdelivr.net/npm/apexcharts'",
        // "type='module' src='/resources/js/apex-chart.js'",
        // "src='/resources/js/nepali-datepicker.min.js'",
    ],
    'count' => $count
]);
