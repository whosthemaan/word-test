<?php
/**
 * Bigwigs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bigwigs
 */

/**
 * Theme Constants
 */
$bigwigs_theme_options  = wp_get_theme();
$bigwigs_theme_version  = $bigwigs_theme_options->get( 'Version' );

define( 'BIGWIGS_DIR', get_template_directory() );
define( 'BIGWIGS_DIR_URI', get_template_directory_uri() );
define( 'BIGWIGS_VERSION', $bigwigs_theme_version );

if ( ! function_exists( 'bigwigs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bigwigs_setup() {
		load_theme_textdomain( 'bigwigs', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		// Custom Image Sizes
		add_image_size( 'bigwigs-thumb-v-200-270', 200, 270, true ); //crop
		add_image_size( 'bigwigs-thumb-v-350-470', 350, 470, true ); //crop
		add_image_size( 'bigwigs-thumb-750-500', 750, 500, true ); //crop
		add_image_size( 'bigwigs-featured-v', 900, 9999 );
		add_image_size( 'bigwigs-featured-900-600', 900, 600, true ); //crop
		add_image_size( 'bigwigs-cover-image', 1200, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'bigwigs' ),
			'footer' 	=> esc_html__( 'Footer Links', 'bigwigs' ),
			'social' 	=> esc_html__( 'Social Links', 'bigwigs' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) 
		);

		/**
		 * Add support for core custom header feature.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-header
		 */
		$defaults = array(
					'default-image'          => '',
					'header-text'            => false,
					'width'                  => 1900,
					'height'                 => 1200,
					'flex-height'            => true,
		);
		add_theme_support( 'custom-header', $defaults );

		/**
		 * Add support for core custom background feature.
		 *
		 * @link https://codex.wordpress.org/Custom_Backgrounds
		 */
		$defaults = array(
					'default-color' => 'ffffff',
					'default-image' => '',
		);
		add_theme_support( 'custom-background', $defaults );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 *
		 * Add support for Block Styles.
		 *
		 */
		//add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Enqueue fonts in the editor.
		add_editor_style( bigwigs_fonts_url() );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'bigwigs' ),
					'size'      => 12,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'bigwigs' ),
					'size'      => 14,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Medium', 'bigwigs' ),
					'size'      => 19,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Display', 'bigwigs' ),
					'size'      => 40,
					'slug'      => 'display',
				)
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/*
		 * Adds starter content on fresh sites only once in the customizer
		 */
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', bigwigs_get_starter_content() );
		}

		/**
		 * Add WooCommerce support
		 */
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

	}
