<?php
/**
 * AJR Starter Theme — theme setup.
 *
 * Deliberately small. On an FSE build the theme's job is templates, parts, patterns and
 * theme.json; anything that must survive a theme change — post types, schema, redirects,
 * image sizes, analytics — belongs in the core plugin, not here.
 *
 * @package AJR\StarterTheme
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

/*
 * Version is DERIVED from style.css, never typed.
 *
 * A typed constant matches on the day it is written and drifts silently afterwards. One live
 * build shipped three releases of stale cached assets that way: the header said one version, the
 * constant said an older one, and every browser kept the old CSS because the query string
 * never changed. get_file_data() reads the header once per request.
 */
$ajr_starter_theme_meta = get_file_data(
	get_template_directory() . '/style.css',
	[ 'Version' => 'Version' ]
);
define( 'AJR_STARTER_THEME_VERSION', '' !== $ajr_starter_theme_meta['Version'] ? $ajr_starter_theme_meta['Version'] : '0.0.0' );
unset( $ajr_starter_theme_meta );

/**
 * Theme supports.
 *
 * Most FSE features are declared in theme.json; these are the ones that still require PHP.
 */
add_action(
	'after_setup_theme',
	static function (): void {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );

		/*
		 * ⛔ NO theme-supports contract with the core plugin is declared here, deliberately.
		 *
		 * The theme/plugin decoupling contract is real and belongs here the moment the
		 * plugin has a feature that should behave differently on a theme that supports it.
		 * It does not yet. A declared contract nobody consumes is an artefact whose
		 * presence gets mistaken for its working — the most repeated failure across builds
		 * — and the deploy gate flags it for that reason.
		 *
		 * When a gated feature exists: declare the support here, and check for it in the
		 * plugin. Both halves in the same commit, never just the declaration.
		 */

		load_theme_textdomain( 'ajr-starter-theme', get_template_directory() . '/languages' );
	}
);

/**
 * Front-end styles.
 *
 * One small stylesheet, versioned from the theme header so a deploy busts the cache
 * automatically.
 */
add_action(
	'wp_enqueue_scripts',
	static function (): void {
		$css = get_template_directory() . '/assets/css/app.css';

		if ( ! is_readable( $css ) ) {
			return;
		}

		wp_enqueue_style(
			'ajr-starter-theme',
			get_template_directory_uri() . '/assets/css/app.css',
			[],
			AJR_STARTER_THEME_VERSION
		);
	}
);

/**
 * Editor styles, so the editor renders what the front end renders.
 *
 * Rule 4 — editor parity. A client editing a page in a canvas that does not match the site
 * is being asked to design blind, and every mismatch becomes a support question.
 */
add_action(
	'after_setup_theme',
	static function (): void {
		if ( is_readable( get_template_directory() . '/assets/css/app.css' ) ) {
			add_editor_style( 'assets/css/app.css' );
		}
	}
);

/**
 * Register the theme's pattern categories.
 *
 * Categories are what make a 40-pattern library usable in the inserter. Without them every
 * pattern lands in "Uncategorized" and the client scrolls.
 */
add_action(
	'init',
	static function (): void {
		$categories = [
			'ajr-page'    => __( 'Page sections', 'ajr-starter-theme' ),
			'ajr-hero'    => __( 'Heroes', 'ajr-starter-theme' ),
			'ajr-cta'     => __( 'Calls to action', 'ajr-starter-theme' ),
			'ajr-content' => __( 'Content layouts', 'ajr-starter-theme' ),
		];

		foreach ( $categories as $slug => $label ) {
			register_block_pattern_category( $slug, [ 'label' => $label ] );
		}
	}
);

/*
 * ⛔ NO BLOCK REGISTRATION HERE, AND NO CUSTOM BLOCKS IN THIS THEME.
 *
 * Custom blocks live in the core plugin so they survive a theme change — a block registered
 * by a theme takes every page that used it down with the theme, and the client is left with
 * "this block is not supported" where their content used to be.
 *
 * Rule 3 also applies: core blocks first, and a new custom block needs an explicit decision.
 * A validation error in the editor means OUR markup is wrong, not that core is inadequate.
 */
