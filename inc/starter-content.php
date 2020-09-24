<?php
/**
 * BigWigs Starter Content
 * 
 * Based on Twenty Twenty theme starter content
 * @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 * 
 */

/**
 * Function to return the array of starter content for the theme.
 *
 * Passes it through the `bigwigs_starter_content` filter before returning.
 *
 * @return array a filtered array of args for the starter_content.
 */
function bigwigs_get_starter_content() {

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		// Create the custom image attachment
		'attachments' => array(
			'image-opening' => array(
				'post_title' => __( 'BigWigs', 'bigwigs' ),
				'file'       => 'images/lion.jpg',
			),
		),
		// Specify the core-defined pages
		'posts'       => array(
			'front' => array(
				'post_type'    => 'page',
				'post_title'   => __( 'Front', 'bigwigs' )
			),
			'about'=> array(
				'post_type'    => 'page',
				//'template' => 'template-wide.php',
				'post_title'   => __( 'About', 'bigwigs' ),
				// Use the above featured image with the predefined about page.
				//'thumbnail'    => '{{image-opening}}',
				'post_content' => __( 'Bigwigs is a generic theme which is suitable for pretty much any type of website, including business sites, portfolios, blogs and e-stores. WooCommerce Compatible. Portfolio Support.', 'bigwigs' ),
			),
			'blog'=> array(
				'post_type'    => 'page',
				'post_title'   => __( 'Blog Page', 'bigwigs' )
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page', // 'blog'
			'page_on_front'  => '{{front}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the Header Banner section theme mods
		'theme_mods'  => array(
			'banner_title' => __( 'BigWigs', 'bigwigs' ),
			'banner_subtitle' => __( 'Your homepage displays a static page. Customizer > Homepage Sections > Head Banner', 'bigwigs' ),
			'banner_button_label' => __( 'Button', 'bigwigs' ),
			'banner_button_link'=> esc_url('#'),
			'banner_bg_image' => '{{image-opening}}',
			'head_banner_height' => '100',
			'single_header_display' => 'alt'
		),

		// Set up nav menu and assign to the "primary" location.
		'nav_menus'   => array(
			'primary'  => array(
				'name'  => __( 'Primary', 'bigwigs' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog'
				),
			)
		),
	);

	/**
	 * Filters theme array of starter content.
	 *
	 * @param array $starter_content Array of starter content.
	 */
	return apply_filters( 'bigwigs_starter_content', $starter_content );

}
