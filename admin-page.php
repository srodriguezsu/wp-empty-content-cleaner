<?php
function ecc_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $empty_posts = ecc_get_empty_posts();
    ?>

    <div class="wrap">
        <h1>Empty Posts & Pages</h1>

        <?php if (empty($empty_posts)): ?>
            <p>No empty posts or pages found 🎉</p>
        <?php else: ?>
            <form method="post">
                <?php wp_nonce_field('ecc_delete_nonce'); ?>

                <table class="widefat fixed striped">
                    <thead>
                    <tr>
                        <th width="30"></th>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($empty_posts as $post): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="delete_ids[]" value="<?= esc_attr($post->ID) ?>">
                            </td>
                            <td><?= esc_html($post->ID) ?></td>
                            <td><?= esc_html($post->post_type) ?></td>
                            <td><?= esc_html($post->post_date) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <p>
                    <input type="submit" name="ecc_delete" class="button button-primary" value="Delete selected">
                </p>
            </form>
        <?php endif; ?>
    </div>

    <?php
}

