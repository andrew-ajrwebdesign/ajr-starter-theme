<?php
/**
 * Title: Post list
 * Slug: ajr-starter-theme/blog-list
 * Categories: ajr-page
 * Inserter: no
 *
 * The inheriting query loop used by every archive-shaped template.
 *
 * ⛔ THIS EXISTS BECAUSE IT WAS DUPLICATED THREE TIMES. The identical 18 lines of query,
 * post-template, pagination and no-results markup were pasted verbatim into
 * templates/index.html, templates/archive.html and templates/search.html. That is exactly
 * the drift Rule 9 names: "more templates than patterns means pages are composed bespoke,
 * and they WILL drift." Three copies means a change to the card layout has to be made three
 * times and will eventually be made twice.
 *
 * `{"inherit":true}` is what makes one file serve all three — the main query already knows
 * whether it is a date archive, a taxonomy archive or a search, so the loop does not need to.
 * ⛔ Never set queryId to a fixed non-zero value here; an inheriting query must stay 0 or it
 * stops following the main query and every archive silently shows the same posts.
 *
 * ⛔ EACH CARD IS `.ajr-card`, AND THAT CLASS IS LOAD-BEARING. `assets/css/app.css` implements
 * the whole-box clickable card — a stretched `::after` on the title link, plus `:hover`,
 * `:focus-within`, a lift and a reduced-motion fallback — under a comment stating the standing
 * rule that a card with ONE destination is clickable across its whole box. Until 2026-08-24
 * **nothing in the theme emitted `ajr-card`**: the selector matched no element anywhere, so
 * every blog card was clickable on eight words of heading and nowhere else, on a theme whose
 * own stylesheet said otherwise. Dead CSS asserting a rule it does not enforce is worse than
 * no CSS, because the next reader believes it. The wrapper is `tagName: article` because each
 * card *is* a post (Rule 15b), and carries `metadata.name` so the client sees "Post card".
 *
 * ⚠️ No `perPage` — deliberate. An inheriting query is sized by Settings → Reading, which is
 * where a client expects to change it. Setting it here would silently override their setting
 * on some archives and not others. preflight reports the `query cap` check as `--` for this
 * pattern for that reason; that is correct, not an omission to "fix".
 *
 * `Inserter: no` — this is template furniture. A client dropping an inheriting query into the
 * middle of a page gets a loop that behaves differently on every URL, which is unexplainable.
 *
 * @package AJR\StarterTheme
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:query {"queryId":0,"query":{"inherit":true},"metadata":{"name":"Post list"},"tagName":"section","align":"wide","layout":{"type":"default"}} -->
<section class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:group {"tagName":"article","className":"ajr-card","metadata":{"name":"Post card"},"layout":{"type":"constrained"}} -->
<article class="wp-block-group ajr-card"><!-- wp:post-title {"isLink":true,"level":2,"fontSize":"large"} /-->

<!-- wp:post-excerpt /--></article>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Nothing found.', 'ajr-starter-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></section>
<!-- /wp:query -->
