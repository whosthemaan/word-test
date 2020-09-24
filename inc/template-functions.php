<?php
/**
 * Functions which hooking
 *
 * @package bigwigs
 */

function bigwigs_get_pre_footer(){
	if( has_nav_menu( 'footer' ) || has_nav_menu( 'social' ) ) {
		get_template_part( 'template-parts/pre-footer' );
	}
}
add_action('bigwigs_before_footer','bigwigs_get_pre_footer');

function bigwigs_blog_wrap_start(){
	if ( get_theme_mod( 'blog_layout' ) == 'grid' ) {
		echo '<div class="grid row">';
	}
}
add_action('bigwigs_before_index_loop','bigwigs_blog_wrap_start');

function bigwigs_blog_wrap_end(){
	if ( get_theme_mod( 'blog_layout' ) == 'grid' ) {
		echo '</div>';
	}

	if( get_theme_mod( 'blog_pagination_mode' ) == 'numeric' ){
		the_posts_pagination();
	}
	else{
		the_posts_navigation();
	}
}
add_action('bigwigs_after_index_loop','bigwigs_blog_wrap_end');


function bigwigs_entry_summary(){
	global $post;
	$has_more = strpos( $post->post_content, '<!--more' );

	if ( $has_more ) {
		the_content();
	} else {
		the_excerpt();
	}

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bigwigs' ),
		'after'  => '</div>',
	) );
}
add_action( 'bigwigs_entry_summary', 'bigwigs_entry_summary' );

function bigwigs_site_branding(){
	/**
	 *
	 * Your site title as branding in the menu 
	 *
	 */
	if ( is_front_page() || ( is_home() && 'posts' == get_option( 'show_on_front' ) ) ) :
		if ( has_custom_logo() ) {
			$logo_img = '';
			if( $custom_logo_id = get_theme_mod('custom_logo') ){
				$logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
					'class'    => 'custom-logo',
					'itemprop' => 'logo',
				) );
			}

			echo $logo_img; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<?php if ( 1 != get_theme_mod( 'site_title_hide' ) ) { ?>
			<div class="navbar-brand<?php if ( has_custom_logo() ) { ?> ml-0 ml-md-2<?php } ?> mb-0">
				<?php bloginfo( 'name' ); ?>
			</div>
		<?php } ?>
	<?php 
	else :
		if ( has_custom_logo() ) {
			the_custom_logo();
		}
		?>
		<?php if ( 1 != get_theme_mod( 'site_title_hide' ) ) { ?>
		<div class="navbar-brand<?php if ( has_custom_logo() ) { ?> ml-0 ml-md-2<?php } ?> mb-0">
			<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
		</div>
		<?php } ?>
	<?php 
	endif;
}
add_action('bigwigs_branding_menu','bigwigs_site_branding');

/**
 *
 * Primary menu output function.
 *
 */
