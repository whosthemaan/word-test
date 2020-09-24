<?php
// Define links.
$review_link = '<a href="https://wordpress.org/support/theme/bigwigs/reviews/#new-post" target="_blank">' . esc_html__( 'review', 'bigwigs' ) . '</a>';
?>

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Rate please', 'bigwigs' ); ?></h3>
    <p>
	   <?php
            /* translators: %s is a placeholders that will be replaced by variables passed as an argument. */
            printf( esc_html__( 'I will appreciate if you find a few secs to leave a few stars %s.', 'bigwigs' ), $review_link ); // WPCS: XSS OK.
       ?>
	</p>
</div><!-- .tab-section -->
