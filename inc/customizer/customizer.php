<?php
/**
 * Bigwigs Theme Customizer
 * 
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 *
 * @package bigwigs
 */

/**
 *
 * Adds custom controls
 *
 */
require_once get_parent_theme_file_path( '/inc/customizer/controls/slider.php' );
// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
require_once get_parent_theme_file_path( '/inc/customizer/controls/toggle-switch.php' );
// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

function bigwigs_customize_register( $wp_customize ) {

	// Add postMessage support for site title and description for the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// Add description to Background default option for the Theme Customizer.
	$wp_customize->get_control( 'background_color' )->description = esc_html( 'Please note: in the current version of the theme, the design only provides for a light color scheme, where dark is the main color and light is the background color.', 'bigwigs' );

	// refresh customizer support
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.navbar-brand',
			'render_callback' => 'bigwigs_customize_partial_blogname',
		) );
	}

	// Toggle Switch Hide Site Title
	$wp_customize->add_setting( 'site_title_hide',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'site_title_hide',
		array(
			'label' => __( 'Hide Site Title', 'bigwigs' ),
			'description' => esc_html__( 'Show or hide the site title on the menu bar.', 'bigwigs' ),
			'section' => 'title_tagline',
			'priority' => 20
		)
	) );

	/**
	 *
	 * Add settings to Colors section
	 *
	 */
	$theme_colors = array();

	$theme_colors[] = array(
		'slug'=>'site_title_color', 
		'default' => '#212529',
		'label' => esc_html__('Site Title Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'main_color', 
		'default' => '#212529',
		'label' => esc_html__('Body Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'content_color', 
		'default' => '#212529',
		'label' => esc_html__('Content Color', 'bigwigs'),
		'transport' => 'refresh'
	);
	$theme_colors[] = array(
		'slug'=>'header_bgcolor', 
		'default' => '#e9ecef',
		'label' => esc_html__('Header Background Color', 'bigwigs'),
		'description' => esc_html__('It is recommended to use only light colors.','bigwigs'),
		'transport' => 'postMessage',
		'active_callback' => 'bigwigs_is_overlay_header'
	);
	$theme_colors[] = array(
		'slug'=>'title_color', 
		'default' => '#212529',
		'label' => esc_html__('Post/Page Titles Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'entry_bgcolor', 
		'default' => '#ffffff',
		'label' => esc_html__('Entry Card Background', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'entry_footer_bgcolor', 
		'default' => '#ffffff',
		'label' => esc_html__('Entry Card: Footer Background', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'wgt_title_color', 
		'default' => '#212529',
		'label' => esc_html__('Widget Title Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'link_color', 
		'default' => '#2b31f9',
		'label' => esc_html__('Text Link Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'link_hover_color', 
		'default' => '#060cd2',
		'label' => esc_html__('Text Link Hover Color', 'bigwigs'),
		'transport' => 'refresh'
	);

	if ( has_nav_menu( 'social' ) ) :

		$theme_colors[] = array(
			'slug'=>'social_link_bgcolor', 
			'default' => '#2c2c2c',
			'label' => esc_html__('Social Links BG-Color', 'bigwigs'),
			'transport' => 'refresh'
		);
		$theme_colors[] = array(
			'slug'=>'social_link_color', 
			'default' => '#ffffff',
			'label' => esc_html__('Social Icons Color', 'bigwigs'),
			'transport' => 'refresh'
		);
		$theme_colors[] = array(
			'slug'=>'social_link_bgcolor_hover', 
			'default' => '#ffffff',
			'label' => esc_html__('Social Links BG-Color: Hover', 'bigwigs'),
			'transport' => 'refresh'
		);
		$theme_colors[] = array(
			'slug'=>'social_link_color_hover', 
			'default' => '#2c2c2c',
			'label' => esc_html__('Social Icons Color: Hover', 'bigwigs'),
			'transport' => 'refresh'
		);

	endif;

	$theme_colors[] = array(
		'slug'=>'meta_color', 
		'default' => '#212529',
		'label' => esc_html__('Body Text Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'		=>'primary_btn_color', 
		'default' 	=> '#212529',
		'label' 	=> esc_html__('Primary Button Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'		=>'primary_btn_hover_color', 
		'default' 	=> '#000000',
		'label' 	=> esc_html__('Primary Button: Hover Color', 'bigwigs'),
		'transport' => 'refresh'
	);
	$theme_colors[] = array(
		'slug'		=>'primary_btn_active_color', 
		'default' 	=> '#000000',
		'label' 	=> esc_html__('Primary Button: Active Color', 'bigwigs'),
		'transport' => 'refresh'
	);
	if( has_nav_menu( 'footer' ) || has_nav_menu( 'social' ) ) {
		$theme_colors[] = array(
			'slug'		=>'pre_footer_bgcolor', 
			'default' 	=> '#e9ecef',
			'label' 	=> esc_html__('Pre-Footer Background', 'bigwigs'),
			'transport' => 'postMessage'
		);
		$theme_colors[] = array(
			'slug'		=>'pre_footer_color', 
			'default' 	=> '#212529',
			'label' 	=> esc_html__('Pre-Footer Menu Color', 'bigwigs'),
			'transport' => 'postMessage'
		);
	}
	$theme_colors[] = array(
		'slug'		=>'footer_bgcolor', 
		'default' 	=> '#101010',
		'label' 	=> esc_html__('Footer Background', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'		=>'footer_color', 
		'default' 	=> '#a6a6a6',
		'label' 	=> esc_html__('Footer Text Color', 'bigwigs'),
		'transport' => 'postMessage'
	);

	foreach( $theme_colors as $color ) {
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' 			=> $color['default'],
				'type' 				=> 'theme_mod', // 'option'
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport' 		=> $color['transport']
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label' 	=> $color['label'],
					'description' 	=> $color['description'],
					'section' 	=> 'colors',
					'settings' 	=> $color['slug']
				)
			)
		);
	}


	/**
	 *
	 * Add Section
	 *
	 */
	$wp_customize->add_section(
		'general_options',
		array(
			'title'       => __( 'Theme Options', 'bigwigs' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 160,
		)
	);

	$wp_customize->add_setting(
		'sidebar_position',
		array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_sidebar_position',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sidebar_position',
			array(
				'label'             => __( 'Sidebar Displays', 'bigwigs' ),
				'section'           => 'general_options',
				'settings'          => 'sidebar_position',
				'type'              => 'select',
				'choices'           => array(
										'right' => __( 'Right sidebar', 'bigwigs' ),
										'left'  => __( 'Left sidebar', 'bigwigs' ),
										'none'  => __( 'No sidebar', 'bigwigs' ),
										),
				'priority'          => '15',
			)
		)
	);

	$wp_customize->add_setting(
		'single_header_display',
		array(
			'default'           => 'standard',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_header_display',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'single_header_display',
			array(
				'label'             => __( 'Page Header', 'bigwigs' ),
				'description'   => __( 'This applies when displaying the title of a single post or page. Note please: If you choose a Cover style then the size of post thumbnails should be at least 1200x860.', 'bigwigs' ),
				'section'           => 'general_options',
				'type'              => 'select',
				'choices'           => array(
										'standard' => __( 'Separately', 'bigwigs' ),
										'alt'  => __( 'Cover', 'bigwigs' )
										),
				'priority'          => '18',
			)
		)
	);

	/**
	 *
	 * Add Section
	 *
	 */
	$wp_customize->add_section(
		'menu_bar_options',
		array(
			'title'       => __( 'Navigation Bar', 'bigwigs' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 165,
		)
	);

	/**
	 *
	 * Settings
	 *
	 */

	// Color options
	$theme_colors = array();

	$theme_colors[] = array(
		'slug'=>'menu_color', 
		'default' => '#2c2c2c',
		'label' => esc_html__('Menu Color', 'bigwigs'),
		'transport' => 'postMessage'
	);
	$theme_colors[] = array(
		'slug'=>'menu_hover_color', 
		'default' => '#000',
		'label' => esc_html__('Menu Color: Hover', 'bigwigs'),
		'transport' => 'refresh'
	);

	foreach( $theme_colors as $color ) {
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' 			=> $color['default'],
				'type' 				=> 'theme_mod', // 'option'
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport' 		=> $color['transport']
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label' 	=> $color['label'], 
					'section' 	=> 'menu_bar_options',
					'settings' 	=> $color['slug']
				)
			)
		);
	}
	// END Colors Options

	$wp_customize->add_setting(
		'menubar_mode',
		array(
			'default'           => 'standard',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_menubar_mode',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'menubar_mode',
			array(
				'label'             => __( 'Alignment', 'bigwigs' ),
				'section'           => 'menu_bar_options',
				'settings'          => 'menubar_mode',
				'type'              => 'select',
				'choices'           => array(
										'standard' 	=> __( 'Right-aligned', 'bigwigs' ),
										'alt'  		=> __( 'Left-aligned', 'bigwigs' ),
										),
				'priority'          => '10',
			)
		)
	);


	// Toggle Switch Search icon
	$wp_customize->add_setting( 'show_search_menu_item',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'show_search_menu_item',
		array(
			'label' => __( 'Search button', 'bigwigs' ),
			'description' => esc_html__( 'Show the search button on the menu bar.', 'bigwigs' ),
			'section' => 'menu_bar_options'
		)
	) );

	// Toggle Switch Cart icon
	$wp_customize->add_setting( 'show_cart_menu_item',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'show_cart_menu_item',
		array(
			'label' => __( 'Cart button', 'bigwigs' ),
			'description' => esc_html__( 'Show the cart button on the menu bar.', 'bigwigs' ),
			'section' => 'menu_bar_options'
		)
	) );

	/**
	 *
	 * Posts Page
	 *
	 */
	$wp_customize->add_section(
		'blog_options',
		array(
			'title'       => __( 'Posts Page', 'bigwigs' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 170,
		)
	);

	// Toggle Switch Show Date
	$wp_customize->add_setting( 'hide_posted_on',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_posted_on',
		array(
			'label' => __( 'Hide Date', 'bigwigs' ),
			'section' => 'blog_options'
		)
	) );

	// Toggle Switch Show Author
	$wp_customize->add_setting( 'hide_posted_by',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_posted_by',
		array(
			'label' => __( 'Hide Author', 'bigwigs' ),
			'section' => 'blog_options'
		)
	) );

	$wp_customize->add_setting(
		'blog_pagination_mode',
		array(
			'default'           => 'standard',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_blog_pagination_mode',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'blog_pagination_mode',
			array(
				'label'             => __( 'Pages navigation type', 'bigwigs' ),
				'section'           => 'blog_options',
				'settings'          => 'blog_pagination_mode',
				'type'              => 'select',
				'choices'           => array(
										'standard' 	=> __( 'Standard', 'bigwigs' ),
										'numeric'  	=> __( 'Numeric', 'bigwigs' )
										),
				'priority'          => '20',
			)
		)
	);

    $wp_customize->add_setting(
    	'more_link',
    	array(
	        'default' 			=> '',
	        'sanitize_callback' => 'sanitize_text_field',
    	) 
    );

    $wp_customize->add_control(
    	new WP_Customize_Control(
    		$wp_customize,
    		'more_link',
    		array(
		        'label' 		=> __( 'Link to full post', 'bigwigs' ),
		        'description'   => __( 'Enter the button label which is a link to the full post. You can leave this blank if you want to hide the button.', 'bigwigs' ),
		        'section'   	=> 'blog_options',
		        'type' 			=> 'text'
    		)
    	)
    );

	// Post List helper function.
	function bigwigs_post_list( $args = array() ) {
		$args = wp_parse_args( $args, array('numberposts' => '-1') );
		$posts = get_posts( $args );
		$output = array();
		$output[''] = __( '&mdash; Select Post &mdash;', 'bigwigs' );
		foreach( $posts as $post ) {
			$thetitle = $post->post_title;
            $getlength = strlen($thetitle);
            $thelength = 32;

            $thetitle = substr($thetitle, 0, $thelength);
                if ($getlength > $thelength){
                    $thetitle .= '...';
                };
			$output[$post->ID] = sprintf('%s', esc_html($thetitle) );
		}
		return $output;
	}

    $wp_customize->add_setting(
    	'post_dropdown_setting',
    	array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'absint', // $output[$post->ID]
			'capability'        => 'edit_theme_options',
    	)
    );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_dropdown_setting',
			array(
				'label'             => __( 'Featured Post', 'bigwigs' ),
				'section'           => 'blog_options',
				'settings'          => 'post_dropdown_setting',
				'type'              => 'select',
				'choices'           => bigwigs_post_list(),
				'priority'          => '10',
			)
		)
	);

    $wp_customize->add_setting(
    	'blog_layout',
    	array(
			'default'           => 'standard',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_blog_layout',
			'capability'        => 'edit_theme_options',
    	)
    );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'blog_layout',
			array(
				'label'             => __( 'Layout mode', 'bigwigs' ),
				'section'           => 'blog_options',
				'settings'          => 'blog_layout',
				'type'              => 'select',
				'choices'           => array('standard' => esc_html__( 'Standard', 'bigwigs' ),'grid' => esc_html__( 'Grid', 'bigwigs' )),
				'priority'          => '15'
			)
		)
	);

    $wp_customize->add_setting(
    	'blog_grid',
    	array(
			'default'           => '3cols',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_blog_grid',
			'capability'        => 'edit_theme_options'

    	)
    );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'blog_grid',
			array(
				'label'     		=> __( 'Number of Columns', 'bigwigs' ),
				'section'   		=> 'blog_options',
				'type'      		=> 'select',
				'choices'   		=> array(
										'2cols' => esc_html__( '2 columns', 'bigwigs' ),
										'3cols' => esc_html__( '3 columns', 'bigwigs' )
									),
				'priority'  		=> '15'
			)
		)
	);

	/**
	 *
	 * Single Post Section
	 *
	 */
	$wp_customize->add_section(
		'single_options',
		array(
			'title'       => __( 'Single Post', 'bigwigs' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 170,
		)
	);


	// Toggle Switch Show Date
	$wp_customize->add_setting( 'hide_single_posted_on',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_single_posted_on',
		array(
			'label' => __( 'Hide Date', 'bigwigs' ),
			'section' => 'single_options'
		)
	) );

	// Toggle Switch Show Author
	$wp_customize->add_setting( 'hide_single_posted_by',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_single_posted_by',
		array(
			'label' => __( 'Hide Author', 'bigwigs' ),
			'section' => 'single_options'
		)
	) );

	// Toggle Switch Category meta
	$wp_customize->add_setting( 'hide_single_posted_in',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_single_posted_in',
		array(
			'label' => __( 'Hide categories', 'bigwigs' ),
			'section' => 'single_options'
		)
	) );

	// Toggle Switch Category meta
	$wp_customize->add_setting( 'hide_single_tagged',
		array(
			'default' => false,
			'transport' => 'refresh',
			'sanitize_callback' => 'bigwigs_switch_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Toggle_Switch_Custom_control( $wp_customize, 'hide_single_tagged',
		array(
			'label' => __( 'Hide tags', 'bigwigs' ),
			'section' => 'single_options'
		)
	) );

	/**
	 *
	 * Add Panel - Front Page Sections
	 *
	 */
	$wp_customize->add_panel(
		'frontpage_options',
		array(
		  'title' 			=> __( 'Homepage Sections', 'bigwigs' ),
		  'description'   => __( 'Get the Pro version to add 5 more sortable and customizable sections like this: widget area, full-width parallax section, recent blog posts, and more.', 'bigwigs' ),
		  'priority' 		=> 190,
		  'active_callback' => 'bigwigs_set_front_page',
		) 
	);

	/**
	 *
	 * Add Section Head Banner to Panel
	 *
	 */
	$wp_customize->add_section(
		'frontpage_banner',
		array(
		    'title'     => __( 'Head Banner', 'bigwigs' ),
		    'panel' 	=> 'frontpage_options',
		    'priority'  => 20,
		) 
	);

	// Setting
    $wp_customize->add_setting(
    	'banner_title',
    	array(
	        'default' 			=> '',
	        'sanitize_callback' => 'sanitize_text_field',
    	) 
    );

    $wp_customize->add_control(
    	new WP_Customize_Control(
    		$wp_customize,
    		'banner_title',
    		array(
		        'label' 	=> __( 'Heading', 'bigwigs' ),
		        'section'   => 'frontpage_banner',
		        'settings'  => 'banner_title',
		        'type' 		=> 'text'
    		)
    	)
    );

	// Setting
    $wp_customize->add_setting(
    	'banner_subtitle',
    	array(
	        'default' 			=> '',
	        'sanitize_callback' => 'sanitize_text_field',
    	) 
    );

    $wp_customize->add_control(
    	new WP_Customize_Control(
    		$wp_customize,
    		'banner_subtitle',
    		array(
		        'label' 	=> __( 'Sub-Heading', 'bigwigs' ),
		        'section'   => 'frontpage_banner',
		        'settings'  => 'banner_subtitle',
		        'type' 		=> 'text'
    		)
    	)
    );

	// Setting
    $wp_customize->add_setting(
    	'banner_button_label',
    	array(
	        'default' 			=> '',
	        'sanitize_callback' => 'sanitize_text_field',
    	) 
    );

    $wp_customize->add_control(
    	new WP_Customize_Control(
    		$wp_customize,
    		'banner_button_label',
    		array(
		        'label' 	=> __( 'Button Label', 'bigwigs' ),
		        'section'   => 'frontpage_banner',
		        'settings'  => 'banner_button_label',
		        'type' 		=> 'text'
    		)
    	)
    );

    $wp_customize->add_setting(
    	'banner_button_link',
    	array(
	        'default' 			=> '',
	        'sanitize_callback' => 'esc_url',
    	) 
    );

    $wp_customize->add_control(
    	new WP_Customize_Control(
    		$wp_customize,
    		'banner_button_link',
    		array(
		        'label' 	=> __( 'Button Link', 'bigwigs' ),
		        'section'   => 'frontpage_banner',
		        'settings'  => 'banner_button_link',
		        'type' 		=> 'text'
    		)
    	)
    );

    // Setting
	$wp_customize->add_setting(
		'banner_bg_color',
		array(
			'default'           => '#FFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'banner_bg_color',
			array(
				'label'   => esc_html__( 'Background Color', 'bigwigs' ),
				'section' => 'frontpage_banner',
			)
		)
	);

    // Setting
    $wp_customize->add_setting(
    	'banner_bg_image',
    	array(
		    'type' 				=> 'theme_mod',
		    'sanitize_callback' => 'absint'
		)
    );

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'banner_bg_image',
			array(
			    'section' 		=> 'frontpage_banner',
			    'label' 		=> __( 'Background Image', 'bigwigs' ),
			    'width' 		=> 1900,
			    'height' 		=> 1080
			)
		)
	);

	$wp_customize->add_setting( 'head_banner_height',
		array(
			'default' => 50,
			'transport' => 'postMessage',
			'sanitize_callback' => 'bigwigs_range_sanitization'
		)
	);
	$wp_customize->add_control( new Bigwigs_Slider_Custom_Control( $wp_customize, 'head_banner_height',
		array(
			'label' => __( 'Head Banner Height', 'bigwigs' ),
			'section' => 'frontpage_banner',
			'input_attrs' => array(
				'min' => 50,
				'max' => 100,
				'step' => 1,
			),
		)
	) );

	/**
	 *
	 * Add Section - Portfolio
	 *
	 */
	$wp_customize->add_section(
		'portfolio_options',
		array(
			'title'       		=> __( 'Portfolio Settings', 'bigwigs' ),
			'capability'  		=> 'edit_theme_options',
			'priority'    		=> 195,
			'active_callback' 	=> 'bigwigs_portfolio_enabled'
		)
	);

    $wp_customize->add_setting(
    	'portfolio_grid',
    	array(
			'default'           => '3cols',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'bigwigs_sanitize_portfolio_grid',
			'capability'        => 'edit_theme_options'

    	)
    );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'portfolio_grid',
			array(
				'label'     		=> __( 'Number of Columns', 'bigwigs' ),
				'section'   		=> 'portfolio_options',
				'type'      		=> 'select',
				'choices'   		=> array(
										'2cols' => esc_html__( '2 columns', 'bigwigs' ),
										'3cols' => esc_html__( '3 columns', 'bigwigs' )
									),
				'priority'  		=> '15'
			)
		)
	);


