<?php
/**
 * Title: Navigation
 * Slug: ajr-starter-theme/nav
 * Categories: ajr-page
 * Inserter: no
 *
 * ⛔ THE MENU IS A VERSIONED PATTERN, NEVER A DATABASE MENU.
 *
 * Standing rule (2026-08-17): every FSE menu is a pattern file emitting core navigation
 * blocks, tracked in git. Not a wp_navigation post, not a custom nav block.
 *
 * Why it matters: a navigation stored in the database is invisible to version control, does
 * not travel with a deploy, and cannot be diffed or reverted. A menu that differs between
 * staging and live is then impossible to explain, and the fix is always "someone edited it
 * in wp-admin" — which nobody can prove or undo. As a file it is reviewable, deployable and
 * revertable like any other code.
 *
 * `Inserter: no` because this is site furniture referenced by parts/header.html, not
 * something a client should drop into the middle of a page.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:navigation {"metadata":{"name":"Primary navigation"},"overlayMenu":"mobile","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"}} -->
	<!-- wp:page-list /-->
<!-- /wp:navigation -->
