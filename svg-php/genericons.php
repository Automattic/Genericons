<?php
global $genericons_inject_sprite;
$genericons_inject_sprite = null;

/**
 * This allows us to get the SVG code and return as a variable
 * Usage: get_genericon( 'name-of-icon' );
 */
function get_genericon( $name, $id = null, $external = true, $title = null ) {
	global $genericons_inject_sprite;

	// Generate an attribute string for the SVG.
	$attr = 'class="genericon genericon-' . $name . '"';

	// If the user has passed a unique ID, output it.
	if ( $id ) :
		$attr .= ' id="' . $id . '"';
	endif;

	if ( ! $title ) : // Use the icon name as the title if the user hasn't set one.
		$title = $name;
	endif;

	if ( 'none' === $title ) : // Specify the icon is presentational.
		$attr .= ' role="presentation"';

	else : // Output a title and role for screen readers.
		$attr .= ' title="' . $title . '"';
		$attr .= ' role="img" aria-labelledby="title"';
	endif;

	// Print the SVG tag.
	$return = '<svg ' . $attr . '>';

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
 function genericon( $name, $id = null, $external = true, $title = null ) {
 	global $genericons_inject_sprite;
	echo get_genericon( $name, $id, $external, $title );
}

/*
 * Implement svg4everybody in order to better support external sprite references
 * on IE8-10. For lower versions, we need an older copy of the script.
 * https://github.com/jonathantneal/svg4everybody
 */
function genericons_scripts() {
	/*
	 * Implement svg4everybody in order to better support external sprite references
	 * on IE8-10. For lower versions, we need an older copy of the script.
	 * https://github.com/jonathantneal/svg4everybody
	 */
	wp_enqueue_script( 'genericons-svg4everybody', get_template_directory_uri() . '/genericons/svg-php/svg4everybody.js', array(), '20160401', false );
}
add_action( 'wp_enqueue_scripts', 'genericons_scripts' );

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
function genericons_footer_injection() {
	global $genericons_inject_sprite;

	if ( $genericons_inject_sprite ) :
		include_once( get_template_directory() .'/genericons/svg-sprite/genericons.svg' );
	endif;

	echo '<script>svg4everybody();</script>';
}
add_filter( 'wp_footer' , 'genericons_footer_injection' );
