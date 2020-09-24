<?php
/**
 * Template Name: Wide Template
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
bigwigs_content_wrapper_end();
get_footer();
