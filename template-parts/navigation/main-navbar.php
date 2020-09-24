<?php
/**
 * Site Header
 * 
 * Template part for displaying the main navigation on the top bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package bigwigs
 */
?>

<?php
// Posts Page: if selected featured post with thumbnail
$thumbnail = '';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
$bigwigs_featured_id = absint( get_theme_mod( 'post_dropdown_setting' ) );
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $bigwigs_featured_id ) );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$classes = '';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

if ( ( is_front_page() && get_theme_mod( 'banner_bg_image' ) ) 
	|| ( get_theme_mod('single_header_display') == 'alt' && !is_front_page() && is_singular() && has_post_thumbnail() )
	|| ( is_home() && ! empty( $bigwigs_featured_id ) ) ) { // && $thumbnail 
	$classes = 'navbar-dark';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
} else {
	$classes = 'navbar-light';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
?>
<!-- navbar-light bg-light navbar-dark bg-dark fixed-top -->
<header id="masthead" class="site-header" role="banner">
	<nav class="navbar navbar-expand-lg <?php echo $classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> bg-transparent">
		<div class="container">

			<?php
			/**
			 * 
			 * @hooked bigwigs_site_branding
			 * @see template-functions file
			 * 
			 */
			do_action('bigwigs_branding_menu'); ?>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

			<div id="navbarNavDropdown" class="collapse navbar-collapse<?php if ( get_theme_mod( 'menubar_mode' ) != 'alt' ) { echo ' justify-content-end'; } ?>">

				<?php
				/**
				 * 
				 * @hooked bigwigs_main_menu
				 * @see template-functions file
				 * 
				 */
				do_action('bigwigs_primary_menu'); ?>

				<?php
					// Append additional items to the right in the main menu bar.
					get_template_part( 'template-parts/navigation/additional-items' ); ?>

			</div>

		</div>
	</nav>
</header><!-- #masthead -->