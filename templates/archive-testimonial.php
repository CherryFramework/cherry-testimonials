<?php
/**
 * The archive index page for CPT Tesimonial.
 *
 * @package Cherry_Testimonials
 * @since   1.0.2
 */

if ( ! function_exists( 'cherry_get_header' ) ) {
	get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php } ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

		<?php global $wp_query;

		$args = array(
			'limit'        => Cherry_Testimonials_Page_Template::get_posts_per_archive_page(),
			'size'         => 100,
			'pager'        => 'true',
			'template'     => 'page.tmpl',
			'category'     => ! empty( $wp_query->query_vars['term'] ) ? $wp_query->query_vars['term'] : '',
			'custom_class' => 'testimonials-page testimonials-page_archive',
		);
		$data = Cherry_Testimonials_Data::get_instance();
		$data->the_testimonials( $args ); ?>

	</article>

<?php if ( ! function_exists( 'cherry_get_footer' ) ) { ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<?php get_footer();
} ?>
