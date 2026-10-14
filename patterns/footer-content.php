<?php
/**
 * Title: Footer content
 * Slug: ajr-starter-theme/footer-content
 * Categories: ajr-page
 * Inserter: no
 *
 * Referenced by parts/footer.html. Kept as a pattern rather than inline markup so the
 * footer can be edited without touching a template part — parts are developer surface,
 * patterns are the client's.
 *
 * ⛔ The copyright year is rendered by PHP, not typed. A hardcoded year is wrong on
 * 1 January and nobody notices until a client does.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;

$ajr_starter_theme_copyright = sprintf(
	/* translators: 1: current year, 2: site name */
	__( '© %1$s %2$s. All rights reserved.', 'ajr-starter-theme' ),
	gmdate( 'Y' ),
	get_bloginfo( 'name' )
);
?>
<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $ajr_starter_theme_copyright ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:navigation {"metadata":{"name":"Footer navigation"},"overlayMenu":"never","fontSize":"small","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"}} -->
	<!-- wp:page-list /-->
<!-- /wp:navigation --></div>
<!-- /wp:group -->
