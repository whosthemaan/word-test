<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

?>
<a href="<?php echo esc_url( get_permalink() ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); // 'bg-dark' ?>>

	<?php
		/**
		 * Post thumbnail display
		 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
		 *
		 */
		if ( get_theme_mod( 'blog_layout' ) == 'grid' ) {
			the_post_thumbnail( 
				'bigwigs-thumb-v-350-470', 
				array( 'class' => 'card-img-top img-fluid' ) 
			);			
		} else {
			the_post_thumbnail( 
				'bigwigs-featured-v', 
				array( 'class' => 'card-img img-fluid' ) 
			);			
		}
		?>

		<div class="card-img-overlay text-white">
			<?php the_title( '<h5 class="card-title">', '</h5>' ); ?>
			<?php 
			if( has_excerpt() ) {
				echo '<div class="entry-summary card-text">';
					the_excerpt();
				echo '</div>';
			}
			?>
	    </div>

	</article><!-- #post-<?php the_ID(); ?> -->
</a>