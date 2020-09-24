<?php
/**
 * Template part for displaying featured post on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

?>

<?php
// Get featured post ID
$bigwigs_featured_id = absint( get_theme_mod( 'post_dropdown_setting' ) );

if ( empty( $bigwigs_featured_id ) ) {
  return;
}

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $bigwigs_featured_id ), 'full' );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

  // Getting post by ID
  $query = new WP_Query( 'p=' . $bigwigs_featured_id );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
    while ( $query->have_posts() ) :          
      $query->the_post();

      // get post meta
      $published = get_post_time( 'F j, Y' );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
      $username = get_userdata( $post->post_author );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
      $by_link = sprintf(// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
        /* translators: %s: post author. */
        esc_html_x( 'by %s', '', 'bigwigs' ),
        esc_html( $username->user_nicename )
      );
?>

<!-- Begin Featured Post -->

    <section class="jumbotron hero text-center"<?php if( ! empty( $thumbnail ) ) { echo ' style="background: url(' . esc_url( $thumbnail[0] ) . ');"'; } ?>>

      <?php if( ! empty( $thumbnail ) ){ echo '<div class="overlay">'; } ?>

          <div class="container">

            <h1 class="display-3 jumbotron-heading<?php if( ! empty( $thumbnail ) ){ echo ' text-white';} ?>"><?php the_title(); ?></h1>

            <p class="entry-meta<?php if( ! empty( $thumbnail ) ){ echo ' text-white';} ?>">
              <span class="post-author"><?php echo $by_link; // phpcs:ignore WordPress.Security.EscapeOutput--Escaped line 30 ?></span>
              <span class="post-date"><?php echo esc_html( $published ); ?></span>
            </p>

            <?php if( has_excerpt() ) : ?>
              <div class="lead<?php if( ! empty( $thumbnail ) ){ echo ' text-white';} ?>">
                <?php the_excerpt(); ?>
              </div>
            <?php endif; ?>

            <a class="btn btn-dark my-2" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( 'Read More', 'bigwigs' ); ?></a>

          </div><!-- .container -->

      <?php if( ! empty( $thumbnail ) ){ echo '</div><!--.overlay-->'; } ?>

    </section><!-- .jumbotron -->

<!-- END Featured Post -->

<?php
    endwhile;
  // Reset $query
  wp_reset_postdata();