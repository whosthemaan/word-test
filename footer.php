<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bigwigs
 */

?>

	</div><!-- #content -->

	<?php do_action('bigwigs_before_footer'); ?>
	
	<footer id="colophon" class="site-footer bg-dark py-5">

	<?php do_action('bigwigs_footer'); ?>

	<?php
		if( is_active_sidebar('footer-1') 
			|| is_active_sidebar('footer-2') 
			|| is_active_sidebar('footer-3') ){
		?>
		<div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' )) : ?>
                    <div class="widget-column col-12 col-md-4">
                    	<?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' )) : ?>
                    <div class="widget-column col-12 col-md-4">
                    	<?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' )) : ?>
                    <div class="widget-column col-12 col-md-4">
                    	<?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
	    </div><!-- .container -->
	<?php
		}
		?>

		<div class="container">
			<div class="site-info">
				<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Powered by %s', 'bigwigs' ), '<a href="'.esc_url( __( 'https://wordpress.org', 'bigwigs' ) ).'">WordPress</a>' );
				?>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme %1$s from %2$s', 'bigwigs' ), '<a href="'.esc_url( __( 'http://www.dinevthemes.com/wordpress-themes/bigwigs-pro/', 'bigwigs' ) ).'">Bigwigs</a>', 'DinevThemes' );
				?>
			</div><!-- .site-info -->
		</div><!-- .container -->

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>