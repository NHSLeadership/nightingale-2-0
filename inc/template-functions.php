<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function nightingale_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$classes[] = nightingale_get_header_style();

	return $classes;
}

add_filter( 'body_class', 'nightingale_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nightingale_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'nightingale_pingback_header' );

if ( ! function_exists( 'nightingale_get_header_style' ) ) {
	/**
	 * Figure whether we are using standard blue header with white text, or an inverse header which is white with blue / grey text.
	 *
	 * @return string $default_position.
	 */
	function nightingale_get_header_style() {

		$themeoptions_header_style = esc_attr( get_theme_mod( 'theme-header-style', 'default' ) );

		if ( 'default' === $themeoptions_header_style ) {
			$default_position = 'page-header-default';
		} elseif ( 'centered' === $themeoptions_header_style ) {
			$default_position = 'page-header-white';
		}

		return $default_position;
	}
}

// remove "type" from script and style tags - not needed for html 5 validation.
add_filter( 'script_loader_tag', 'nightingale__remove_type', 10, 3 );
add_filter( 'style_loader_tag', 'nightingale__remove_type', 10, 3 );  // Ignore the $media argument to allow for a common function.

/**
 * Clean Header Output for W3C compliance
 *
 * @param string $markup The original text.
 * @param string $handle What are we looking for.
 * @param string $href What is the link to it.
 *
 * @return mixed
 */
function nightingale__remove_type( $markup, $handle, $href ) {

	// Remove the 'type' attribute.
	$markup = str_replace( " type='text/javascript'", '', $markup );
	$markup = str_replace( " type='text/css'", '', $markup );

	return $markup;
}

// Store and process wp_head output to operate on inline scripts and styles.
add_action( 'wp_head', 'nightingale__wp_head_ob_start', 0 );

/**
 * Start outputting the Head
 */
function nightingale__wp_head_ob_start() {
	ob_start();
}

add_action( 'wp_head', 'nightingale__wp_head_ob_end', 10000 );

/**
 * Clean up the head output HTML to be W3C compliant.
 */
function nightingale__wp_head_ob_end() {
	$wp_head_markup = ob_get_contents();
	ob_end_clean();

	// Remove the 'type' attribute. Note the use of single and double quotes.
	$wp_head_markup = str_replace( " type='text/javascript'", '', $wp_head_markup );
	$wp_head_markup = str_replace( ' type="text/javascript"', '', $wp_head_markup );
	$wp_head_markup = str_replace( ' type="text/css"', '', $wp_head_markup );
	$wp_head_markup = str_replace( " type='text/css'", '', $wp_head_markup );
	echo $wp_head_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

// end remove "type" from script and style tags.

/**
 * Customise the read more link
 */
function nightingale_read_more() {
	$post_id = get_the_ID();

	return '<div class="nhsuk-action-link">
  <a class="nhsuk-action-link__link" href="' . get_permalink() . '"><svg class="nhsuk-icon nhsuk-icon__arrow-right-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
	  <path d="M0 0h24v24H0z" fill="none"></path>
	  <path d="M12 2a10 10 0 0 0-9.95 9h11.64L9.74 7.05a1 1 0 0 1 1.41-1.41l5.66 5.65a1 1 0 0 1 0 1.42l-5.66 5.65a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41L13.69 13H2.05A10 10 0 1 0 12 2z"></path>
	</svg><span class="nhsuk-action-link__text">read more</span><span class="nhsuk-u-visually-hidden"> about ' . get_the_title() . '</span></a></div>';
}


add_filter( 'excerpt_more', 'nightingale_read_more', 10, 1 );

/**
 * Customise the read more link.
 *
 * @param string $title The title for the link (used in visually hidden area for screen readers to better describe the link).
 * @param string $link The href of the resource being linked to.
 *
 * return string output html.
 */
function nightingale_read_more_posts( $title, $link ) {

	return '<div class="nhsuk-action-link">
  <a class="nhsuk-action-link__link" href="' . $link . '"><svg class="nhsuk-icon nhsuk-icon__arrow-right-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
	  <path d="M0 0h24v24H0z" fill="none"></path>
	  <path d="M12 2a10 10 0 0 0-9.95 9h11.64L9.74 7.05a1 1 0 0 1 1.41-1.41l5.66 5.65a1 1 0 0 1 0 1.42l-5.66 5.65a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41L13.69 13H2.05A10 10 0 1 0 12 2z"></path>
	</svg><span class="nhsuk-action-link__text">read more</span><span class="nhsuk-u-visually-hidden"> about ' . $title . '</span></a></div>';

}

/**
 * Add Google Analytics directly into the theme customiser for brevity and simplicity. This really shouldn't need a plugin.
 */
function nightingale_add_google_analytics() {
	$tag = get_theme_mod( 'google-utm' );
	echo '<script>
		  (function(a,b,c){var d=a.history,e=document,f=navigator||{},g=localStorage,
		  h=encodeURIComponent,i=d.pushState,k=function(){return Math.random().toString(36)},
		  l=function(){return g.cid||(g.cid=k()),g.cid},m=function(r){var s=[];for(var t in r)
		  r.hasOwnProperty(t)&&void 0!==r[t]&&s.push(h(t)+"="+h(r[t]));return s.join("&")},
		  n=function(r,s,t,u,v,w,x){var z="https://www.google-analytics.com/collect",
		  A=m({v:"1",ds:"web",aip:c.anonymizeIp?1:void 0,tid:b,cid:l(),t:r||"pageview",
		  sd:c.colorDepth&&screen.colorDepth?screen.colorDepth+"-bits":void 0,dr:e.referrer||
		  void 0,dt:e.title,dl:e.location.origin+e.location.pathname+e.location.search,ul:c.language?
		  (f.language||"").toLowerCase():void 0,de:c.characterSet?e.characterSet:void 0,
		  sr:c.screenSize?(a.screen||{}).width+"x"+(a.screen||{}).height:void 0,vp:c.screenSize&&
		  a.visualViewport?(a.visualViewport||{}).width+"x"+(a.visualViewport||{}).height:void 0,
		  ec:s||void 0,ea:t||void 0,el:u||void 0,ev:v||void 0,exd:w||void 0,exf:"undefined"!=typeof x&&
		  !1==!!x?0:void 0});if(f.sendBeacon)f.sendBeacon(z,A);else{var y=new XMLHttpRequest;
		  y.open("POST",z,!0),y.send(A)}};d.pushState=function(r){return"function"==typeof d.onpushstate&&
		  d.onpushstate({state:r}),setTimeout(n,c.delay||10),i.apply(d,arguments)},n(),
		  a.ma={trackEvent:function o(r,s,t,u){return n("event",r,s,t,u)},
		  trackException:function q(r,s){return n("exception",null,null,null,null,r,s)}}})
		  (window,"' . $tag . '",{anonymizeIp:true,colorDepth:true,characterSet:true,screenSize:true,language:true});
		</script>';
}

if ( get_theme_mod( 'google-utm' ) !== 'UA-' ) {
	add_action( 'wp_footer', 'nightingale_add_google_analytics', 1000 );
}
