<?php 
/**
 * Template part for displaying head banner of single post/page:
 * contains Post Title, Post Meta, and comment link
 * 
 * @see https://getbootstrap.com/docs/4.3/components/jumbotron/
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$subheading = '';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
$by_link    = '';// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
$heading 	  = get_the_title();
$bg_img     = get_the_post_thumbnail_url( $post->ID, 'full' );
$subheading = apply_filters( 'bigwigs_jumbotron_subheading', $subheading );

if( get_post_type() == 'post' ){
  $username = get_userdata( $post->post_author );
  $by_link = sprintf(
    /* translators: %s: post author. */
    esc_html_x( 'by %s', 'post author', 'bigwigs' ),
    esc_html( $username->user_nicename )
  );
}

if( get_theme_mod('single_header_display')!='alt' 
  || ( empty( $heading ) && empty( $bg_img ) ) ){
	return;
}
?>

<section class="jumbotron hero text-center"<?php if( ! empty( $bg_img ) ){ echo ' style="background: url(' . esc_url( $bg_img ) . ');"';} ?>>
  <div class="overlay">
    <div class="container">
    
      <?php do_action( 'bigwigs_before_heading_jumbotron' ); ?>

      <?php bigwigs_post_category(); ?>

      <h1 class="display-3 jumbotron-heading<?php if( ! empty( $bg_img ) ){ echo ' text-white';} ?>"><?php echo esc_html( $heading ); ?></h1>

      <?php do_action( 'bigwigs_after_heading_jumbotron' ); ?>

      <?php
        // post meta: date and author
        if( get_post_type() == 'post' ){
          if ( get_theme_mod( 'hide_single_posted_by' ) != 1 
            || get_theme_mod( 'hide_single_posted_on' ) != 1 ) {
        ?>
        <p class="entry-meta<?php if( ! empty( $bg_img ) ){ echo ' text-white';} ?>">
          <?php if ( get_theme_mod( 'hide_single_posted_by' ) != 1 ) { ?>
            <span class="post-author"><?php echo $by_link; // WPCS: XSS OK ?></span>
          <?php } ?>
          <?php if ( get_theme_mod( 'hide_single_posted_on' ) != 1 ) { ?>
            <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
          <?php } ?>
        </p>
      <?php
          }
        }
        // if is a post

        if( has_excerpt() ) :
        ?>
          <div class="lead<?php if( ! empty( $bg_img ) ){ echo ' text-white';} ?>">
            <?php the_excerpt(); ?>
          </div>
      <?php 
        endif; // has_excerpt()

        /**
         * @hooked bigwigs_add_tocomment_link
         * @see functions.php
         */
        do_action( 'bigwigs_jumbotron_container_end' );
        ?>

    </div><!--.container-->
  </div><!--.overlay-->
</section>
