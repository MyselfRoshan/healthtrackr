<?php
$attributes[0] = $attributes[0] ?? '';
?>

<div class="dashboard-wrapper">
    <div class="dashboard__menu-list bg-gradient d-flex" role="menu">
        <div class="menu-toggle" role="switch">
            <div class="menu-item__icon">
                <ion-icon name="menu"></ion-icon>
            </div>
        </div>

        <a href="/admin" class="menu-item <?= $attributes[0] === 'd' ? 'active' : '' ?> ">
            <div class="menu-item__icon">
                <ion-icon name="grid<?= $attributes[0] === 'd' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Dashboard</span>
        </a>

        <a href="/admin/user" class="menu-item <?= $attributes[0] === 'a' ? 'active' : '' ?>">
            <div class="menu-item__icon">
                <ion-icon name="person<?= $attributes[0] === 'a' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>User</span>
        </a>
        <a href="/admin/user/add" class="menu-item <?= $attributes[0] === 'r' ? 'active' : '' ?>">
            <div class="menu-item__icon">
                <ion-icon name="person-add<?= $attributes[0] === 'r' ? '-outline' : '' ?>"></ion-icon>
            </div>
            <span class="menu-item__desc" hidden>Add User</span>
        </a>
        <div class="profile">

            <a href="/profile" class="profile__pic">
                <img src=<?= $_SESSION['profile_pic'] ?? "/resources/images/default-profile.png" ?> alt="Profile picture" />
            </a>
            <div class="profile__desc d-flex">
                <span class="profile__username text-accent fs-200 fw-700" hidden>

                    Administrator

                </span>
                <span class="profile__role fs-200" hidden>

                    <?= $_SESSION['user']['username'] ?>

                </span>
            </div>

        </div>
        <form action="/admin/logout" method="POST" class="menu-item">
            <input type="hidden" name="_request_method" value="DELETE">
            <button class="profile__logout">
                <ion-icon name="log-out-outline" class="fs-600"></ion-icon>
                <span class="ms-3 text-accent">Logout</span>
            </button>
        </form>
    </div>
</div>