<?php
/**
 * Define callback functions for templater.
 *
 * @package   Cherry_Team
 * @author    Cherry Team
 * @license   GPL-2.0+
 * @link      http://www.cherryframework.com/
 * @copyright 2015 Cherry Team
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Callbacks for testimonial shortcode templater.
 *
 * @since 1.0.2
 */
class Cherry_Testimonials_Template_Callbacks {

	/**
	 * Shortcode attributes array
	 * @var array
	 */
	public $atts = array();

	/**
	 * Current post team-related meta
	 * @var array
	 */
	public static $post_meta = array();

	function __construct( $atts ) {
		$this->atts = $atts;
	}

	/**
	 * Get post thumbnail.
	 *
	 * @since 1.0.2
	 */
	public function get_avatar() {
		global $post;

		if ( isset( $this->atts['display_avatar'] ) && false === $this->atts['display_avatar'] ) {
			return;
		}

		return ( isset( $post->image ) && $post->image ) ? $post->image  : '';
	}

	/**
	 * Get post content.
	 *
	 * @since 1.0.2
	 */
	public function get_content() {
		global $post;

		$_content = apply_filters( 'cherry_testimonials_content', get_the_content( '' ), $post );

		if ( ! $_content ) {
			return;
		}

		$content_type   = sanitize_key( $this->atts['content_type'] );
		$content_length = absint( $this->atts['content_length'] );

		if ( 'full' == $content_type || post_password_required() ) {
			$content = apply_filters( 'the_content', $_content );
		} else {
			/* wp_trim_excerpt analog */
			$content = strip_shortcodes( $_content );
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
			$content = wp_trim_words( $content, $content_length, apply_filters( 'cherry_testimonials_content_more', '', $this->atts, Cherry_Testimonials_Shortcode::$name ) );
		}

		return $content;
	}

	/**
	 * Get testimonial's author.
	 *
	 * @since 1.0.2
	 */
	public function get_author() {
		global $post;

		if ( isset( $this->atts['display_author'] ) && false === $this->atts['display_author'] ) {
			return;
		}

		$post_id   = $post->ID;
		$post_meta = ( isset( $post->{CHERRY_TESTI_POSTMETA} ) ) ? $post->{CHERRY_TESTI_POSTMETA} : false;
		$name      = ( isset( $post_meta['name'] ) && ( !empty( $post_meta['name'] ) ) ) ? $post_meta['name'] : get_the_title( $post_id );
		$url       = $this->get_url();
		$email     = ( isset( $post_meta['email'] ) ) ? $post_meta['email'] : '';

		$author = '<footer><cite class="author" title="' . esc_attr( $name ) . '">';
		if ( !empty( $url ) ) {
			$author .= '<a href="' . esc_url( $url ) . '">' . $name . '</a>';
		} else {
			$author .= $name;
		}
		$author .= '</cite></footer>';

		return $author;
	}

	/**
	 * Get testimonial's email.
	 *
	 * @since 1.0.2
	 */
	public function get_email() {
		global $post;

		$post_meta = ( isset( $post->{CHERRY_TESTI_POSTMETA} ) ) ? $post->{CHERRY_TESTI_POSTMETA} : false;

		if ( false === $post_meta ) {
			return;
		}

		if ( empty( $post_meta['email'] ) ) {
			return;
		}

		$email = '<a href="mailto:' . antispambot( $post_meta['email'], 1 ) .'" class="testimonials-item_email">' . antispambot( $post_meta['email'] ) .'</a>';

		return $email;
	}

	/**
	 * Get testimonial's name.
	 *
	 * @since 1.0.2
	 */
	public function get_name() {
		global $post;

		$post_meta = ( isset( $post->{CHERRY_TESTI_POSTMETA} ) ) ? $post->{CHERRY_TESTI_POSTMETA} : false;

		if ( false === $post_meta ) {
			return;
		}

		if ( empty( $post_meta['name'] ) ) {
			return;
		}

		return $post_meta['name'];
	}

	/**
	 * Get testimonial's url.
	 *
	 * @since 1.0.2
	 */
	public function get_url() {
		global $post;

		$post_meta = ( isset( $post->{CHERRY_TESTI_POSTMETA} ) ) ? $post->{CHERRY_TESTI_POSTMETA} : false;

		if ( false === $post_meta ) {
			return;
		}

		if ( empty( $post_meta['url'] ) ) {
			return;
		}

		return $post_meta['url'];
	}

}