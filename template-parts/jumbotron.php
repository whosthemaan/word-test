<?php 
/**
 * Template part for displaying head banner in front-page.php
 * 
 * @link https://getbootstrap.com/docs/4.3/components/jumbotron/
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$heading 	  = get_theme_mod( 'banner_title' );
$subheading = get_theme_mod( 'banner_subtitle' );
$btn_link 	= get_theme_mod( 'banner_button_link' );
$btn_label 	= get_theme_mod( 'banner_button_label' );
$bg_img 	  = get_theme_mod('banner_bg_image');

if( ! empty( $bg_img ) ){
	$img_url = wp_get_attachment_url( $bg_img );
}

if( empty( $heading ) && empty( $subheading ) && empty( $bg_img ) && empty( $btn_label ) ) {
	return;
}
?>

<section class="jumbotron hero text-center"<?php if( ! empty( $bg_img ) ){ echo ' style="background: url(' . esc_url( $img_url ) . ');"';} ?>>

  <div class="overlay">

    <div class="container">

      <?php do_action( 'bigwigs_before_heading_jumbotron' ); ?>

      <h1 class="display-3 jumbotron-heading<?php if( ! empty( $bg_img ) ){ echo ' text-white';} ?>"><?php echo esc_html( $heading ); ?></h1>

      <?php do_action( 'bigwigs_after_heading_jumbotron' ); ?>

      <p class="lead<?php if( ! empty( $bg_img ) ){ echo ' text-white';} ?>"><?php echo esc_html( $subheading ); ?></p>

      <?php if( ! empty( $btn_label ) ){ ?>
        <p><a href="<?php echo esc_url( $btn_link ); ?>" class="btn btn-dark my-2">
        		<?php echo esc_html( $btn_label ); ?></a></p>
    	<?php } ?>

      <?php do_action( 'bigwigs_jumbotron_container_end' ); ?>

    </div><!--.container-->

  </div><!--.overlay-->
  
</section>
