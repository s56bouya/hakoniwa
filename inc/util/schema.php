<?php
namespace hakoniwa\theme\util;

use hakoniwa\theme\init\Define;

class Schema {

	/**
	 * JSON-LD 作成
	 *
	 */
	public static function output( $property, $content ) {
		
	}

	/**
	 * Website
	 */
	public static function website( $options ) {

		$data_website = array(
			'@context' => 'http://schema.org',
			'@type'    => 'WebSite',
			'@id'      => '#website',
			'url'      => get_home_url(),
			'name'     => get_bloginfo( 'name' ),
		);

		if ( isset( $options['display_info']['search'] ) && 1 === $options['display_info']['search'] ) {
			$data_website[ 'potentialAction' ] = self::search_action();
		}

		return $data_website;

	}

	/**
	 * Search Action
	 */
	private static function search_action() {

		$data = array(
			'@type'       => 'SearchAction',
			'target'      => get_home_url() . '?s={search_term_string}',
			'query-input' => 'required name=search_term_string',
		);

		return $data;
	}

	/**
	 * Website Type
	 */
	private static function website_type( $options ) {

		if ( empty( $options['display_info']['website_type'] ) ) {
			return false;
		}

		$type = '';
		$id   = '';
		$name = '';
		$logo = '';

		$website_type = isset( $options['website_type'] ) ? $options['website_type'] : '';

		if ( 'Organization' === $website_type ) {
			$type = 'Organization';
			$id   = '#organization';
			$name = $options['organization_name'];
			$logo = $options['organization_logo_image'];

		} elseif ( 'Person' === $website_type ) {
			$type = 'Person';
			$id   = '#person';
			$name = $options['person_name'];
		}

		$data_website_type = array(
			'@context' => 'http://schema.org',
			'@type'    => $type,
			'@id'      => $id,
			'name'     => $name,
			'url'      => get_permalink(),
			'sameAs'   => self::sameAs( $options ),
		);

		if ( ! empty( $logo ) ) {
			$data_website_type['logo'] = $logo;
		}

		if ( isset( $options['display_info']['address'] ) ) {
			self::address( $options );
		}

		if ( isset( $options['display_info']['contactpoint'] ) ) {
			self::contactpoint( $options );
		}

		return $data_website_type;
	}

	/**
	 * Adderss.
	 */
	private static function address( $options ) {

		$data_website_type['address'] = array(
			'@type' => 'PostalAddress',
		);

		$addresslocality = $options['address_addresslocality'];
		if ( ! empty( $addresslocality ) ) {
			$data_website_type['address']['addresslocality'] = $addresslocality;
		}

		$postalcode = $options['address_postalcode'];
		if ( ! empty( $postalcode ) ) {
			$data_website_type['address']['postalCode'] = $postalcode;
		}

		$addressregion = $options['address_addressregion'];
		if ( ! empty( $addressregion ) ) {
			$data_website_type['address']['addressRegion'] = $addressregion;
		}

		$streetaddress = $options['address_streetaddress'];
		if ( ! empty( $streetaddress ) ) {
			$data_website_type['address']['streetAddress'] = $streetaddress;
		}

		return $data_website_type;
	}

	/**
	 * ContactPoint.
	 *
	 * @link contactType and contactOption https://developers.google.com/search/docs/data-types/corporate-contact
	 */
	private static function contactpoint( $options ) {
		$data_website_type['contactPoint'] = array(
			'@type' => 'ContactPoint',
		);

		$telephone = $options['contactpoint_telephone'];
		if ( ! empty( $telephone ) ) {
			$data_website_type['contactPoint']['telephone'] = $telephone;
		}

		$contacttype = $options['contactpoint_contacttype'];
		if ( ! empty( $contacttype ) ) {
			$data_website_type['contactPoint']['contactType'] = $contacttype;
		}

		$contactoption = $options['contactpoint_contactoption'];
		if ( ! empty( $contactoption ) ) {
			$data_website_type['contactPoint']['contactOption'] = $contactoption;
		}

		$areaserved = $options['contactpoint_areaserved'];
		if ( ! empty( $areaserved ) ) {
			$data_website_type['contactPoint']['areaServed'] = $areaserved;
		}

		return $data_website_type;
	}

	/**
	 * Social account.
	 *
	 * @link https://developers.google.com/search/docs/data-types/social-profile
	 */
	private static function sameAs( $options ) {
		//schema.org 代表のソーシャルアカウントのURLを表示する
		$sameas_array = array();

		$sameas = array(
			'twitter',
			'facebook',
			'instagram',
			'youTube',
			'pinterest',
		);

		foreach ( $sameas as $data ) {
			if( ! empty( $options[$data] ) ){
				$sameas_array[] = $options[$data];
			}
		}

		return $sameas_array;
	}

