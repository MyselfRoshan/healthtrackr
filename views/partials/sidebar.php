<?php

if(!isset($attributes[0])) $attributes[0]='';
?>
<div class="dashboard__menu-list bg-primary-800 d-flex" role="menu">
    <div class="menu-toggle" role="switch">
        <div class="menu-item__icon">
            <ion-icon name="menu"></ion-icon>
        </div>
        <!-- <div class="logo">
            <img src="../resources/images/logo-only.png" alt="logo" srcset="" />
          </div> -->
    </div>

    <a href="/<?= $_SESSION['user']['username'] ?>" class="menu-item <?php echo $attributes[0]==='d'?'active':''?> ">
        <div class="menu-item__icon">
            <ion-icon name="grid-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Dashboard</span>
    </a>

    <a href="/<?= $_SESSION['user']['username'] ?>/add" class="menu-item <?php echo $attributes[0]==='a'?'active':''?>">
        <div class="menu-item__icon">
            <ion-icon name="add-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Add</span>
    </a>

    <a href="/<?= $_SESSION['user']['username'] ?>/reminder" class="menu-item <?php echo $attributes[0]==='r'?'active':''?>">
        <div class="menu-item__icon">
            <ion-icon name="calendar-clear-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Reminder</span>
    </a>

    <a href="/<?= $_SESSION['user']['username'] ?>/goal" class="menu-item <?php echo $attributes[0]==='g'?'active':''?>">
        <div class="menu-item__icon">
            <ion-icon name="flag-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Goal</span>
    </a>
    <div class="profile">

        <a href="/<?= $_SESSION['user']['username'] ?>/profile" class="profile__pic">
            <img src="/resources/images/default-profile.png" alt="Profile picture" />
        </a>
        <div class="profile__desc d-flex">
            <span class="profile__username text-accent fs-200 fw-700" hidden>

                <?= $_SESSION['user']['username'] ?>

            </span>
            <span class="profile__role fs-200" hidden>

                <?= $_SESSION['user']['email'] ?>

            </span>
        </div>

        <form action="/logout" method="POST">
            <input type="hidden" name="_request_method" value="DELETE">
            <button class="profile__logout">
                <ion-icon name="log-out-outline" hidden></ion-icon>
            </button>
        </form>
    </div>
</div>