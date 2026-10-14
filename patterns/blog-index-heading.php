<?php
/**
 * Title: Posts index heading
 * Slug: ajr-starter-theme/blog-index-heading
 * Categories: ajr-page
 * Inserter: no
 *
 * The h1 for the posts index — the one string the Rule 9 extraction left behind.
 *
 * ⛔ IT WAS HARDCODED ENGLISH IN A .html TEMPLATE, WHICH FAILS TWICE.
 *
 * 1. Block templates are `.html` and are NOT scanned by gettext, so `<h1>Latest</h1>` typed
 *    into templates/index.html was untranslatable by construction — the same silent Rule 8
 *    failure that makes a bilingual build ship an English string nobody can find. The 404
 *    copy moved into PHP in this same pass; this string was left behind in the format the
 *    pass existed to fix.
 * 2. It overrode the client's own page title. With a static front page, index.html serves
 *    the Posts page. A client who names that page "News & Insights" got `<h1>Latest</h1>`,
 *    disagreeing with their title tag and their menu label, and could not change it without
 *    a developer — Rule 11, copy belongs to the client.
 *
 * ⛔ `wp:query-title` is NOT the fix here, and preflight has a check that exists to say so:
 * an `archive`-type query-title calls `render_block_core_query_title()`, which returns ''
 * when `'archive' === $type && ! is_archive()`. The posts page is `is_home()`, not
 * `is_archive()`, so it would render ZERO h1 on exactly the page this serves.
 *
 * So the title is read from the Posts page itself, with a translatable fallback for the
 * common case where no static posts page is set.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;

$ajr_posts_page_id = (int) get_option( 'page_for_posts' );
$ajr_index_heading = $ajr_posts_page_id > 0
	? get_the_title( $ajr_posts_page_id )
	: __( 'Latest', 'ajr-starter-theme' );
?>
<!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html( $ajr_index_heading ); ?></h1>
<!-- /wp:heading -->
