<?php
$bigwigs_theme = wp_get_theme();
$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'getting_started';

// Links that are used on this page.
$header_links = array(
    'pro' => 'http://dinevthemes.com/themes/bigwigs-pro/'
);
?>

<div class="wrap bigwigs-dashboard">

    <div class="page-header wp-clearfix">
        <div class="theme-info">
            <div class="inner">
                <h1><?php esc_html_e( 'Welcome to BigWigs Theme!', 'bigwigs' ) ?></h1>
                <?php printf( '<p class="ver">%1$s %2$s</p>', esc_html__( 'Version:', 'bigwigs' ), esc_html( $bigwigs_theme->Version ) ); ?>
                <p class="theme-description"><?php echo esc_html( $bigwigs_theme->Description ); ?></p>
                <p>
                    <strong>
                    <?php esc_html_e( 'You can get more features plus one-on-one support by purchased the Pro version of this theme.', 'bigwigs' ); ?>
                    </strong>
                </p>
                    <?php
                    // Display link to the Pro version.
                    printf( '<a href="%1$s"  class="button button-primary" target="_blank">%2$s</a>', esc_url( $header_links['pro'] ), esc_html__( 'Get Pro', 'bigwigs' ) );
                    ?>
            </div><!-- .inner -->
        </div><!-- .theme-info -->

        <div class="theme-screenshot">
            <img src="<?php echo esc_url( BIGWIGS_DIR_URI . '/screenshot.png' ); ?>" alt="<?php echo esc_attr( $bigwigs_theme->Name ); ?>" />
        </div><!-- .theme-screenshot -->
    </div><!-- .page-header -->

    <h2 class="nav-tab-wrapper wp-clearfix">
        <?php Bigwigs_Welcome_Screen::get_dashboard_page_tabs( $active_tab ); ?>
    </h2><!-- .nav-tab-wrapper -->

    <div class="tab-content wp-clearfix">
        <div class="tab-primary">
            <div class="inner">
                <?php Bigwigs_Welcome_Screen::get_dashboard_page_tab_content( $active_tab ); ?>
            </div><!-- .inner -->
        </div><!-- .tab-primary -->

        <div class="tab-secondary">
            <div class="inner">
                <?php require_once BIGWIGS_DIR . '/inc/welcome-screen/partials/theme-dashboard-sidebar.php'; ?>
            </div><!-- .inner -->
        </div><!-- .tab-secondary -->
    </div><!-- .tab-content -->
</div><!-- .wrap.about-wrap -->
