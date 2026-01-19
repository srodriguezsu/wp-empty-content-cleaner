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
                        <th width="30">
                            <!-- Select all checkbox -->
                            <input type="checkbox" id="ecc_select_all" aria-label="Select all">
                        </th>
                        <th>ID</th>
                        <th>Title</th>
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
                            <td>
                                <?php
                                // link to the published post/page (open in new tab). show fallback if no title.
                                $view_link = get_permalink($post->ID);
                                $title = trim((string) $post->post_title) !== '' ? $post->post_title : '(no title)';
                                ?>
                                <a href="<?= esc_url($view_link) ?>" target="_blank" rel="noopener noreferrer">
                                    <?= esc_html($title) ?>
                                </a>
                            </td>
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

            <!-- Small inline script to handle "select all" behavior -->
            <script>
                (function () {
                    var selectAll = document.getElementById('ecc_select_all');
                    if (!selectAll) return;
                    selectAll.addEventListener('change', function () {
                        var boxes = document.querySelectorAll('input[name="delete_ids[]"]');
                        for (var i = 0; i < boxes.length; i++) {
                            boxes[i].checked = this.checked;
                        }
                    });
                })();
            </script>

        <?php endif; ?>
    </div>

    <?php
}
