<?php
/**
 * Standalone Functions.
 *
 * Some of the functionality here could be replaced by core features.
 *
 * @package bigwigs
 */

if ( ! function_exists('bigwigs_content_wrapper_start') ) :
	/**
	 * Print start part of wrapper markup for site content
	 */
	function bigwigs_content_wrapper_start(){
		if( !is_search() && !is_404() ) {
			$content_wrapper = '<div class="container">';
			$content_wrapper .= '<div class="row">';
		} else {
			$content_wrapper = '<div class="container">';
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$output = apply_filters('bigwigs_content_wrapper_start',$content_wrapper);
		echo $output;
	}
endif;

if ( ! function_exists('bigwigs_content_wrapper_end') ) :
	/**
	 * Print end part of wrapper markup for site content
	 */
	function bigwigs_content_wrapper_end(){
		$content_wrapper = '';
		if( !is_search() && !is_404() ) {
			$content_wrapper = '</div><!--/.row -->';
			$content_wrapper .= '</div><!--/.container -->';
		} else {
			$content_wrapper .= '</div><!--/.container -->';
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$output = apply_filters('bigwigs_content_wrapper_end',$content_wrapper);
		echo $output;
	}
endif;

if ( ! function_exists( 'bigwigs_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function bigwigs_posted_on() {
		echo '<span class="post-date">';
		the_time( get_option( 'date_format' ) );
		echo '</span>';

		echo '<span class="screen-reader-text post-date-modified">';
		echo esc_html( get_the_modified_date() );
		echo '</span>';
	}
endif;

if ( ! function_exists( 'bigwigs_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function bigwigs_posted_by() {
		echo '<span class="post-author">';
		printf(
			/* translators: %s: Author name */
			__( 'by %s', 'bigwigs' ),
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
		);
		echo '</span>';
	}
endif;

if ( ! function_exists( 'bigwigs_post_meta' ) ) :
	/**
	 * Prints HTML with post meta information.
	 */
	function bigwigs_post_meta() {
		if ( is_single() ) {
			if ( get_theme_mod( 'hide_single_posted_by' ) != 1 ) {
				bigwigs_posted_by();
			}
			if ( get_theme_mod( 'hide_single_posted_on' ) != 1 ) {
			    bigwigs_posted_on();
			}
		} else {
			if ( get_theme_mod( 'hide_posted_by' ) != 1 ) {
				bigwigs_posted_by();
			}
			if ( get_theme_mod( 'hide_posted_on' ) != 1 ) {
			    bigwigs_posted_on();
			}
		}
}
endif;

if ( ! function_exists( 'bigwigs_post_cats' ) ) :
	/**
	 * Prints HTML with categories list of the post.
	 */
	function bigwigs_post_cats() {
		if ( 'post' === get_post_type() ) {
			$categories = get_the_category();
			$out = '';

			if( $categories ){
				foreach( $categories as $category ) {
					$out .= '<a href="'. esc_url( get_category_link( $category->term_id ) ) .'">' . esc_html( $category->name ) . '</a>, '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				$categories_list = trim( $out, ', ' );
				/* translators: 1: list of categories with comma, there is a space after the comma */
				printf( '<span class="category-list">' . esc_html__( 'Posted in %1$s', 'bigwigs' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}

}
endif;

if ( ! function_exists( 'bigwigs_post_category' ) ) :
	/**
	 * Prints first category of the post.
	 */
	function bigwigs_post_category() {
		if ( 'post' === get_post_type() ) {
			$categories = get_the_category();

			if( $categories[0] ){
				echo '<a class="entry-category" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">'. esc_html( $categories[0]->name ) . '</a>';
			}

		}
	}
endif;


if ( ! function_exists( 'bigwigs_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bigwigs_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'bigwigs' ) );
			if ( $categories_list && get_theme_mod( 'hide_single_posted_in' ) != 1 ) {
				/* translators: 1: list of categories. */
				printf( '<span class="category-list">' . esc_html__( 'Posted in %1$s', 'bigwigs' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			$tags_list = get_the_tag_list('<span class="badge badge-secondary">','</span><span class="badge badge-secondary">','</span>');
			if ( $tags_list && get_theme_mod( 'hide_single_tagged' ) != 1 ) {
				/* translators: 1: list of tags. */
				//printf( '<span class="tag-list">' . esc_html__( 'and tagged %1$s', 'bigwigs' ) . '</span>', $tags_list); // WPCS: XSS OK.
				echo '<span class="tag-list">' . $tags_list . '</span>'; // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bigwigs' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'bigwigs' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'bigwigs_comment' ) ) :
    /**
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function bigwigs_comment( $comment, $args, $depth ) {
        if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
            <div class="comment-body">
                <?php esc_html_e( 'Pingback:', 'bigwigs' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'bigwigs' ), '<span class="edit-link">', '</span>' ); ?>
            </div>

<?php
		else : ?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-circle' ) ); ?>
                </a>

                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php printf( __( '%s <span class="says">says:</span>', 'bigwigs' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                    <time datetime="<?php comment_time( 'c' ); ?>">
                                        <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'bigwigs' ), get_comment_date(), get_comment_time() ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'bigwigs' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'bigwigs' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div><!-- .comment-content -->

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' 	=> $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' 	=> '<footer class="reply comment-reply card-footer">',
                                    'after' 	=> '</footer>'
                                )
                            )
                        ); ?>

                    </div>
                </div><!-- .media-body -->

			</article>
			</li>

            <?php
        endif;
    }
endif;


/**
 * Display the class for layout div wrapper.
 *
 * @param string|array $class
 * One or more classes to add to the class list.
 */
function bigwigs_layout_class( $classes = '' ) {
	// Separates classes with a single space
	echo 'class="' . join( ' ', bigwigs_set_layout_class( $classes ) ) . '"';
}

/**
 * Adds custom class.
 *
 * @param array $classes Classes for the div element.
 * @return array
 */
function bigwigs_set_layout_class( $class = '' ) {

	// Define classes array
	$classes = array();

	// Grid classes
	if ( ( is_home() || is_archive() ) && ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = '';
	}
	
	$classes = array_map( 'esc_attr', $classes );

	// Apply filters to entry post class for child theming
	$classes = apply_filters( 'bigwigs_set_layout_class', $classes );

	// Classes array
	return array_unique( $classes );
}

/**
 * Display the class for content wrapper div.
 *
 * @param string|array $class
 * One or more classes to add to the class list.
 */
function bigwigs_content_class( $classes = '' ) {
	// Separates classes with a single space
	echo ' ' . join( ' ', bigwigs_set_content_class( $classes ) );
}

/**
 * Adds custom class.
 *
 * @param array $classes Classes for the div element.
 * @return array
 */
function bigwigs_set_content_class( $class = '' ) {

	// Define classes array
	$classes = array();

	if ( is_active_sidebar( 'sidebar-1' ) && get_theme_mod( 'sidebar_position' ) != 'none' ) {
		$classes[] = 'col-md-8';
	} else {
		if ( is_post_type_archive() || ( get_theme_mod( 'blog_layout' ) == 'grid' && !is_single() && !is_page() ) ) {
			$classes[] = 'col-md-12';
		} else {
			$classes[] = 'col-md-8';
		}
	}

	// Centered
	if ( ! is_post_type_archive() && ( ! is_active_sidebar( 'sidebar-1' ) || get_theme_mod( 'sidebar_position' ) === 'none' ) ) {
		if ( get_theme_mod( 'blog_layout' ) != 'grid' || is_single() || is_page() ) {
			$classes[] = 'offset-md-2';
		}
	}

	// Blog Layout classes
	if ( ! is_post_type_archive() ) {
		if ( get_theme_mod( 'blog_layout' ) == 'grid' ) {
			$classes[] = 'grid-layout';
		} else {
			$classes[] = 'default-layout';
		}
	}

	// Portfolio Layout classes
	if ( is_post_type_archive('portfolio') ) {
		$classes[] = 'grid-layout';
	}
	
	$classes = array_map( 'esc_attr', $classes );

	// Apply filters to entry post class for child theming
	$classes = apply_filters( 'bigwigs_set_content_class', $classes );

	// Classes array
	return array_unique( $classes );
}

/**
 * Condition function.
 * This is a static front page and not the latest posts page.
 */
function bigwigs_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Appends additional items to the menu bar.
 * see ../template-parts/navigation/additional-items.php
 */
if ( ! function_exists( 'bigwigs_add_navbar_items' ) ) :
	function bigwigs_add_navbar_items(){
		$items = '';

		if ( get_theme_mod('show_search_menu_item') == 1 ) {
			$items .= '<div class="search-btn d-inline"><a href="#" data-toggle="modal" data-target="#searchModalCenter" class="dashicons dashicons-search"></a></div>';
		}
		if ( class_exists( 'WooCommerce' ) && get_theme_mod('show_cart_menu_item') == 1 ) {
			$cartcount =  WC()->cart->get_cart_contents_count();
			if ($cartcount > 0) {
				$cartcount_print = '<sup class="text-monospace">'.absint($cartcount).'</sup>';
			}
			else {
				$cartcount_print = '';
			}
			$items .= '<div class="cart-btn pl-lg-2 d-inline"><a href="'.esc_url(wc_get_cart_url()).'" class="dashicons dashicons-cart">'.$cartcount_print.'</a></div>';
		}
		$output = apply_filters( 'bigwigs_add_navbar_items', $items );
		echo $output;
	}
endif;