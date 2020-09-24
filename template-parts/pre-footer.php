<?php
/**
 * Getting a template pre-footer part
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */
?>

<div id="pre-footer" class="pre-footer">
	<div class="container">
        <div class="row">
        	<div class="col-12 col-md-6">
				<?php 
					if ( has_nav_menu( 'footer' ) ) : ?>
						<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'bigwigs' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu',
									'depth'          => 1
								) );
							?>
						</nav>
				<?php
					endif; ?>
			</div>
			<div class="col-12 col-md-6">
				<?php 
					if ( has_nav_menu( 'social' ) ) : ?>
						<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'bigwigs' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . bigwigs_get_svg( array( 'icon' => 'chain' ) ),
								) );
							?>
						</nav>
				<?php
					endif; ?>
			</div>
		</div>
	</div>
</div>