	/**
	 * Post type.
	 *
	 * @link https://developers.google.com/search/docs/data-types/article
	 */
	public static function post_type( $options ) {
		$logo_url       = '';
		$logo_width     = '';
		$logo_height    = '';
		$publisher_name = '';

		if ( has_post_thumbnail( get_the_ID() ) ) {
			$image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
			$image_url    = $image_data[0];
			$image_width  = $image_data[1];
			$image_height = $image_data[2];
		} else {
			$image_url = $options['default_image'];
			if ( ! empty( $image_url ) ) {
				$image_id     = attachment_url_to_postid( $image_url );
				$image_data   = wp_get_attachment_image_src( $image_id, 'large' );
				$image_width  = ! empty( $image_data[1] ) ? $image_data[1] : '';
				$image_height = ! empty( $image_data[2] ) ? $image_data[2] : '';
			} else {
				$image_url    = '';
				$image_width  = '';
				$image_height = '';
			}
		}

		if ( $options['article_logo_image'] ) {
			$logo_data = wp_get_attachment_image_src( $options['article_logo_image'], 'full' );

			if ( isset( $logo_data[1] ) ) {
				$logo_width = $logo_data[1];
			}

			if ( isset( $logo_data[2] ) ) {
				$logo_height = $logo_data[2];
			}
		}

		if ( $options['organization_name'] ) {
			$publisher_name = $options['organization_name'];
		}

		$args = array(
			'type'            => $options['page_type'],
			'pub_date'        => get_the_date( 'c' ),
			'modify_date'     => get_the_modified_date( 'c' ),
			'title'           => get_the_title(),
			'id'              => esc_url( get_permalink() ),
			'site_name'       => get_bloginfo( 'name' ),
			'image_url'       => $image_url,
			'image_width'     => $image_width,
			'image_height'    => $image_height,
			'author_type'     => 'person',
			'author_name'     => get_the_author_meta( 'display_name' ),
			'publisher_type'  => 'Organization',
			'publisher_name'  => $publisher_name,
			'logo_url'        => $logo_url,
			'logo_url_width'  => $logo_width,
			'logo_url_height' => $logo_height,
		);

		$data_post_type = array(
			'@context'      => 'http://schema.org',
			'@type'         => $args['type'],
			'headline'      => $args['title'],
			'datePublished' => $args['pub_date'],
			'dateModified'  => $args['modify_date'],
		);

		$data_post_type['mainEntityOfPage'] = array(
			'@type' => 'WebPage',
			'@id'   => $args['id'],
		);

		if ( ! empty( $image_url ) ) {
			$data_post_type['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => $args['image_url'],
				'width'  => $args['image_width'],
				'height' => $args['image_height'],
			);
		}

		$data_post_type['author'] = array(
			'@type' => $args['author_type'],
			'name'  => $args['author_name'],
		);

		$data_post_type['publisher'] = array(
			'@type' => $args['publisher_type'],
			'name'  => $args['publisher_name'],
		);

		if ( ! empty( $logo_url ) ) {
			$data_post_type['publisher']['logo'] = array(
				'@type'  => 'ImageObject',
				'url'    => $logo_url,
				'width'  => $logo_width,
				'height' => $logo_height,
			);
		}

		return $data_post_type;
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

		//var_dump($options);

		$website      = self::website( $options );
		$website_type = self::website_type( $options );
		$post_type    = self::post_type( $options );

		/**
		 * Create JSON-LD Website
		 */
		if ( isset( $options['display_info']['website'] ) && ( is_home() || is_front_page() ) ) {
			if ( is_array( $website ) && ! empty( $website ) ) {
				echo "<script type='application/ld+json'>", wp_json_encode( $website ), '</script>', "\n";
			}
		}

		/**
		 * Create JSON-LD Post Type
		 */
		if ( isset( $options['post_type'] ) ) {
			if ( ! is_front_page() && ! is_home() && is_singular() && array_key_exists( get_post_type(), $options['post_type'] ) ) {
				if ( is_array( $post_type ) && ! empty( $post_type ) ) {
					echo "<script type='application/ld+json'>", wp_json_encode( $post_type ), '</script>', "\n";
				}
			}
		}

		/**
		 * Create JSON-LD Website type
		 */
		if ( isset( $options['website_type'] ) && ( is_home() || is_front_page() ) ) {
			if ( is_array( $website_type ) && ! empty( $website_type ) ) {
				echo "<script type='application/ld+json'>", wp_json_encode( $website_type ), '</script>', "\n";
			}
		}

	}

}
