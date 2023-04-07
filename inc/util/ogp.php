<?php
namespace fse\theme\util;

use fse\theme\init\Define;
use fse\theme\util\Functions;

class OGP {

	/**
	 * OGP 作成
	 *
	 */
	public static function output( $property, $content ) {
		$og_property = str_replace( ':', '_', $property );

		$content = apply_filters( Define::value( 'theme_name' ) . '_ogp_' . $og_property, $content );
		if ( empty( $content ) ) {
			return false;
		}

		echo '<meta property="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '" />' . "\n";

		return true;
	}

	/**
	 * OGP 作成
	 *
	 */
	public static function create( $page_name ) {
		$options = get_option( $page_name );

		if ( empty( $options ) ) {
			return false;
		}

		if ( ! isset( $options['active'] ) ) {
			return false;
		}

		if ( ! array_key_exists( 'ogp', $options['active'] ) ) {
			return false;
		}

		global $post;

		$image_width  = '';
		$image_height = '';
		$section      = '';
		$tags_name    = array();

		if ( is_singular() && ! Functions::is_static_front_page() ) {
			$singular_title = get_post_meta( $post->ID, '_' . Define::value( 'theme_name' ) . '_meta_box_title_' . get_post_type(), true );
			if ( $singular_title ) {
				$og_title = $singular_title;
			} else {
				$og_title = get_the_title();
			}
			$title = apply_filters( Define::value( 'theme_name' ) . '_ogp_title', esc_html( $og_title ) );
			setup_postdata( $post );
			$excerpt = get_the_excerpt();
			$link    = esc_url( get_permalink() );
			$type    = 'article';

			if ( has_post_thumbnail( $post->ID ) ) {
				$images       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$image_url    = $images[0];
				$image_width  = $images[1];
				$image_height = $images[2];
			} else {
				$image_id = apply_filters( Define::value( 'theme_name' ) . '_ogp_image', $options['og_image'] );
			}
		} else {
			$title   = apply_filters( Define::value( 'theme_name' ) . '_ogp_title', get_bloginfo( 'name' ) );
			$excerpt = apply_filters( Define::value( 'theme_name' ) . '_ogp_description', get_bloginfo( 'description' ) );
			// $link = '//' . getenv( 'HTTP_HOST' ) . getenv( 'REQUEST_URI' );
			global $wp;
			$link      = home_url( $wp->request );
			$image_id = apply_filters( Define::value( 'theme_name' ) . '_ogp_image', $options['og_image'] );
			$type      = 'website';
		}

		if( isset( $image_id ) ){
			$images       = wp_get_attachment_image_src( $image_id, 'full' );
			$image_url    = $images[0];
			$image_width  = $images[1];
			$image_height = $images[2];
		}

		self::output( 'og:type', $type );
		self::output( 'og:title', $title );
		self::output( 'og:description', $excerpt );
		self::output( 'og:url', $link );
		self::output( 'og:site_name', get_bloginfo( 'name' ) );
		self::output( 'og:image', $image_url );
		self::output( 'og:image:width', $image_width );
		self::output( 'og:image:height', $image_height );

		if ( is_singular() && ! is_front_page() ) {
			self::output( 'og:updated_time', get_the_modified_date( DATE_W3C ) );
			self::output( 'article:published_time', get_the_date( DATE_W3C ) );
			self::output( 'article:modified_time', get_the_modified_date( DATE_W3C ) );
			self::output( 'article:author', get_the_author_meta( Define::value( 'theme_name' ) . '_user_profile_facebook' ) );
			//self::og( 'article:publisher', get_the_author_meta( Define::value( 'theme_name' ) . '_user_profile_facebook_page' ) );
			self::output( 'article:publisher', $options['facebook_article_publisher'] );

			$terms = get_the_category();

			if ( ! is_wp_error( $terms ) && ( is_array( $terms ) && array() !== $terms ) ) {
				self::output( 'article:section', $terms[0]->name );
			}

			$tags = get_the_tags();

			if ( ! is_wp_error( $tags ) && ( is_array( $tags ) && array() !== $tags ) ) {
				foreach ( $tags as $tag ) {
					self::output( 'article:tag', $tag->name );
				}
			}
		}

	}

}
