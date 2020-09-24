<?php
/**
 * This is the default view for portfolio archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */

get_header();

bigwigs_content_wrapper_start();
?>

<div id="primary" class="content-area<?php bigwigs_content_class(); ?>">
	<main id="main" class="site-main" role="main">

	<?php
		if ( have_posts() ) :
			?>
			<header class="archive-header pb-4">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

	<?php 
		if ( ! is_tax( array('portfolio_category', 'portfolio_tag') ) ) : ?>

			<nav class="filter-menu">
				<ul>
					<li class="filter-menu-label text-muted">
						<?php esc_html_e( 'Category filter:', 'bigwigs' );?>
					</li>
					<li>
						<a href="#" class="filter-menu__clear" data-filter="*"><?php esc_html_e( 'All', 'bigwigs' );?></a>
					</li>
				<?php
					$loop_terms = 'portfolio_category';
					$portfolio_terms = get_terms( $loop_terms );

					foreach( $portfolio_terms as $portfolio_term ) {
						echo '<li><a href="#" class="filter-menu__item" data-filter=".' . esc_attr( $portfolio_term->term_id ) .'">' . esc_html( $portfolio_term->name ) . '</a></li>';
					} 
					?>
				</ul>
		    </nav>

	<?php 
		endif; ?>

			<div class="grid row">

		<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'portfolio' );

			endwhile;
			?>

			</div>

	<?php
			the_posts_pagination();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
	?>

	</main>
</div><!-- #primary -->

<?php
get_sidebar(); /* Get Sidebar #secondary */
bigwigs_content_wrapper_end();
get_footer();