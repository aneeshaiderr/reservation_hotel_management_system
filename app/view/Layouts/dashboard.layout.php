<?php

require __DIR__.'/../dashboard/partial/head.php';
require __DIR__.'/../dashboard/partial/nav.php';
require __DIR__.'/../dashboard/partial/sidebar.php';
?>

<main class="d-flex flex-column min-vh-100">
    <?php
        // This variable is dynamically passed by the controller
        if (isset($view)) {
            require BASE_PATH.'app/view/'.$view;
        }
?>

</main>

<?php require __DIR__.'/../dashboard/partial/footer.php'; ?>

