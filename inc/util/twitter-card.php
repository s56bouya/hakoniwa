<?php
namespace fse\theme\util;

use fse\theme\init\Define;

class TwitterCard {

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

		if ( 'twitter:creator' === $property || 'twitter:site' === $property ) {
			preg_match( '/twitter\.com\/(\w+)/', $content, $match );

			if( $match ){
				$content = '@' . $match[1];
			} else {
				$content = '';
			}

		}

		echo '<meta name="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '" />' . "\n";

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

		if ( ! array_key_exists( 'twitter', $options['active'] ) ) {
			return false;
		}

//		delete_option($page_name);
//		var_dump($options);

		global $post;

		if ( is_singular() ) {
			if ( is_front_page() ) {
				$title = apply_filters( Define::value( 'theme_name' ) . '_ogp_twitter_title', get_bloginfo( 'name' ) );
			} else {
				$singular_title = get_post_meta( $post->ID, '_nishiki_pro_meta_box_title_' . get_post_type(), true );
				if ( $singular_title ) {
					$og_title = $singular_title;
				} else {
					$og_title = get_the_title();
				}
				$title = apply_filters( Define::value( 'theme_name' ) . '_ogp_twitter_title', esc_html( $og_title ) );
			}

			if ( Functions::is_custom_post_type() ) {
				$post_object = get_post( $post->ID );

				if ( post_type_supports( get_post_type(), 'excerpt' ) ) {
					$excerpt = get_the_excerpt();
				} else {
					$get_content = apply_filters( 'the_content', $post_object->post_content );
					$excerpt     = wp_trim_words( $get_content, 60, '...' );
				}
			} else {
				setup_postdata( $post );
				$excerpt = get_the_excerpt();
			}

			$link = esc_url( get_permalink() );

			if ( has_post_thumbnail( $post->ID ) ) {
				$images    = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$image_url = $images[0];
			} else {
				$image_url = apply_filters( Define::value( 'theme_name' ) . '_ogp_twitter_image', $options['og_image'] );
			}
		} else {
			$title = apply_filters( Define::value( 'theme_name' ) . '_ogp_twitter_title', get_bloginfo( 'name' ) );

			$excerpt   = get_bloginfo( 'description' );
			$link      = '//' . getenv( 'HTTP_HOST' ) . getenv( 'REQUEST_URI' );
			$image_url = apply_filters( Define::value( 'theme_name' ) . '_ogp_twitter_image', $options['og_image'] );
		}

		self::output( 'twitter:card', $options['twitter_card_type'] );
		// self::output( 'twitter:domain', getenv( 'HTTP_HOST' ) );
		self::output( 'twitter:site', $options['twitter_card_site'] );
		self::output( 'twitter:creator', get_the_author_meta( Define::value( 'theme_name' ) . '_user_profile_twitter' ) );
		self::output( 'twitter:url', $link );
		self::output( 'twitter:title', $title );
		self::output( 'twitter:description', $excerpt );
		self::output( 'twitter:image', $image_url );

	}

}
