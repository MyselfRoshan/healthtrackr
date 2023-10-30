<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="/resources/css/timepicker.css" />
<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
    <div class="dashboard">
        <?php require_view("partials/sidebar.php") ?>
        <div class="dashboard__content">
            <div class="wrapper m-16">
                <?php require_view("partials/add/quality-sleep.php") ?>
            </div>
        </div>
    </div>
</body>

</html>