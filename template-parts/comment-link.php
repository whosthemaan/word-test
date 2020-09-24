<?php 
/**
 * Template part for displaying button link to commenting
 * @see bigwigs_add_tocomment_link in functions file
 */
//$post = get_post( $post );
if( !is_singular(array('post','page'))){
  return;
}
if( ! post_password_required() && comments_open() ){ ?>
  <a href="<?php esc_url( comments_link() ); ?>" class="comment-link btn btn-primary my-2">
    <?php echo esc_html( 'Leave Comment', 'bigwigs' ); ?>
  </a>
<?php 
}