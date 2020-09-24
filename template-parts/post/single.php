<?php
/**
 * Template part for displaying Single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php do_action( 'bigwigs_article_start' ); ?>

<?php
	if( get_theme_mod('single_header_display')!='alt' ){
		/**
		 * Post thumbnail display
		 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
		 *
		 */
		the_post_thumbnail( 
			'bigwigs-featured-900-600', 
			array( 'class' => 'img-fluid rounded mb-2' ) 
		);
	}
	?>

<?php do_action( 'bigwigs_header_before' ); ?>

	<?php if( get_theme_mod('single_header_display')!='alt' ){ ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title display-4">', '</h1>' ); ?>
			<?php if ( has_excerpt() ) : ?>
				<div class="lead mb-2"><?php the_excerpt(); ?></div>
			<?php endif; ?>
		</header>
	<?php } ?>

	<?php if( get_theme_mod('single_header_display')!='alt' ){ ?>
		<div class="entry-meta border-top border-bottom mb-4 mt-4 pt-2 pb-2">
		  	<?php bigwigs_post_meta(); ?>
		</div>
	<?php } ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bigwigs' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer mt-4">
		<?php bigwigs_entry_footer(); ?>
	</footer>

<?php do_action( 'bigwigs_article_end' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->