<?php
namespace toolpack\options;

use toolpack\init\Define;

use fse\theme\util\CreateForm;

class Multiplesearch {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// クエリー追加
		add_filter( 'query_vars', [ $this, 'add_query_vars_filter' ], 20 );

		// 検索結果に条件追加
		add_action( 'posts_join', array( $this, 'posts_join' ), 20, 2 );
		add_action( 'posts_where', array( $this, 'posts_where' ), 20, 2 );
		add_action( 'posts_groupby', array( $this, 'posts_groupby' ), 20, 2 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_multiple_search';
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

		$taxonomies = $this->get_taxonomies();

		foreach ( $taxonomies as $taxonomy ) {
			$taxonomy_labels = get_taxonomy_labels( get_taxonomy( $taxonomy ) );
			$taxonomy_name   = $taxonomy_labels->singular_name;

			add_settings_field(
				'taxonomy_' . $taxonomy,
				$taxonomy_name . '(' . $taxonomy . ')',
				array( $create_form, 'multiple_search' ),
				$this->page_name(),
				$this->page_name(),
				array(
					'title'       => $taxonomy,
					'label'       => 'multiple_search',
					'page_name'   => $this->page_name(),
					'description' => '',
					'taxonomy'    => $taxonomy,
				)
			);
		}

		add_settings_field(
			'multiple_search_display_count',
			__( '項目の隣に投稿数を表示する', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '表示しない',
				'label'       => 'multiple_search_display_count',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'multiple_search_result',
			__( '検索結果ページに絞り込み検索を表示する', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '表示する',
				'label'       => 'multiple_search_result',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);
	}

	/**
	 * クエリー追加
	 *
	 * @param array $vars 配列
	 * @return $vars
	 */
	public function add_query_vars_filter( $vars ) {
		$taxonomies = $this->get_taxonomies();

		foreach ( $taxonomies as $var ) {
			$vars[] = $var;
		}

		$vars[] = 'term_id';
		$vars[] = 'relation';

		return $vars;
	}

	/**
	 * 検索結果フィルター
	 *
	 * @param [type] $query クエリー
	 * @return void
	 */
	public function search_filter( $query ) {
		if ( ! is_admin() && $query->is_search ) {
			if ( ! empty( get_query_var( 'relation' ) ) ) {
				$taxonomies = $this->get_taxonomies();

				if ( $taxonomies ) {

					$tax_array['relation'] = get_query_var( 'relation' );

					foreach ( $taxonomies as $taxonomy ) {

						if ( ! empty( get_query_var( $taxonomy ) ) ) {
							foreach ( get_query_var( $taxonomy ) as $term ) {
								$tax_array[] = array(
									'taxonomy' => $taxonomy,
									'field'    => 'term_taxonomy_id',
									'terms'    => $term,
									'operator' => 'IN',
								);
							}
						}
					}
				}

				/*
				$tax_array1 = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'term_taxonomy_id',
						'terms' => array( 3, 5 ),
						'operator' => 'IN',
					),
					array(
						'taxonomy' => 'post_tag',
						'field' => 'term_taxonomy_id',
						'terms' => array( 6 ),
						'operator' => 'IN',
					),
				);
				*/

				// $query->set( 'tax_query', $tax_array );

			}
		}
	}

	/**
	 * Add Join
	 *
	 * @param string    $join 追加文字列
	 * @param \WP_Query $q クエリー
	 * @return $join
	 */
	public function posts_join( $join, \WP_Query $q ) {

		if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
			global $wpdb,$wp_query;

			$query = $wp_query->query;

			$keyword  = ( ! empty( $query['s'] ) ) ? $query['s'] : '';
			$relation = ( ! empty( $query['relation'] ) ) ? $query['relation'] : 'OR';

			unset( $query['s'], $query['page'], $query['relation'] );

			// var_dump($query);

			if ( empty( $query['term_id'] ) ) {
				return $join;
			}

			// クエリーに存在しているタクソノミーの分だけループ
			foreach ( $query['term_id'] as $key => $term_id ) {

				if ( 'AND' === $relation ) {
					// 一つだけ選択されている場合
					if ( 0 === $key ) {
						$join .= "LEFT JOIN {$wpdb->term_relationships} ON ( {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ) ";
					} else {
						// 複数の場合
						$join .= "LEFT JOIN {$wpdb->term_relationships} AS tt{$key} ON ( {$wpdb->posts}.ID = tt{$key}.object_id ) ";
					}
				} else {
					if ( 0 === $key ) {
						$join .= "LEFT JOIN {$wpdb->term_relationships} ON ( {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ) ";
					}
				}
			}
		}

		return $join;
	}

	/**
	 * Add Where
	 *
	 * @param string    $where 文字列
	 * @param \WP_Query $q クエリー
	 * @return $where
	 */
	public function posts_where( $where, \WP_Query $q ) {
		if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
			global $wpdb,$wp_query;

			$query = $wp_query->query;

			if ( empty( $query['term_id'] ) ) {
				return $where; }

			$sub_where = '';
			$relation  = ( ! empty( $query['relation'] ) ) ? $query['relation'] : 'OR';

			// クエリーに存在しているタクソノミーの分だけループ
			foreach ( $query['term_id'] as $key => $term_id ) {
				// term_id の先祖関係を全部取得する
				$search_term_id = implode( ',', $this->get_term_children( $term_id ) );

				if ( 'AND' === $relation ) {
					if ( 0 === $key ) {
						$sub_where .= " {$wpdb->term_relationships}.term_taxonomy_id IN ({$search_term_id}) ";
					} else {
						$sub_where .= " {$relation} tt{$key}.term_taxonomy_id IN ({$search_term_id}) ";
					}
				} else {
					if ( 0 === $key ) {
						$sub_where .= " {$wpdb->term_relationships}.term_taxonomy_id IN ({$search_term_id}) ";
					} else {
						$sub_where .= " {$relation} {$wpdb->term_relationships}.term_taxonomy_id IN ({$search_term_id}) ";
					}
				}
			}

			$where .= ' AND (' . $sub_where . ')';
		}

		return $where;
	}

