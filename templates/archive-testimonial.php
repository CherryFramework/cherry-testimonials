<?php
/**
 * The archive index page for CPT Tesimonial.
 */
$args = array(
	'limit'        => 4,
	'size'         => 100,
	'pager'        => 'true',
	'template'     => 'page.tmpl',
	'custom_class' => 'testimonials-page testimonials-page_archive',
);
$data = new Cherry_Testimonials_Data;
$data->the_testimonials( $args );