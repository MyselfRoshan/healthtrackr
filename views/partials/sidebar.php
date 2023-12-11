<?php

if (!isset($attributes[0])) $attributes[0] = '';
?>
<div class="dashboard-wrapper">
    <div class="dashboard__menu-list bg-primary-800 d-flex" role="menu">
        <div class="menu-toggle" role="switch">
            <div class="menu-item__icon">
                <ion-icon name="menu"></ion-icon>
            </div>
        </div>

        <a href="/<?= $_SESSION['user']['username'] ?>" class="menu-item <?php echo $attributes[0] === 'd' ? 'active' : '' ?> ">
            <div class="menu-item__icon">
                <ion-icon name="grid<?php echo $attributes[0] === 'd' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Dashboard</span>
        </a>

        <a href="/<?= $_SESSION['user']['username'] ?>/add" class="menu-item <?php echo $attributes[0] === 'a' ? 'active' : '' ?>">
            <div class="menu-item__icon">
                <ion-icon name="add<?php echo $attributes[0] === 'a' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Add</span>
        </a>

        <a href="/<?= $_SESSION['user']['username'] ?>/reminder" class="menu-item <?php echo $attributes[0] === 'r' ? 'active' : '' ?>">
            <div class="menu-item__icon">
                <ion-icon name="calendar-clear<?php echo $attributes[0] === 'r' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Reminder</span>
        </a>
        <!--
        <a href="/<?= $_SESSION['user']['username'] ?>/goal" class="menu-item <?php echo $attributes[0] === 'g' ? 'active' : '' ?>">
            <div class="menu-item__icon">
                <ion-icon name="flag<?php echo $attributes[0] === 'g' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Goal</span>
        </a> -->
        <div class="profile">

            <!-- <a href="/<?= $_SESSION['user']['username'] ?>/profile" class="profile__pic"> -->
            <a href="/profile" class="profile__pic">
                <img src=<?= $_SESSION['profile_pic'] ?? "/resources/images/default-profile.png" ?> alt="Profile picture" />
            </a>
            <div class="profile__desc d-flex">
                <span class="profile__username text-accent fs-200 fw-700" hidden>

                    <?= $_SESSION['user']['username'] ?>

                </span>
                <span class="profile__role fs-200" hidden>

                    <?= $_SESSION['user']['email'] ?>

                </span>
            </div>

        </div>
        <form action="/logout" method="POST" class="menu-item">
            <input type="hidden" name="_request_method" value="DELETE">
            <button class="profile__logout">
                <ion-icon name="log-out-outline" class="fs-600"></ion-icon>
                <span class="ms-3 text-accent">Logout</span>
            </button>
        </form>
    </div>
</div>