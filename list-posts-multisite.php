<?php
/**
 * List Posts Multisite Plugin
 *
 * @package List Posts Multisite
 *
 * Plugin Name: List Posts Multisite
 * Description: Easily list links to posts from any site across your multisite network.
 * Version:     1.0.0
 * Author:      Dmitry Mayorov
 * Author URI:  https://themepatio.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Shortcode for displaying list of posts across the network.
 *
 * @param array $atts Array of attributes.
 */
function lpm_list_posts( $atts ) {
	// Get attributes. Set defaults.
	$atts = shortcode_atts( array(
		'blog_id'        => 1,
		'cat'            => 1,
		'order'          => 'DESC',
		'post__not_in'   => '',
		'posts_per_page' => 99,
		'class'          => '',
	), $atts );

	// Proceed only if the blog ID is set and is numeric.
	if ( is_numeric( $atts['blog_id'] ) ) {

		// Switch to another blog in the network.
		switch_to_blog( absint( $atts['blog_id'] ) );

		// Setup the Query.
		$post_list = new WP_Query( array(
			'post_status'    => 'publish',
			'cat'            => $atts['cat'],
			'posts_per_page' => $atts['posts_per_page'],
			'order'          => $atts['order'],
			'post__not_in'   => explode( ',', $atts['post__not_in'] ),
			'no_found_rows'  => true, // See http://bit.ly/2dqU8jJ for details.
		) );

		// Check if we have posts.
		if ( $post_list->have_posts() ) :

			// Array that holds post objects for panels.
			$html = sprintf( '<ul class="%s">', esc_attr( $atts['class'] ) );

			// Run the loop.
			while ( $post_list->have_posts() ) : $post_list->the_post();
				$html .= sprintf( '<li><a href="%1$s" target="_blank">%2$s</a></li>', esc_url( get_permalink() ), esc_html( get_the_title() ) );
			endwhile;

			$html .= '</ul>';

			// Reset the post data.
			wp_reset_postdata();

			// Switch back to the current site.
			restore_current_blog();

			return $html;

		endif;

	} else {
		return '<!--Incorrect Blog ID!-->';
	}
}
add_shortcode( 'lpm_list_posts', 'lpm_list_posts' );
