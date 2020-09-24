<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */
?>

<?php 
if ( get_theme_mod( 'blog_grid' ) == '2cols' ) {
	$class = 'col-lg-6';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
elseif ( get_theme_mod( 'blog_grid' ) == '3cols' ) {
	$class = 'col-lg-4';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
else {
	// default
	$class = 'col-lg-4';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
?>

<div class="<?php echo esc_attr( $class ); ?> mb-4">
	<?php get_template_part( 'template-parts/post/preview', get_post_format() ); ?>
</div>