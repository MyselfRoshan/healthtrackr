<header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center mb-10">Admin Dashboard</h1>
</header>
<div class="dashboard__container d-grid">
    <div class="dashboard__metric">
        <p class="title fs-500 fw-700 text-secondary">Normal Users</p>
        <div class="body fs-500 fw-700 text-center text-secondary">
            <?= $count['normal_users'] ?>
        </div>
    </div>
    <div class="dashboard__metric">
        <p class="title fs-500 fw-700 text-secondary">Admin Users</p>
        <div class="body fs-500 fw-700 text-center text-secondary">
            <?= $count['admin_users'] ?>
        </div>
    </div>
</div>
<!-- <div class="notification"></div> -->