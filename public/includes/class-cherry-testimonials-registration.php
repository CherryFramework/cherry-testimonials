<?php
/**
 * New post type and taxonomy registration.
 *
 * @package   Cherry_Testimonials
 * @author    Cherry Team
 * @license   GPL-3.0+
 * @link      http://www.cherryframework.com/
 * @copyright 2012 - 2015, Cherry Team
 */

/**
 * Class for register post types.
 *
 * @since 1.0.0
 */
class Cherry_Testimonials_Registration {

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Sets up needed actions/filters.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
		add_action( 'init', array( __CLASS__, 'register_taxonomy' ) );
	}

	/**
	 * Register the Testimonial post type.
	 *
	 * @since 1.0.0
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public static function register_post_type() {
		$labels = array(
			'name'               => __( 'Testimonials', 'cherry-testimonials' ),
			'singular_name'      => __( 'Testimonial', 'cherry-testimonials' ),
			'add_new'            => __( 'Add New', 'cherry-testimonials' ),
			'add_new_item'       => __( 'Add New Testimonial', 'cherry-testimonials' ),
			'edit_item'          => __( 'Edit Testimonial', 'cherry-testimonials' ),
			'new_item'           => __( 'New Testimonial', 'cherry-testimonials' ),
			'view_item'          => __( 'View Testimonial', 'cherry-testimonials' ),
			'search_items'       => __( 'Search Testimonials', 'cherry-testimonials' ),
			'not_found'          => __( 'No testimonials found', 'cherry-testimonials' ),
			'not_found_in_trash' => __( 'No testimonials found in trash', 'cherry-testimonials' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
			'cherry-grid-type',
			'cherry-layouts',
		);

		$args = array(
			'labels'              => $labels,
			'supports'            => $supports,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-testimonial',
			'can_export'          => true,
			'hierarchical'        => false,
			'has_archive'         => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'rewrite'             => array(
				'slug'       => 'testimonial-view',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			),
		);

		$args = apply_filters( 'cherry_testimonials_post_type_args', $args );

		register_post_type( CHERRY_TESTI_NAME, $args );
	}

	/**
	 * Register the Testimonial Category taxonomy.
	 *
	 * @since 1.0.0
	 * @link  https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public static function register_taxonomy() {
		$labels = array(
			'name'                       => __( 'Testimonial Categories', 'cherry-testimonials' ),
			'singular_name'              => __( 'Testimonial Category', 'cherry-testimonials' ),
			'menu_name'                  => __( 'Categories', 'cherry-testimonials' ),
			'search_items'               => __( 'Search Categories', 'cherry-testimonials' ),
			'popular_items'              => __( 'Popular Categories', 'cherry-testimonials' ),
			'all_items'                  => __( 'All Categories', 'cherry-testimonials' ),
			'edit_item'                  => __( 'Edit Category', 'cherry-testimonials' ),
			'update_item'                => __( 'Update Category', 'cherry-testimonials' ),
			'add_new_item'               => __( 'Add New Category', 'cherry-testimonials' ),
			'new_item_name'              => __( 'New Category Name', 'cherry-testimonials' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'separate_items_with_commas' => null,
			'add_or_remove_items'        => null,
			'choose_from_most_used'      => null,
			'not_found'                  => null,
		);

		$args = array(
			'public'                => true,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'show_tagcloud'         => true,
			'show_admin_column'     => true,
			'hierarchical'          => true,
			'query_var'             => true,
			'labels'                => $labels,
			'update_count_callback' => '_update_post_term_count',
			'rewrite'               => array(
				'slug'         => CHERRY_TESTI_NAME . '_category',
				'with_front'   => false,
				'hierarchical' => true,
			),
		);

		register_taxonomy( CHERRY_TESTI_NAME . '_category', CHERRY_TESTI_NAME, $args );
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

Cherry_Testimonials_Registration::get_instance();
