<?php
/**
 * The Template for displaying single CPT Testimonial.
 *
 * @package Cherry_Testimonials
 * @since   1.0.0
 */

if ( ! function_exists( 'cherry_get_header' ) ) {
	get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php }

while ( have_posts() ) : the_post();

	/**
	 * Fire before `Tesimonial` entry.
	 *
	 * @since 1.1.1
	 */
	do_action( 'cherry_testimonials_entry_before' ); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

	<?php $args = array(
		'id'           => get_the_ID(),
		'size'         => 100,
		'template'     => 'single.tmpl',
		'custom_class' => 'testimonials-page-single',
	);

	$data = Cherry_Testimonials_Data::get_instance();
	$data->the_testimonials( $args ); ?>

	</article>

	<?php
	/**
	 * Fire after `Tesimonial` entry.
	 *
	 * @since 1.1.1
	 */
	do_action( 'cherry_testimonials_entry_after' );

endwhile;

if ( ! function_exists( 'cherry_get_footer' ) ) { ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<?php get_footer();
} ?>