endif;
add_action( 'after_setup_theme', 'bigwigs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bigwigs_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'bigwigs_content_width', 640 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action( 'after_setup_theme', 'bigwigs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bigwigs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bigwigs' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in sidebar.', 'bigwigs' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'bigwigs' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in footer column 1.', 'bigwigs' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'bigwigs' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to appear in footer column 2.', 'bigwigs' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'bigwigs' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to appear in footer column 3.', 'bigwigs' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'bigwigs_widgets_init' );

/**
 * 
 * Register Google fonts.
 * 
 */
function bigwigs_fonts_url() {
	$fonts_url     = '';
	$font_defaults = array( 'Poppins:400,400i,700' );
	$font_families = apply_filters( 'bigwigs_font_families', $font_defaults );
	$subsets       = apply_filters( 'bigwigs_font_subsets', 'latin' );

	if ( $font_families ) {
		$font_families = array_unique( $font_families );
		$query_args    = array(
			  'family' => rawurlencode( implode( '|', $font_families ) ),
			  'subset' => rawurlencode( $subsets )
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function bigwigs_scripts() {

	// Bootstrap theme styles
	wp_enqueue_style( 'bigwigs-bootstrap', get_template_directory_uri() . '/vendors/bootstrap-dist/css/bootstrap-theme.min.css' );

	// Add Dashicons
	wp_enqueue_style( 'dashicons' );

	// Add google fonts
	wp_enqueue_style( 'bigwigs-fonts', bigwigs_fonts_url(), false, wp_get_theme()->get( 'Version' ), 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'bigwigs-style', get_template_directory_uri() . '/style.css', false, wp_get_theme()->get( 'Version' ) );

	// Bootstrap scripts
	wp_enqueue_script('bigwigs-popper', get_template_directory_uri() . '/vendors/bootstrap-dist/js/popper.min.js', array('jquery'), '', true );
	wp_enqueue_script('bigwigs-bootstrap', get_template_directory_uri() . '/vendors/bootstrap-dist/js/bootstrap.min.js', array('jquery'), '', true );

	// Theme scripts
	wp_enqueue_script( 'bigwigs-theme', get_theme_file_uri( '/js/theme.js' ), array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'bigwigs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), wp_get_theme()->get( 'Version' ), true );

	if ( get_theme_mod('show_search_menu_item') == true ) {
		wp_enqueue_script( 'bigwigs-search-modal', get_theme_file_uri( '/js/search-modal.js' ), array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bigwigs_scripts' );

function bigwigs_editor_style() {
	wp_enqueue_style(
		'bigwigs-bootstrap-editor-style',
		get_stylesheet_directory_uri() . "/vendors/bootstrap-dist/css/bootstrap-theme.min.css",
		array(),
		BIGWIGS_VERSION
	);
	wp_enqueue_style(
		'bigwigs-editor-style',
		get_stylesheet_directory_uri() . "/style-editor.css",
		array(),
		BIGWIGS_VERSION
	);
}
add_action('enqueue_block_editor_assets', 'bigwigs_editor_style');

/**
 * Load WordPress nav walker.
 */
require get_template_directory() . '/inc/navwalker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Theme Customizer.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Upsell section into Customizer
 */
require_once get_template_directory() . '/inc/customizer-upsell/class-customize.php';

/**
 * WooCommerce compatibility functions.
 */
if( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/wc-compatibility.php';
}

/**
 *
 * Additional Conditions
 *
 */
// Posts Page when selected featured post with thumbnail
function bigwigs_is_featured_jumbotron() {
	$thumbnail = '';
	$bigwigs_featured_id = absint( get_theme_mod( 'post_dropdown_setting' ) );
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $bigwigs_featured_id ) );
	if ( $thumbnail ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Example use hooks of theme
 * Add comment button into hero section of single post
 * @see jumbotron-singular.php
 */
function bigwigs_add_tocomment_link(){
	if( !is_front_page() && is_singular(array('post','page')) ){
        if( ! post_password_required() && comments_open() ){
        ?>
        <a href="<?php esc_url( comments_link() ); ?>" class="comment-link btn btn-dark my-2">
        	<?php echo esc_html( 'Leave Comment', 'bigwigs' ); ?>
        </a>
    <?php
		}
	}
}
add_action('bigwigs_jumbotron_container_end','bigwigs_add_tocomment_link');

/**
 * Example use hooks of theme
 * Add scroll-to-top button into footer
 * @see footer.php
 */
function bigwigs_add_back_top(){
	if( ! wp_is_mobile() ){
        echo '<a id="back-to-top" href="#" class="btn btn-dark btn-sm back-to-top" role="button"></a>';
	}
}
add_action('bigwigs_footer','bigwigs_add_back_top',10);

/**
 * Example of bigwigs_set_content_class hooked.
 */
function bigwigs_set_custom_content_class( $classes ) {
	if ( is_page_template( array( 'template-wide.php' ) ) ) {
		$classes = array();
		$classes[] = 'col-md-12';
	}
	return array_unique( $classes );
}
add_filter( 'bigwigs_set_content_class', 'bigwigs_set_custom_content_class' );

/**
 * Load Welcome Screen
 */
require_once( get_template_directory() . '/inc/welcome-screen/welcome-screen.php' );