	/**
	 * Add Groupby
	 *
	 * @param string    $groupby 文字列
	 * @param \WP_Query $q クエリー
	 * @return $groupby
	 */
	public function posts_groupby( $groupby, \WP_Query $q ) {
		global $wpdb,$wp_query;
		if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
			$query = $wp_query->query;

			if ( empty( $query['term_id'] ) ) {
				return $groupby; }

			$relation = ( ! empty( $query['relation'] ) ) ? $query['relation'] : 'OR';

			if ( 'OR' === $relation ) {
				$groupby .= " {$wpdb->posts}.ID";
			} else {
				return $groupby;
			}
		}

		return $groupby;
	}

	/**
	 * 子ターム取得
	 *
	 * @param int $term_id ターム ID
	 * @return $term_array
	 */
	public function get_term_children( $term_id ) {
		$all_taxonomies = $this->get_taxonomies();

		$term_array = array( absint( $term_id ) );

		foreach ( $all_taxonomies as $taxonomy ) {

			$termchildren = get_term_children( $term_id, $taxonomy );

			if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
				$term_array = array_merge( $term_array, $termchildren );
			}
		}

		sort( $term_array );

		return $term_array;
	}

	/**
	 * カスタムタクソノミー全部取得
	 *
	 * @return $result
	 */
	public function get_taxonomies() {
		$builtin_taxonomy = array(
			'category',
			'post_tag',
		);
		$args             = array(
			'public'   => true,
			'_builtin' => false,

		);
		$output     = 'names'; // or objects
		$operator   = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator );

		$result = array_merge( $builtin_taxonomy, $taxonomies );

		return $result;
	}

	/**
	 * 入力値のサニタイズ
	 *
	 * @param array $input 入力値
	 * @return $new_input
	 */
	public function sanitize( $input ) {
		$new_input = array();

		$taxonomies = $this->get_taxonomies();

		foreach ( $taxonomies as $taxonomy ) {
			if( ! empty( $input[ $taxonomy ]['display'] ) ){
				$new_input[ $taxonomy ]['display'] = absint( $input[ $taxonomy ]['display'] );
			}

			if( ! empty( $input[ $taxonomy ]['label'] ) ){
				$new_input[ $taxonomy ]['label']   = sanitize_text_field( $input[ $taxonomy ]['label'] );
			}

			if( ! empty( $input[ $taxonomy ]['terms'] ) ){
				$new_input[ $taxonomy ]['terms']   = array_map( 'absint', $input[ $taxonomy ]['terms'] );
			}
		}

		if ( ! empty( $input['multiple_search_result'] ) ) {
			$new_input['multiple_search_result'] = absint( $input['multiple_search_result'] );
		}

		if ( ! empty( $input['multiple_search_display_count'] ) ) {
			$new_input['multiple_search_display_count'] = absint( $input['multiple_search_display_count'] );
		}

		return $new_input;
	}
}

use toolpack\options;
new Multiplesearch();
