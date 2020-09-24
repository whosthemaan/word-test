<?php
/**
 * The template for displaying a single post 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bigwigs
 */

get_header();
bigwigs_content_wrapper_start();
?>

	<div id="primary" class="content-area<?php bigwigs_content_class(); ?>">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-single-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/post/single', get_post_format() );

			the_post_navigation( array(
				'prev_text' => '<span class="post-navigation-label font-weight-light text-muted">' . esc_html__( 'Previous:', 'bigwigs' ) . '</span><span class="post-title">%title</span>',
				'next_text' => '<span class="post-navigation-label font-weight-light text-muted">' . esc_html__( 'Next:', 'bigwigs' ) . '</span><span class="post-title">%title</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
get_sidebar();
bigwigs_content_wrapper_end();
get_footer();