// END Options

}
add_action( 'customize_register', 'bigwigs_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bigwigs_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Sorter sanitization
 *
 * @return input	Sanitized input or default
 */
function bigwigs_sanitize_sorter( $input, $setting ) {
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	$input_keys = $input;

	foreach ( $input_keys as $key => $value ) {
		if ( ! array_key_exists( $value, $choices ) ) {
			unset( $input[ $key ] );
		}
	}

	// If the input is a valid key, return it;
	// otherwise, return the default.
	return ( is_array( $input ) ? $input : $setting->default );
}

/**
 * Sanitize the menu bar layout options.
 *
 * @param string $input Menu bar layout.
 */
function bigwigs_sanitize_menubar_mode( $input ) {
	$valid = array(
				'standard' 	=> __( 'Standard', 'bigwigs' ),
				'alt'  		=> __( 'Alternative', 'bigwigs' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the sidebar position options.
 *
 * @param string $input Sidebar position options.
 */
function bigwigs_sanitize_sidebar_position( $input ) {
	$valid = array(
				'right' => __( 'Right sidebar', 'bigwigs' ),
				'left'  => __( 'Left sidebar', 'bigwigs' ),
				'none'  => __( 'No sidebar', 'bigwigs' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the single header display options.
 *
 * @param string $input Sidebar position options.
 */
function bigwigs_sanitize_header_display( $input ) {
	$valid = array(
				'standard' => __( 'Standard', 'bigwigs' ),
				'alt'  => __( 'Alternative', 'bigwigs' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the navigation mode options.
 *
 * @param string $input navigation mode options.
 */
function bigwigs_sanitize_blog_pagination_mode( $input ) {
	$valid = array(
				'standard' 	=> __( 'Standard', 'bigwigs' ),
				'numeric'  	=> __( 'Numeric', 'bigwigs' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/*
 * Sanitize the blog layout options.
 *
 * @param string $input blog layout options.
 */
function bigwigs_sanitize_blog_layout( $input ) {
	$valid = array(
				'grid' 		=> esc_html__( 'Grid', 'bigwigs' ),
				'standard' 	=> esc_html__( 'Standard', 'bigwigs' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/*
 * Sanitize the post grid options.
 *
 * @param string $input blog layout options.
 */
function bigwigs_sanitize_blog_grid( $input ) {
	$valid = array(
				'2cols' => esc_html__( '2 columns', 'bigwigs' ),
				'3cols' => esc_html__( '3 columns', 'bigwigs' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/*
 * Sanitize the portfolio columns options.
 *
 * @param string $input portfolio columns options.
 */
function bigwigs_sanitize_portfolio_grid( $input ) {
	$valid = array(
				'2cols' => esc_html__( '2 columns', 'bigwigs' ),
				'3cols' => esc_html__( '3 columns', 'bigwigs' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function bigwigs_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Switch sanitization
 *
 * @param  string		Switch value
 * @return integer	Sanitized value
 */
if ( ! function_exists( 'bigwigs_switch_sanitization' ) ) {
	function bigwigs_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

/**
 * Helper function 
 * that only allow values between a certain minimum & maxmium range
 *
 * @param  number	Input to be sanitized
 * @return number	Sanitized input
 */
function bigwigs_in_range( $input, $min, $max ){
	if ( $input < $min ) {
		$input = $min;
	}
	if ( $input > $max ) {
		$input = $max;
	}
	return $input;
}

/**
 * Slider sanitization
 *
 * @param  string	Slider value to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'bigwigs_range_sanitization' ) ) {
	function bigwigs_range_sanitization( $input, $setting ) {
		$attrs = $setting->manager->get_control( $setting->id )->input_attrs;

		$min = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
		$max = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
		$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );

		$number = floor( $input / $attrs['step'] ) * $attrs['step'];

		return bigwigs_in_range( $number, $min, $max );
	}
}

/**
 *
 * Helper function for Contextual Control
 * Whether the static page is set to a front displays
 * https://developer.wordpress.org/reference/classes/wp_customize_control/active_callback/
 */
function bigwigs_set_front_page(){
	if( 'page' == get_option('show_on_front') ){
		return true;
	}
}

/**
 *
 * Helper function for Contextual Control
 * Checks the activation of the Portfolio Post Type plugin
 * https://developer.wordpress.org/reference/classes/wp_customize_control/active_callback/
 */
function bigwigs_portfolio_enabled(){
	if( class_exists( 'Portfolio_Post_Type' ) ){
		return true;
	}
}

/**
 *
 * Helper function for Contextual Control
 * Check whether overlay mode is set for the page headers
 * https://developer.wordpress.org/reference/classes/wp_customize_control/active_callback/
 *
 */
function bigwigs_is_overlay_header(){
	if( get_theme_mod('single_header_display') == 'alt' ){
		return true;
	} else {
		return false;
	}	
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bigwigs_customize_preview_js() {
	wp_enqueue_script( 'bigwigs-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), rand(), true );
}
add_action( 'customize_preview_init', 'bigwigs_customize_preview_js' );

/**
 * Live contextual controls for better user experience.
 */
function bigwigs_customizer_contextual_control() {
    wp_enqueue_script( 
    	'bigwigs-customizer-contextual', 
    	get_template_directory_uri() . '/inc/customizer/assets/js/contextual.js?v=' . rand(), 
    	array( 'customize-controls' ), 
    	false 
    );
}
add_action( 'customize_controls_enqueue_scripts', 'bigwigs_customizer_contextual_control' );

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 * 
 * @link https://codex.wordpress.org/Theme_Customization_API#Sample_Theme_Customization_Class
 * 
 * @uses get_theme_mod()
 * @param string $selector CSS selector
 * @param string $style The name of the CSS *property* to modify
 * @param string $mod_name The name of the 'theme_mod' option to fetch
 * @param string $prefix Optional. Anything that needs to be output before the CSS property
 * @param string $postfix Optional. Anything that needs to be output after the CSS property
 * @param bool $echo Optional. Whether to print directly to the page (default: true).
 * @return string Returns a single line of CSS with selectors and a property.
 */
function bigwigs_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
    $mod = esc_html( get_theme_mod( $mod_name ) );
    if ( ! empty( $mod ) ) {
		$return = sprintf('%s { %s:%s; }',
        			$selector,
        			$style,
        			$prefix.$mod.$postfix
    				);
        if ( $echo ) {
          echo $return; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
    return $return;
}


/**
 * Output generated a line of CSS from customizer values in header output.
 * 
 * @link https://codex.wordpress.org/Theme_Customization_API#Sample_Theme_Customization_Class
 * 
 * Used by hook: 'wp_head'
 * 
 * @see add_action('wp_head',$func)
 */
function bigwigs_customizer_css() {
?>
	<!--Customizer CSS--> 
	<style type="text/css">
    	<?php
    		bigwigs_generate_css('.jumbotron.hero', 'background-color', 'header_bgcolor');
    		bigwigs_generate_css('.front-page .jumbotron.hero', 'background-color', 'banner_bg_color');
    		bigwigs_generate_css('.front-page .jumbotron', 'height', 'head_banner_height','', 'vh');
    		bigwigs_generate_css('.navbar', 'background-color', 'menu_bar_bgcolor');
    		bigwigs_generate_css('.navbar .navbar-nav .nav-link,.navbar-light .dropdown-toggle::after', 'color', 'menu_color');
    		bigwigs_generate_css('.navbar .navbar-nav .nav-link:hover,.navbar-nav .show > .nav-link,.navbar-nav .active > .nav-link,.navbar-nav .nav-link.show,.navbar-nav .nav-link.active', 'color', 'menu_hover_color');
    		bigwigs_generate_css('.navbar-light .navbar-brand, .navbar-light .navbar-brand a', 'color', 'site_title_color');

    		bigwigs_generate_css('body', 'color', 'main_color');
    		bigwigs_generate_css('.entry-content', 'color', 'content_color');

    		bigwigs_generate_css('.navbar-brand, .navbar-brand a', 'color', 'site_title_color');


    		bigwigs_generate_css('.entry-title, .entry-title a, .page-title', 'color', 'title_color');
    		bigwigs_generate_css('a,.entry-content dl a, .entry-content li a, .entry-content p a, .entry-content table a', 'color', 'link_color');
    		bigwigs_generate_css('a:hover,.entry-content dl a:hover, .entry-content li a:hover, .entry-content p a:hover, .entry-content table a:hover', 'color', 'link_hover_color');

    		bigwigs_generate_css('.social-navigation a', 'background-color', 'social_link_bgcolor');
			bigwigs_generate_css('.social-navigation a', 'fill', 'social_link_color');
    		bigwigs_generate_css('.social-navigation a:hover,.social-navigation a:focus', 'background-color', 'social_link_bgcolor_hover');
			bigwigs_generate_css('.social-navigation a:hover,.social-navigation a:focus', 'fill', 'social_link_color_hover');

    		bigwigs_generate_css('.entry-footer, .entry-meta', 'color', 'meta_color');
    		bigwigs_generate_css('.post .card-body', 'background-color', 'entry_bgcolor');
    		bigwigs_generate_css('.post .card-footer', 'background-color', 'entry_footer_bgcolor');
    		bigwigs_generate_css('.widget-title', 'color', 'wgt_title_color');
    		bigwigs_generate_css('.btn-primary', 'background-color', 'primary_btn_color');
    		bigwigs_generate_css('.btn-primary', 'border-color', 'primary_btn_color');
    		bigwigs_generate_css('.btn-primary:hover', 'background-color', 'primary_btn_hover_color');
    		bigwigs_generate_css('.btn-primary:hover', 'border-color', 'primary_btn_hover_color');
    		bigwigs_generate_css('.btn-primary:not(:disabled):not(.disabled):active, 
									.btn-primary:not(:disabled):not(.disabled).active,
									.show > .btn-primary.dropdown-toggle',
									'border-color', 'primary_btn_active_color');
    		bigwigs_generate_css('.btn-primary:not(:disabled):not(.disabled):active, 
									.btn-primary:not(:disabled):not(.disabled).active,
									.show > .btn-primary.dropdown-toggle',
									'background-color', 'primary_btn_active_color');
    		bigwigs_generate_css('.pre-footer', 'background-color', 'pre_footer_bgcolor');
    		bigwigs_generate_css('.pre-footer, .footer-menu a', 'color', 'pre_footer_color');
    		bigwigs_generate_css('.site-footer', 'background-color', 'footer_bgcolor');
    		bigwigs_generate_css('.site-footer, .site-footer a, .site-footer .widget-title', 'color', 'footer_color');

    		// adding when is has a condition
			if ( get_theme_mod( 'hide_posted_on' ) == true 
				&& get_theme_mod( 'hide_posted_by' ) == true ) {
				echo '.blog .entry-meta, .archive .entry-meta { display: none; }';
			} else {
				if ( get_theme_mod( 'hide_posted_on' ) == true ) {
					echo '.blog .posted-on, .archive .posted-on { display: none; }';
				}
				if ( get_theme_mod( 'hide_posted_by' ) == true ) {
					echo '.blog .byline, .archive .byline { display: none; }';
				}
			}

			if ( get_theme_mod( 'hide_single_posted_on' ) == true ) {
				echo '.single-post .posted-on { display: none; }';
			}
			if ( get_theme_mod( 'hide_single_posted_by' ) == true ) {
				echo '.single-post .byline { display: none; }';
			}
			?>
	</style>
<?php
}
add_action( 'wp_head', 'bigwigs_customizer_css');