<?php
/**
 * Getting a template to show posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

$bigwigs_content = '';

if ( get_theme_mod( 'blog_layout' ) && get_theme_mod( 'blog_layout' ) != 'standard' ) {
	$bigwigs_layout_prefix = '-';
	$bigwigs_content = $bigwigs_layout_prefix . get_theme_mod( 'blog_layout' );
}
?>

<?php 
	/*
	 * Include the Post-Format-specific template for the content.
	 */
	get_template_part( 
		'template-parts/post/preview'.$bigwigs_content, 
		get_post_format() 
	);
?>