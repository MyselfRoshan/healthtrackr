<?php

use App\Helper\Time;
?>

<header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">User's Table</h1>
</header>

<div class="responsive-table mt-10">
    <?php if (empty($users)) : ?>
        <p class="no-data-message">No users found.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th>Last Login</th>
                    <th>Timezone</th>
                    <th>Is Admin</th>
                    <th>Age</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td data-cell="user id"><?= $user['user_id'] ?></td>
                        <td data-cell="name" class="user__fullname d-grid">
                            <img class="user__profile-pic" src="<?= $user['profile_pic'] ?? "/resources/images/default-profile.png" ?>" alt="Profile picture" />
                            <p class="user__name">
                                <?= $user['first_name'] ?> <?= $user['last_name'] ?>
                            </p>
                        </td>
                        <td data-cell="username"><?= $user['username'] ?></td>
                        <td data-cell="email"><?= $user['email'] ?></td>
                        <td data-cell="created on"><?= date('M j, Y g:i a', strtotime($user['created_on'])) ?></td>
                        <td data-cell="last login"><?= Time::ago($user['last_login']) ?></td>
                        <td data-cell="timezone"><?= $user['timezone'] ?></td>
                        <td data-cell="is admin"><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                        <td data-cell="age"><?= $user['age'] !== null && intval($user['age']) !== 0 ? "{$user['age']} years" : '-' ?></td>
                        <td data-cell="height"><?= !floatval($user['height']) ? '-' : toFeetInches($user['height']) ?></td>
                        <td data-cell="weight"><?= !intval($user['weight']) ? '-' : "{$user['weight']} kg" ?></td>
                        <td data-cell="actions">
                            <a href="/admin/user/edit?user_id=<?= $user['user_id'] ?>" class="edit">
                                <!-- Edit -->
                                <ion-icon name="create"></ion-icon>
                            </a>
                            <button class="delete-btn" data-user-id="<?= $user['user_id'] ?>">
                                <ion-icon name="trash-outline"></ion-icon>
                                <!-- Delete -->
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>

    <dialog class="modal">
        <span class="close" id="closeModalBtn">&times;</span>
        <p>Are you sure you want to proceed?</p>
        <div class="button-container d-flex">
            <button class="btn-yes" id="yesBtn">Yes</button>
            <button class="btn-no" id="noBtn">No</button>
        </div>
    </dialog>
</div>
<div class="notification"></div>