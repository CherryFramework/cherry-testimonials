<?php
/**
 * The Template for displaying single CPT Testimonial.
 *
 * @package Cherry_Testimonials
 * @since   1.0.0
 */

while ( have_posts() ) : the_post(); ?>

	<article <?php if ( function_exists( 'cherry_attr' ) ) cherry_attr( 'post' ); ?>>

	<?php
		do_action( 'cherry_post_before' );

		$args = array(
			'id'           => get_the_ID(),
			'template'     => 'single.tmpl',
			'location'     => 'single',
			'custom_class' => 'testimonials-page-single',
		);
		$data = new Cherry_Testimonials_Data;
		$data->the_testimonials( $args );
	?>

	</article>

	<?php do_action( 'cherry_post_after' ); ?>

<?php endwhile; ?>