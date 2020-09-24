<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<span class="sticky-badge"></span>

	<?php
		/**
		 * Post thumbnail display
		 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
		 *
		 */
		the_post_thumbnail( 
			'bigwigs-thumb-750-500', 
			array( 'class' => 'card-img-top img-fluid' ) 
		);
		?>
	
	<div class="card-body">
		<?php 
			the_title( 
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', 
					esc_url( get_permalink() ) ), 
				'</a></h2>' 
			);
			?>

		<div class="entry-meta">
			<?php bigwigs_post_meta(); ?>
		</div>

		<div class="entry-summary card-text">
			<?php the_excerpt(); ?>
		</div>

    </div>
    
<?php if ( '' != get_theme_mod( 'more_link' ) ) { ?>
    <footer class="card-footer">
		<?php 
			echo sprintf( '<a class="more-link" href="%s">', esc_url( get_permalink() ) ), esc_html( get_theme_mod( 'more_link' ) ) .'</a>';
			?>
    </footer>
<?php } ?>
	
</article><!-- #post-<?php the_ID(); ?> -->