<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Infeedads {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_infeed_ads';
	}

	/**
	 * フォーム追加
	 */
	public function register_settings() {
		$create_form = new CreateForm;

		register_setting(
			$this->page_name(),
			$this->page_name(),
			array( $this, 'sanitize' )
		);

		add_settings_section(
			$this->page_name(),
			'',
			array( $create_form, 'nonce' ),
			$this->page_name()
		);

		add_settings_field(
			'display',
			__( '表示するページ', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'display',
				'page_name'   => $this->page_name(),
				'description' => 'インフィード広告を挿入したいページにチェックを入れてください。',
				'script'      => $this->archives(),
				'display_key' => true,
			)
		);

		add_settings_field(
			'number',
			__( '何番目の投稿の前に表示しますか？', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'number',
				'page_name'   => $this->page_name(),
				'description' => '数字を入れてください。カンマ区切りで複数指定（例：1,3,4）',
			)
		);

		add_settings_field(
			'code',
			__( 'コードを入力', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'code',
				'page_name'   => $this->page_name(),
				'description' => 'HTML/CSS/JavaScript に対応しています。',
				'priority'    => false,
			)
		);
	}

	/**
	 * タクソノミーの配列取得
	 */
	public function taxonomy_archives() {
		$args       = array(
			'public' => true,
		);
		$output     = 'objects';
		$operator   = 'and';
		$taxonomies = get_taxonomies( $args, $output, $operator );

		$tax_array = array();

		foreach ( $taxonomies as $taxonomy ) {
			if ( 'post_format' !== $taxonomy->name ) {
				$tax_array[ $taxonomy->name ] = $taxonomy->label;
			}
		}

		return $tax_array;
	}

	/**
	 * 投稿タイプのアーカイブページ
	 */
	public function post_type_archives() {
		$args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$output   = 'objects';
		$operator = 'and';

		$post_types = get_post_types( $args, $output, $operator );

		$post_types_array = array();

		foreach ( $post_types as $post_type ) {
			$post_types_array[ $post_type->name ] = $post_type->label;
		}

		return $post_types_array;
	}

	/**
	 * その他のアーカイブページ
	 */
	public function other_archives() {
		$archive_array = array(
			'top'    => 'トップページの最新の投稿',
			'author' => '著者',
			'paged'  => '複数ページ',
			'year'   => '年',
			'month'  => '月',
			'day'    => '日',
			'search' => '検索',
		);

		return $archive_array;
	}

	/**
	 * アーカイブページの配列
	 */
	public function archives() {
		$taxonomy_archives  = $this->taxonomy_archives();
		$post_type_archives = $this->post_type_archives();
		$other_archives     = $this->other_archives();

		$archives = array_merge( $taxonomy_archives, $post_type_archives );
		$archives = array_merge( $other_archives, $archives );

		return $archives;
	}

	/**
	 * 入力値のサニタイズ
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

		// チェックボックス absint
		// テキスト stripslashes
		// 配列 array_map

		if ( isset( $input['number'] ) ) {

			// 配列に変換できたら更新
			$convert_array = explode( ',', $input['number'] );

			if ( is_array( $convert_array ) ) {
				$new_input['number'] = stripslashes( $input['number'] );
			}
		}

		if ( isset( $input['code'] ) ) {
			$new_input['code'] = stripslashes( $input['code'] );
		}

		if ( isset( $input['display'] ) ) {
			$new_input['display'] = array_map( 'strip_tags', $input['display'] );
		}

		// wp_die(var_dump($new_input));
		return $new_input;
	}
}

use toolpack\options;
new Infeedads();
