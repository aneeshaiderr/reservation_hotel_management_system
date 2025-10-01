<?php
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="container mt-4">
    <h2>Welcome <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></h2>

    <p>This is your personal dashboard.</p>

    <a href="<?= BASE_URL ?>/details?id=<?= $user['id'] ?>" class="btn btn-primary">View Profile</a>
</div>


