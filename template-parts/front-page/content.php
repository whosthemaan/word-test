<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

?>

<?php if ( get_the_content() == '' ) { return; } ?>

<section id="frontpage-content" class="frontpage-section mt-5 mb-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class('front-page-content'); ?>>

<?php
	if ( get_theme_mod( 'frontpage_content_title' ) 
		|| get_theme_mod( 'frontpage_content_subtitle' ) ) : ?>

		<div class="section-header pt-8 pb-5 center">
               			<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'frontpage_content_title' ) ); ?></h2>
               			<p><?php echo esc_html( get_theme_mod( 'frontpage_content_subtitle' ) ); ?></p>
		</div>
<?php
	endif; ?>

	<?php
	the_post_thumbnail( 'bigwigs-cover-image',
			array( 
				'class' => 'img-fluid rounded pb-4' 
			)
	);
	?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bigwigs' ),
				'after'  => '</div>',
			) );
			?>
		</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
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
			?>
		</footer>
	<?php endif; ?>
	</article><!-- #post-<?php the_ID(); ?> -->
</section>
