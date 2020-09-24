<?php
/**
 * Getting a template to show portfolio posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */
?>

<?php
	// portfolio grid columns class
	if ( get_theme_mod( 'portfolio_grid' ) == '2cols' ) {
		$class = 'col-lg-6';
	}
	elseif ( get_theme_mod( 'portfolio_grid' ) == '3cols' ) {
		$class = 'col-lg-4';
	}
	else {
		$class = 'col-lg-4'; // default
	}
	?>

<div class="<?php echo esc_attr( $class ); ?> mb-4">

<?php
	// get term for filter class
	$portfolio_terms =  get_the_terms( $post->ID, 'portfolio_category' );
	$portfolio_term_list = null;

	if( is_array($portfolio_terms) ) {
		$count = 0;
		foreach( $portfolio_terms as $portfolio_term ) {
			if ( $count > 0 ) {
				$portfolio_term_list .= ' ';
			}
			$portfolio_term_list .= $portfolio_term->term_id;
			$count++;
		}
	}
	?>
<a href="<?php echo esc_url( get_permalink() ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $portfolio_term_list ) ); ?>>

	<?php
		/**
		 * Post thumbnail display
		 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
		 *
		 */
		if ( get_theme_mod( 'portfolio_layout' ) == 'grid' 
			|| ! get_theme_mod( 'portfolio_layout' ) ) {
			the_post_thumbnail( 
				'bigwigs-thumb-750-500', 
				array( 'class' => 'card-img-top img-fluid' ) 
			);
		} else {
			the_post_thumbnail( 
				'bigwigs-featured-v', 
				array( 'class' => 'card-img img-fluid' ) 
			);
		}
		?>
		
		<div class="card-img-overlay text-dark">

			<?php the_title( '<h5 class="card-title">', '</h5>' ); ?>

			<div class="entry-summary card-text">
				<?php 
					// get term name list
					$portfolio_terms =  get_the_terms( $post->ID, 'portfolio_category' );
					if( is_array($portfolio_terms) ) {
						$portfolio_term_list = array();
						foreach( $portfolio_terms as $portfolio_term ) {
							$portfolio_term_list[] = $portfolio_term->name;
						}

					}
					$portfolio_term_list = join( ' &#183; ', $portfolio_term_list );
					echo esc_html( $portfolio_term_list );
				?>
			</div>

	    </div>
		
	</article><!-- #post-<?php the_ID(); ?> -->
</a>

</div><!-- .<?php echo esc_attr( $class ); ?> -->