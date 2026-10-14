<?php
/**
 * Title: Single post body
 * Slug: ajr-starter-theme/blog-single
 * Categories: ajr-page
 * Inserter: no
 *
 * The body of a single post: title, date, featured image, content.
 *
 * ⛔ The wrapper is a group with `"tagName":"article"`, not a div. Rule 15b — a single-entry
 * page renders an <article> landmark, and core group blocks carry tagName, so this costs no
 * extra markup and no CSS. Without it a screen-reader user has nothing to jump to on any
 * single-post page — a real finding on a live client theme in Aug 2026, where four single
 * templates rendered no <article> between them.
 *
 * That instance is fixed: every single template on that theme now emits `"tagName":"article"`.
 *
 * `metadata.name` is set so the client sees "Post" in List View rather than "Group" — Rule
 * 15a: no block in a shipped pattern keeps a default name like "Group".
 *
 * `Inserter: no` — post-context blocks render empty outside the loop, so offering this in
 * the inserter would let a client place a section that is blank on every page they can
 * actually put it on.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"layout":{"type":"constrained"}} -->
<article class="wp-block-group"><!-- wp:post-title {"level":1,"fontSize":"xx-large"} /-->

<!-- wp:post-date {"fontSize":"small","textColor":"contrast-2"} /-->

<!-- wp:post-featured-image {"align":"wide"} /-->

<!-- wp:post-content {"layout":{"type":"constrained"}} /--></article>
<!-- /wp:group -->