function bigwigs_main_menu(){
    wp_nav_menu(
    	array(
            'theme_location'  => 'primary',
            //'container'       => 'div',
            'menu_id'         => false,
            'menu_class'      => 'navbar-nav',
            'depth'           => 3,
            'walker'          => new Bigwigs_WP_Bootstrap_Navwalker(),
            'fallback_cb'     => 'Bigwigs_WP_Bootstrap_Navwalker::fallback',
        )
    );
}
add_action('bigwigs_primary_menu','bigwigs_main_menu');
 
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bigwigs_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bigwigs_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bigwigs_body_classes( $classes ) {
    /* using mobile browser */
    if ( wp_is_mobile() ){
        $classes[] = 'wp-is-mobile';
    }
    else{
        $classes[] = 'wp-is-not-mobile';
    }	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class if the front-page
	if ( is_front_page() ) {
		$classes[] = 'front-page';
	}
	// Adds a class if the customizer preview
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-preview';
	}
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of has-thumbnail.
	if ( ( is_singular() && !is_front_page() && has_post_thumbnail() )
	|| ( is_home() && bigwigs_is_featured_jumbotron() ) 
	|| ( is_front_page() && get_theme_mod('banner_bg_image') ) ) {
		$classes[] = 'has-thumbnail';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'bigwigs_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the article element.
 * @return array
 */
function bigwigs_post_classes( $classes ) {
	$classes[] = ( has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail' );
	
	if ( is_front_page() || is_home() || is_archive() ) {
		if ( get_post_type() != 'page' ) {
			$classes[] = 'post-preview';
		}
	}

	// Adds a class of portfolio.
	if ( is_post_type_archive( 'portfolio' ) || is_tax(array( 'portfolio_category', 'portfolio_tag') ) ) {
		$classes[] = 'card mb-4';
	}

	if ( is_front_page() && get_post_type() == 'portfolio' ) {
		$classes[] = 'card mb-4';
	}

	if ( is_singular( array('post', 'page') ) && ! is_front_page() ) {
		$classes[] = 'card mb-4';
	}
	
	if ( is_home() || is_archive() || is_front_page() ) {
		if ( get_post_type() == 'post' ) {
			if ( get_theme_mod( 'blog_layout' ) == 'grid' ) {
				$classes[] = 'grid-item card h-100';
			}
			elseif ( !get_theme_mod( 'blog_layout' ) 
				|| get_theme_mod( 'blog_layout' ) == 'standard' ) {
				$classes[] = 'shadow card mb-4';
			}
			else {
				$classes[] = 'card mb-4';
			}
		}
	}
	
	return $classes;
}
add_action( 'post_class', 'bigwigs_post_classes' );

/**
 * Print markup of bootstrap's card component
 */
function bigwigs_card_wrap_start(){
	echo '<div class="card-body">';
}
function bigwigs_card_wrap_end(){
	echo '</div><!--.card-body-->';
}
add_action( 'bigwigs_header_before', 'bigwigs_card_wrap_start' );
add_action( 'bigwigs_article_end', 'bigwigs_card_wrap_end' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... 
 * and the read more button.
 *
 * @return string link
 */
function bigwigs_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	if ( '' != get_theme_mod( 'more_link' ) ) {
		$link = '...';
	} else {
		$link = '...';
	}
	return $link;
}
add_filter( 'excerpt_more', 'bigwigs_excerpt_more' );

function bigwigs_more_link($more_link, $more_link_text) {
	if ( '' != get_theme_mod( 'more_link' ) ) {
		$link_txt = esc_html( get_theme_mod( 'more_link' ) );
		return str_replace($more_link_text, $link_txt, $more_link);
	} else {
		return false;
	}
}
add_filter('the_content_more_link', 'bigwigs_more_link', 10, 2);

/**
 * Responsive Image class from Bootstrap
 * which appended to automatically generated image classes
 */
function bigwigs_bootstrap_class_images( $html ){
	$classes = 'img-fluid'; // separated by spaces, e.g. 'img image-link'
	// check if there are already classes assigned to the anchor
	if ( preg_match('/<img.*? class="/', $html) ) {
		$html = preg_replace('/(<img.*? class=".*?)(".*?\/>)/', '$1 ' . $classes . '$2', $html);
	} else {
		$html = preg_replace('/(<img.*?)(\/>)/', '$1 class="' . $classes . '"$2', $html);
	}
	return $html;
}
add_filter( 'the_content','bigwigs_bootstrap_class_images', 10 );

/**
 * Added table class from Bootstrap
 */
function bigwigs_bootstrap_table_class( $content ){
    return str_replace( '<table', '<table class="table"', $content );
}
add_filter( 'the_content', 'bigwigs_bootstrap_table_class' );

/**
 * Adds a class to the navigation links of posts
 */
function bigwigs_posts_link_attributes() {
	return 'class="btn btn-light"';
}
add_filter('next_posts_link_attributes', 'bigwigs_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'bigwigs_posts_link_attributes');

/**
 * Comment form container.
 */
function bigwigs_comment_form_wrap_start(){
	echo '<div class="card my-4"><div class="card-body">';
}
function bigwigs_comment_form_wrap_end(){
	echo '</div></div>';
}
add_action( 'comment_form_after', 'bigwigs_comment_form_wrap_end' );
add_action( 'comment_form_before', 'bigwigs_comment_form_wrap_start' );

/**
 * Add custom class to comment reply link.
 */
function bigwigs_comment_reply_link( $content ) {
    $extra_classes = 'btn btn-primary';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content );
}
add_filter( 'comment_reply_link', 'bigwigs_comment_reply_link', 99 );

/**
 * Custom Excerpt lengths.
 */
function bigwigs_custom_excerpt_length($length) {
    if ( is_admin() ) {
    	return $length;
    }
    return 32;
}
add_filter( 'excerpt_length', 'bigwigs_custom_excerpt_length' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function bigwigs_front_page( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'bigwigs_front_page' );


/**
 * 
 * Return an alternative title, without prefix
 * for every type used in the get_the_archive_title()
 * 
 */
function bigwigs_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '#', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( 'Y' );
    } elseif ( is_month() ) {
        $title = get_the_date( 'F Y' );
    } elseif ( is_day() ) {
        $title = get_the_date( get_option( 'date_format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = esc_html( _x( 'Asides', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = esc_html( _x( 'Galleries', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = esc_html( _x( 'Images', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = esc_html( _x( 'Videos', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = esc_html( _x( 'Quotes', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = esc_html( _x( 'Links', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = esc_html( _x( 'Statuses', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = esc_html( _x( 'Audio', 'post format archive title', 'bigwigs' ) );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = esc_html( _x( 'Chats', 'post format archive title', 'bigwigs' ) );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives', 'bigwigs' );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'bigwigs_archive_title' );