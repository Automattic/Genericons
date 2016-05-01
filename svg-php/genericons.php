<?php
global $genericons_inject_sprite;
$genericons_inject_sprite = null;

/**
 * This allows us to get the SVG code and return as a variable
 * Usage: get_genericon( 'name-of-icon' );
 */
function get_genericon( $name, $id = null, $external=true ) {
	global $genericons_inject_sprite;

	$attr = 'class="genericon genericon-' . $name . '"';
	if ( $id ) :
		$attr .= 'id="' . $id . '"';
	endif;
	$return = '<svg '. $attr.'>';

	if ( $external ) : // Default behavior; caches better.
		if ( function_exists( 'wpcom_is_vip' ) ) :
			$path = wpcom_vip_noncdn_uri( get_template_directory() );
		else :
			$path = get_template_directory_uri();
		endif;
		$return .= '<use xlink:href="' . esc_url( $path ) . '/genericons/svg-sprite/genericons.svg#' . $name . '" />';

	else : // Use internal method if specified.
		$return .= '<use xlink:href="#' . $name . '" />';
		$genericons_inject_sprite = true;
	endif;
	$return .= '</svg>';
 return $return;
}

/*
 * Echo out our Genericon with a super-simple function.
 * Usage: genericon( 'name-of-icon' );
 */
function genericon( $name, $id = null ) {
	echo genericon( $name, $id );
}

/*
 * Inject our SVG sprite at the bottom of the page.
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 *
 * This function currently is only used when the user has specified to use the internal
 * method of insertion, by passing the $external parameter to get_genericon above.
 */
function genericons_inject_sprite() {
	global $genericons_inject_sprite;

	if ( $genericons_inject_sprite ) :
		include_once( get_template_directory() .'/genericons/svg-sprite/genericons.svg' );
	endif;
}
add_filter( 'wp_footer' , 'genericons_inject_sprite' );
