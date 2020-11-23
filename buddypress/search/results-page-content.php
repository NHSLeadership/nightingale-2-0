<?php
/**
 * the template file to display content search result page
 * instead create a folder 'buddyboss-global-search' inside your theme, copy this file over there, and make changes there
 */

//$no_results_class = ! BP_Search::instance()->has_search_results() ?  'bp-search-no-results' : '';

$post_title = BP_Search::instance()->has_search_results() ?
	sprintf( __( 'Showing results for \'%s\'', 'nightingale'), $_GET['s'] ):
	sprintf( __( 'No results for \'%s\'', 'nightingale'), $_GET['s'] ) ;
?>

<div class="bp-search-page buddypress-wrap">

	<header class="search-results-header">
		<h1 class="entry-title"><?php echo $post_title; ?></h1>
	</header>

	<div class="bp-search-results-wrapper dir-form <?php echo ( isset( $no_results_class ) ) ? $no_results_class : ''; ?>">

		<nav class="search_filters item-list-tabs bp-navs dir-navs bp-subnavs no-ajax flex-1" role="navigation">
			<ul class="component-navigation search-nav">
				<?php bp_search_filters();?>
			</ul>
		</nav>
		<div class="search_results">
			<?php bp_search_results();?>
		</div>

	</div>

</div><!-- .bp-search-page -->
