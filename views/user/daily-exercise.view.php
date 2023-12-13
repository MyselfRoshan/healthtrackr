<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
    <div class="dashboard">
        <?php require_view("partials/sidebar.php") ?>
        <div class="dashboard__content">
            <div class="daily-exercise wrapper m-16">
                <?php require_view("partials/add/daily-exercise.php") ?>
            </div>
        </div>
    </div>
</body>

</html>