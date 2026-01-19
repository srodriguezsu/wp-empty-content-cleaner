# Empty Posts & Pages Cleaner

A small WordPress admin tool that lists published posts and pages which have empty content (and/or empty title) and allows selective deletion.

## Features
- Lists published posts and pages with empty content.
- "Select all" checkbox to quickly select all visible items.
- Post/page titles link to the public view (opens in a new tab) for quick inspection.
- Bulk deletion of selected items (permanently deletes posts).
- Nonce and capability checks to limit access to administrators.

## Requirements
- WordPress 4.7+ (uses standard WP admin actions/functions)
- PHP 7.0+ recommended

## Installation
1. Place the `wp-empty-content-cleaner` folder in your WordPress `wp-content/plugins/` directory.
2. Activate the plugin from the WordPress admin Plugins screen.

## Usage
1. In the WordPress admin, go to Tools → Empty Content Cleaner.
2. The plugin displays a table of published posts/pages that have empty content.
3. Use the checkboxes to select individual items, or click the "Select all" checkbox in the table header to toggle all items.
4. Click a post title to open the public view in a new tab to inspect it.
5. Use the "Delete selected" button to permanently delete the selected posts/pages.

Notes:
- Deletions are permanent (the plugin calls wp_delete_post with the $force_delete flag). Use with caution.
- Only users with the `manage_options` capability can access and perform deletions.

## Security & Hardening
- Action is protected by a WordPress nonce and capability checks.
- Input IDs are sanitized before deletion.
- Links to posts use `esc_url()` and output is escaped in the admin UI.

## Changelog
- 1.0.4 — Added "Select all" checkbox, post/page view links, and improved delete handling/sanitization.
- 1.0.0 — Initial release.
