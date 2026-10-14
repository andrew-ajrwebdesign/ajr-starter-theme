<?php
/**
 * Title: 404 content
 * Slug: ajr-starter-theme/error-404
 * Categories: ajr-page
 * Inserter: no
 *
 * What a visitor sees when the URL does not resolve.
 *
 * ⛔ It offers a search box, not just an apology. A 404 that only says "not found" ends the
 * visit; a 404 that offers a way onward is the difference between a bounce and a session.
 * This is the one page on the site guaranteed to be reached by someone who wanted something.
 *
 * The copy is translatable and lives in the pattern, not the template — a string typed into a
 * template is invisible to translation and to the client. That is **Rule 11** ("copy of any
 * kind → block content, never a string in a template"), not Rule 9, which governs naming and
 * the template/pattern ratio.
 *
 * ⛔ THE SEARCH DELIMITER IS BUILT WITH serialize_block_attributes(), NOT INTERPOLATED.
 *
 * The obvious spelling — `{"label":"<?php echo esc_attr__( 'Search', … ); ?>"}` — is what
 * WordPress's own bundled themes do (twentytwentyfour and twentytwentyfive both use
 * esc_attr_x() in this exact position), and it is safe against injection: esc_attr escapes
 * `"`, `<` and `>`, so a translation cannot break out of the string or end the comment.
 *
 * It is NOT safe against a backslash. esc_attr leaves `\` untouched and `\"` is a valid JSON
 * escape, so a msgstr ending in a backslash makes the attribute JSON unparseable. WP's parser
 * calls json_decode() with no error handling, the attributes become null, and EVERY attribute
 * on the block is dropped — the search box silently renders core's English defaults, in that
 * locale only, with no error and no log. A silent locale-specific failure is exactly the class
 * this estate hunts, and serialize_block_attributes() closes it for three lines: it
 * JSON-encodes and additionally escapes `--`, `<`, `>` and `&`. preflight's own
 * `block serializer` check names it as the correct tool, and fails any build that reaches for
 * wp_json_encode instead, which escapes none of those.
 *
 * ⛔ NO WRAPPER GROUP, DELIBERATELY. The three blocks sit directly in the template's `<main>`,
 * which is already `layout: constrained` — exactly as they did before this extraction. An
 * earlier draft wrapped them in a group "for a band name", which bought nothing visual and
 * cost a real `<div>` plus a core-generated `.wp-container-core-group-is-layout-*` rule on
 * every 404. It was also the only rendered-output regression in the whole extraction. A
 * pattern may have several top-level blocks; it does not need a root.
 *
 * `Inserter: no` — a client inserting "Page not found" into a real page is never what they
 * meant, and it is the kind of mistake that goes unnoticed until a customer reports it.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;

$ajr_search_attrs = serialize_block_attributes(
	array(
		'label'      => __( 'Search', 'ajr-starter-theme' ),
		'buttonText' => __( 'Search', 'ajr-starter-theme' ),
	)
);
?>
<!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size"><?php esc_html_e( 'Page not found', 'ajr-starter-theme' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The page you asked for is not here. It may have moved, or the link may be out of date.', 'ajr-starter-theme' ); ?></p>
<!-- /wp:paragraph -->

<?php echo '<!-- wp:search ' . $ajr_search_attrs . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes. ?>
