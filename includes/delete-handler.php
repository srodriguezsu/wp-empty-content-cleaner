<?php
add_action('admin_init', function () {
    if (!isset($_POST['ecc_delete'], $_POST['delete_ids'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    check_admin_referer('ecc_delete_nonce');

    foreach ($_POST['delete_ids'] as $id) {
        wp_delete_post((int)$id, true);
    }

    wp_redirect(admin_url('tools.php?page=empty-content-cleaner'));
    exit;
});

