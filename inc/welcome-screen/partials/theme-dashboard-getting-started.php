<?php
/**
 * This file is used to markup the "Getting Started" section on the dashboard page.
 *
 * @package bigwigs
 */
// Links that are used on this page.
$getting_started_links = array(
	'portfolio'                    => 'https://wordpress.org/plugins/portfolio-post-type/',
	'woocommerce'                  => 'https://wordpress.org/plugins/woocommerce/',
    'advanced_bootstrap_blocks'    => 'https://wordpress.org/plugins/advanced-bootstrap-blocks/',
    'atomic-blocks'                => 'https://wordpress.org/plugins/atomic-blocks/',
    'elementor'                    => 'https://wordpress.org/plugins/elementor/'
);
?>

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Front Page Setup', 'bigwigs' ); ?></h3>

    <p><?php esc_html_e( 'Create a new by going to Pages > Add New. Give your page a name (Title field). In the same way create a blank page for the Blog Page.', 'bigwigs' ); ?></p>
	<p><?php esc_html_e( 'Now you can go to Appearance > Customize > Homepage Settings and choose your new created Page as your Front Page.', 'bigwigs' ); ?></p>
    <p><?php esc_html_e( 'When you have set a static page for your homepage displays, you can make some settings for the front page, go to Customizer > Front Page Sections.', 'bigwigs' ); ?></p>

</div><!-- .tab-section -->

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Theme Options', 'bigwigs' ); ?></h3>

    <p><?php esc_html_e( 'You can use of the Customizer to provide you with the theme options. Press the button below to open the Customizer and start making changes.', 'bigwigs' ); ?></p>

    <p><a href="<?php echo wp_customize_url(); // WPCS: XSS OK. ?>" class="button" target="_blank"><?php esc_html_e( 'Customize Theme', 'bigwigs' ); ?></a></p>
</div><!-- .tab-section -->

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Recommended Plugins', 'bigwigs' ); ?></h3>
    <p>
    <?php
        printf( 'Use Bootstrap components blocks via <a href="%1$s" target="_blank">%2$s</a> plugin. ', esc_url( $getting_started_links['advanced_bootstrap_blocks'] ), esc_html__( 'Advanced Bootstrap Blocks', 'bigwigs' ) );
        printf( 'To create landing pages purchase Pro version and use the page template called Blank Page and Layouts module from plugin <a href="%1$s" target="_blank">%2$s</a>. ', esc_url( $getting_started_links['atomic-blocks'] ), esc_html__( 'Atomic Blocks', 'bigwigs' ) );
        printf( 'Tested compatibility with the <a href="%1$s" target="_blank">%2$s</a> plugin. ', esc_url( $getting_started_links['elementor'] ), esc_html__( 'Elementor', 'bigwigs' ) );
        printf( 'To create a store, activate the <a href="%1$s" target="_blank">%2$s</a> plugin. ', esc_url( $getting_started_links['woocommerce'] ), esc_html__( 'WooCommerce', 'bigwigs' ) );
        printf( 'To create a portfolio, activate the <a href="%1$s" target="_blank">%2$s</a> plugin.', esc_url( $getting_started_links['portfolio'] ), esc_html__( 'Portfolio Post Type', 'bigwigs' ) );
    ?>
    </p>
</div><!-- .tab-section -->
