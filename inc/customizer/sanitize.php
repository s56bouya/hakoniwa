<?php
/**
 * サニタイズ関連
 *
 * @package    WordPress
 * @subpackage Nishiki Pro
 * @author     AnimaGate, Inc.
 * @link       https://support.animagate.com/product/wp-nishiki-pro/
 */

/**
 * テキスト(wp_filter_nohtml_kses)
 *
 * @param string $text 文字列
 * @return string
 */
function nishiki_pro_sanitize_text( $text ) {
	return sanitize_text_field( $text );
}

/**
 * テキストエリア Text Area(Allow HTML)
 *
 * @param string $text 文字列
 * @return string
 */
function nishiki_pro_sanitize_textarea( $text ) {
	$allowed_html = array(
		'a'      => array(
			'href'    => array(),
			'onclick' => array(),
			'target'  => array(),
		),
		'br'     => array(),
		'strong' => array(),
		'b'      => array(),
	);

	return wp_kses( $text, $allowed_html );
}

/**
 * シェアボタン出力
 *
 * @param string $text 文字列
 * @return void
 */
function nishiki_pro_sanitize_share_button( $text ) {
	$allowed_tags = wp_kses_allowed_html( 'post' );

	// 追加許可タグ
	$add_allowed_tags = array(
		'a' => array(
			'onclick' => true,
		),
	);

	$allowed_tags['a'] += $add_allowed_tags['a'];

	echo wp_kses( $text, $allowed_tags );
}

/**
 * Checkbox
 *
 * @param int $checked チェックボックスの値
 * @return boolean
 */
function nishiki_pro_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Select(Sidebar)
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices( $input ) {
	$valid = array( 'left', 'right', 'bottom', 'none' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'none';
}

/**
 * Header Layout
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_header_layout( $input ) {
	$valid = array( 'default', 'center' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'default';
}

/**
 * Campaign Layout
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_campaign_layout( $input ) {
	$valid = array( 'text-button', 'button-text' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'text-button';
}

/**
 * Columns
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_columns( $input ) {
	$valid = array( '1', '2', '3' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '3';
}

/**
 * Share Button
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_share( $input ) {
	$valid = array( 'top', 'bottom', 'both', 'none' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'none';
}

/**
 * Share Button Design Pattern
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_share_design_pattern( $input ) {
	$valid = array( '01', '02', '03' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'none';
}

/**
 * Footer nav
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_footer_nav_sticky( $input ) {
	$valid = array( 'sticky', 'mobile-sticky', 'none' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'none';
}

/**
 * TOC
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_toc_min_level( $input ) {
	$valid = array( '2', '3', '4', '5', '6' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 3;
}

/**
 * Item
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_item( $input ) {
	$valid = array( 'disabled', 'icon', 'image' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'disabled';
}

/**
 * Section
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_front_page_section( $input ) {
	$valid = array( 'disabled', 'recently', 'custom' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'disabled';
}

/**
 * Featured Items
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_front_page_featured_items( $input ) {
	$valid = array( 'disabled', 'enabled' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'disabled';
}

/**
 * Text Align
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_align( $input ) {
	$valid = array( 'left', 'center', 'right' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'center';
}

/**
 * Number
 *
 * @param int    $number 数値
 * @param object $setting 設定
 * @return int
 */
function nishiki_pro_sanitize_number( $number, $setting ) {
	$number = absint( $number );

	return ( $number ? $number : $setting->default );
}

/**
 * Number range
 *
 * @param int    $number 数値
 * @param object $setting 設定
 * @return int
 */
function nishiki_pro_sanitize_number_range( $number, $setting ) {
	$number = absint( $number );
	$atts   = ( isset( $setting->manager->get_control( $setting->id )->input_attrs ) ? $setting->manager->get_control( $setting->id )->input_attrs : array() );
	$min    = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	$max    = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	$step   = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/**
 * File uploader
 *
 * @param string $image ファイル名
 * @param object $setting 設定
 * @return string
 */
function nishiki_pro_sanitize_image( $image, $setting ) {
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
	);
	$file  = wp_check_filetype( $image, $mimes );
	return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Meta Catd Type
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_meta_cards_type( $input ) {
	$valid = array( 'summary', 'summary_large_image' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'summary';
}

/**
 * JSON-LD Type
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_meta_json_ld_type( $input ) {
	$valid = array( 'BlogPosting', 'Article' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'BlogPosting';
}

/**
 * Website Type
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_meta_json_ld_website_type( $input ) {
	$valid = array( '', 'Organization', 'Person' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '';
}

/**
 * JSON-LD(contactoption)
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_meta_json_ld_contactpoint_contactoption( $input ) {
	$valid = array( '', 'TollFree', 'HearingImpairedSupported' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '';
}

/**
 * JSON-LD(contactType)
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_meta_json_ld_contactpoint_contacttype( $input ) {
	$valid = array(
		'',
		'customer service',
		'technical support',
		'billing support',
		'bill payment',
		'sales',
		'reservations',
		'credit card_support',
		'emergency',
		'baggage tracking',
		'roadside assistance',
		'package tracking',
	);
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '';
}

/**
 * Heading choice
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_heading_type( $input ) {
	$valid = array(
		'simple',
		'underline',
		'baloon',
		'box',
		'stitch-box',
		'dot-box',
		'polka-dot-box',
		'stripe-box',
		'houndstooth-box',
		'jigsaw-puzzle-box',
		'graph-paper-box',
		'brick-wall-box',
		'sailor-anchor-box',
		'none',
	);
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '';
}

/**
 * Campaign choice
 *
 * @param string $input セレクトボックスの値
 * @return string
 */
function nishiki_pro_sanitize_choices_campaign_background_type( $input ) {
	$valid = array(
		'single-color',
		'dot',
		'polka-dot',
		'stripe',
		'check',
	);
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return '';
}

/**
 * Radio button
 *
 * @param string $input ラジオボタンの値
 * @return string
 */
function nishiki_pro_sanitize_radio( $input ) {
	return sanitize_key( $input );
}
