<?php
namespace hakoniwa\theme\util;

use hakoniwa\theme\init\Define;

class CreateForm {

	static function nonce() {
		$nonce = wp_create_nonce( Define::value( 'theme_name' ) );
		echo '<input type="hidden" name="' . esc_attr( Define::value( 'theme_name' ) ) . '" value="' . esc_attr( $nonce ) . '" />';
	}

	/**
	 * フォーム作成（チェックボックス一つ）
	 *
	 * @param string $title タイトル
	 * @param string $label ラベル
	 * @param string $page_name ページ名
	 * @return void
	 */
	static function checkbox( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options    = get_option( $page_name );

			if ( isset( $args['label'] ) ) {
				$label_name = $page_name . '_' . $args['label'];
			}	
		}		

		if ( isset( $options[ $args['label'] ] ) ) {
			$checked = ' checked="checked"';
		} else {
			$checked = '';
		}

		echo '<p><input type="checkbox" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $args['label'] ) . ']" value="1"' . esc_attr( $checked ) . '><label for="' . esc_attr( $label_name ) . '">' . esc_html( $args['title'] ) . '</label></p>';

		if ( isset( $args['description'] ) ) {
			echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
		}
	}

	/**
	 * フォーム作成（チェックボックス複数）
	 *
	 * @param string $title タイトル
	 * @param string $label ラベル
	 * @param string $page_name ページ名
	 * @param string $script スクリプト
	 * @param string $display_key キー
	 * @return void
	 */
	static function checkbox_multiple( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		$title = isset( $args['title'] ) ? $args['title'] : '';
		$script = isset( $args['script'] ) ? $args['script'] : '';
		$display_key = isset( $args['display_key'] ) ? $args['display_key'] : '';
		$default = isset( $args['script']['default'] ) ? $args['script']['default'] : '';

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		// 選択肢出力（データがあればチェック）
		if ( ! empty( $args['script']['data'] ) ) {
			echo '<ul>';
			foreach ( $args['script']['data'] as $key => $name ) {
				$checked = '';

				if ( isset( $options[ $args['label'] ][ $key ] ) ) {
					if ( array_key_exists( $key, $options[ $args['label'] ] ) ) {
						$checked = ' checked="checked"';
					}
				}

				if ( true === $args['display_key'] ) {
					$key_name = ' (' . esc_html( $key ) . ')';
				} else {
					$key_name = '';
				}

				$label_name = $args['page_name'] . '_' . $args['label'] . '_' . $key;

				echo '<li><input type="checkbox" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $args['label'] ) . '][' . esc_attr( $key ) . ']" value="1"' . esc_attr( $checked ) . '><label for="' . esc_attr( $label_name ) . '">' . esc_html( $name . $key_name ) . '</label></li>';
			}
			echo '</ul>';
		}

	}

	/**
	 * フォーム作成（テキスト）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function text( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		$title       = ! empty( $args['title'] ) ? $args['title'] : '';
		$description = ! empty( $args['description'] ) ? $args['description'] : '';
		$placeholder = ! empty( $args['placeholder'] ) ? $args['placeholder'] : '';

		$label      = ! empty( $args['label'] ) ? $args['label'] : '';
		$label_name = $args['page_name'] . '_' . $args['label'];
		$label_class = ! empty( $args['label_class'] ) ? ' class="' . $args['label_class'] . '"' : '';

		if ( isset( $options[ $label ] ) ) {
			$data = $options[ $label ];
		} else {
			$data = '';
		}
		

		if ( ! empty( $title ) ) {
			echo '<h4><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title ) . '</label></h4>';
		}
		echo '<p' . $label_class . '><input class="regular-text" placeholder="' . esc_attr( $placeholder ) . '" type="text" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $label ) . ']" value="' . esc_attr( $data ) . '" /></p>';

		if ( isset( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（テキストエリア）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function textarea( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		$data = '';

		$title       = ! empty( $args['title'] ) ? $args['title'] : '';
		$description = ! empty( $args['description'] ) ? $args['description'] : '';

		$priority_name = $args['label'] . '_priority';
		$priority      = ( ! empty( $options[ $priority_name ] ) && true === $args['priority'] ) ? $options[ $priority_name ] : 10;

		$label      = ! empty( $args['label'] ) ? $args['label'] : '';
		$label_name = $args['page_name'] . '_' . $args['label'];

		$page_name = $args['page_name'];

		if ( ! empty( $label ) ) {
			$data = ( ! empty( $options[ $args['label'] ] ) ) ? $options[ $args['label'] ] : '';
		}

		if ( ! empty( $title ) ) {
			echo '<h4><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title ) . '</label></h4>';
		}

		echo '<p><textarea rows="10" cols="10" class="large-text code" id="' . esc_attr( $label ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $label ) . ']" value="' . esc_attr( $data ) . '" />' . esc_textarea( $data ) . '</textarea></p>';

		if ( ! empty( $args['priority'] ) && true === $args['priority'] ) {
			echo '<input type="number" name="' . esc_attr( $page_name ) . '[' . esc_attr( $priority_name ) . ']" value="' . absint( $priority ) . '">';
		}

		if ( ! empty( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（ラジオボタン）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function radio_button( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		// データがない場合、初期値設定
		if ( ! isset( $options[ $args['label'] ] ) ) {
			$options[ $args['label'] ] = $args['script']['default'];
		}

		if ( ! empty( $args['script'] ) ) {
			echo '<ul>';
			foreach ( $args['script']['data'] as $key => $title ) {
				$checked = '';

				if ( $options[ $args['label'] ] === $key ) {
					$checked = ' checked="checked"';
				}

				if ( true === $args['display_key'] ) {
					$key_name = ' (' . esc_html( $key ) . ')';
				} else {
					$key_name = '';
				}

				$label_name = $args['page_name'] . '_' . $args['label'] . '_' . $key;

				echo '<li><input type="radio" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $args['page_name'] ) . '[' . esc_attr( $args['label'] ) . ']" value="' . esc_attr( $key ) . '"' . esc_attr( $checked ) . '><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title . $key_name ) . '</label></li>';
			}
			echo '</ul>';
		}

		$description = ! empty( $args['description'] ) ? $args['description'] : '';

		if ( ! empty( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（セレクトボックス）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function selectbox( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		// データがない場合、初期値設定
		if ( ! isset( $options[ $args['label'] ] ) ) {
			$options[ $args['label'] ] = $args['script']['default'];
		}

		if ( ! empty( $args['script'] ) ) {

			echo '<select name="' . esc_attr( $args['page_name'] ) . '[' . esc_attr( $args['label'] ) . ']">';
			foreach ( $args['script']['data'] as $key => $title ) {
				$selected = '';

				if ( $options[ $args['label'] ] === $key ) {
					$selected = ' selected="selected"';
				}

				$label_name = $args['page_name'] . '_' . $args['label'] . '_' . $key;

				echo '<option value="' . esc_attr( $key ) . '"' . esc_attr( $selected ) . '">' . esc_html( $title ) . '</option>';
			}
			echo '</select>';
		}

		$description = ! empty( $args['description'] ) ? $args['description'] : '';

		if ( ! empty( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（絞り込み検索）
	 *
	 * @param string $title タイトル
	 * @param string $label ラベル
	 * @param string $page_name ページ名
	 * @param string $taxonomy タクソノミー
	 * @return void
	 */
	static function multiple_search( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		// var_dump($options);
		// delete_option($page_name);

		$taxonomy_args = array(
			'hide_empty' => false,
		);

		$taxonomy = $args['taxonomy'];

		$taxonomy_data = get_taxonomy( $taxonomy );
		$terms         = get_terms( $taxonomy, $taxonomy_args );

		$display_checked = '';

		if ( ! empty( $options[ $taxonomy ]['display'] ) ) {
			$display_checked = ' checked="checked"';
		}

		if ( ! empty( $options[ $taxonomy ]['label'] ) ) {
			$taxonomy_label = $options[ $taxonomy ]['label'];
		} else {
			$taxonomy_label = $taxonomy_data->label;
		}

		echo '<p><input type="checkbox" id="taxonomy-' . esc_attr( $taxonomy ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $taxonomy ) . '][display]" value="1"' . esc_attr( $display_checked ) . '/><label for="taxonomy-' . esc_attr( $taxonomy ) . '">表示する</label></p>';

		// ラベルテキスト
		echo '<p><label for="taxonomy-' . esc_attr( $taxonomy ) . '">ラベル</label><input type="text" id="taxonomy-' . esc_attr( $taxonomy ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $taxonomy ) . '][label]" value="' . esc_attr( $taxonomy_label ) . '" /></p>';

		if ( $terms ) {
			echo '<ul>';
			foreach ( $terms as $term ) {
				$term_checked = '';
				if ( isset( $options[ $taxonomy ]['terms'] ) ) {
					if ( array_key_exists( $term->term_id, $options[ $taxonomy ]['terms'] ) ) {
						$term_checked = ' checked="checked"';
					}
				}
				$label_name = $args['label'] . '_' . $taxonomy;

				echo '<li><input type="checkbox" id="term-' . esc_attr( $term->term_id ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $taxonomy ) . '][terms][' . absint( $term->term_id ) . ']" value="1"' . esc_attr( $term_checked ) . '><label for="term-' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '(' . absint( $term->count ) . ')</label></li>';
			}
			echo '</ul>';
		}
	}

	/**
	 * フォーム作成（画像アップロード）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function imageUpload( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		$title       = ! empty( $args['title'] ) ? $args['title'] : '';
		$description = ! empty( $args['description'] ) ? $args['description'] : '';
		$placeholder = ! empty( $args['placeholder'] ) ? $args['placeholder'] : '';

		$label      = ! empty( $args['label'] ) ? $args['label'] : '';
		$label_name = $args['page_name'] . '_' . $args['label'];
		$label_class = ! empty( $args['label_class'] ) ? ' class="' . $args['label_class'] . '"' : '';

		if ( isset( $options[ $label ] ) ) {
			$data = $options[ $label ];
		} else {
			$data = '';
		}

		if ( ! empty( $title ) ) {
			echo '<h4><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title ) . '</label></h4>';
		}
		echo '<p' . $label_class . '>';

		if( $data ){
			$image = wp_get_attachment_url( $data );
			echo '<img class="' . Define::value( 'theme_name' ) . '-image-loader-preview" src="' . $image . '" style="max-width:320px;margin-bottom:1rem;display:block;">';
		}

		echo '<a href="#" style="margin-right:1rem;" class="' . Define::value( 'theme_name' ) . '-image-uploader button">画像を選択</a>';
		echo '<input type="hidden" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $label ) . ']" value="' . esc_attr( $data ) . '" />';

		if ( $data ) {
			echo '<a href="#" class="' . Define::value( 'theme_name' ) . '-remove-image button">画像を削除</a>';
		}

		echo '</p>';

		if ( isset( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（カラーピッカー）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function colorPicker( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		$title       = ! empty( $args['title'] ) ? $args['title'] : '';
		$description = ! empty( $args['description'] ) ? $args['description'] : '';
		$placeholder = ! empty( $args['placeholder'] ) ? $args['placeholder'] : '';

		$label      = ! empty( $args['label'] ) ? $args['label'] : '';
		$label_name = $args['page_name'] . '_' . $args['label'];
		$label_class = ! empty( $args['label_class'] ) ? ' class="' . $args['label_class'] . '"' : '';

		if ( isset( $options[ $label ] ) ) {
			$data = $options[ $label ];
		} else {
			$data = '';
		}

		if ( ! empty( $title ) ) {
			echo '<h4><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title ) . '</label></h4>';
		}
		echo '<p><input class="regular-text ' . Define::value( 'theme_name' ) . '-color-picker" type="text" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $label ) . ']" value="' . esc_attr( $data ) . '" /></p>';

		if ( isset( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	/**
	 * フォーム作成（ライセンス）
	 *
	 * @param array $args 設定
	 * @return void
	 */
	static function license( $args ) {
		if ( empty( $args ) ) {
			return false;
		}

		if ( isset( $args['page_name'] ) ) {
			$page_name  = $args['page_name'];
			$options = get_option( $page_name );
		}

		if( isset( $args['option_name'] ) ){
			$activate_option = get_option( $args['option_name'] . '_activate' );
		} else {
			return false;
		}

		$is_active = '';
		$description = 'ライセンスは未認証です。';
		$label_class = [
			'dashicons-before',
			'dashicons-admin-network',
		];

		if( isset( $activate_option ) && isset( $options[$args['label']] ) && ! empty( $options[$args['label']] ) ){

			if( $activate_option['status'] == true && $activate_option['data']['active'] == true && ( $args['product_id'] === $activate_option['data']['product_id'] ) ){

				$is_active = 'active';
				$description = 'ライセンスは認証されています。';

				if( 'subscription' == $activate_option['data']['mode'] ){
					$description .= '（サブスクリプション版）';
				} else {
					$description .= '（買い切り版）';
				}

			} else {

				$is_active = 'deactive';
				$description = '未認証：無効なライセンスキーです。';

			}

		}

		$title       = ! empty( $args['title'] ) ? $args['title'] : '';
		$placeholder = ! empty( $args['placeholder'] ) ? $args['placeholder'] : '';

		$label      = ! empty( $args['label'] ) ? $args['label'] : '';
		$label_name = $args['page_name'] . '_' . $args['label'];
		$label_class[] = $is_active;

		if ( isset( $options[ $label ] ) ) {
			$data = $options[ $label ];
		} else {
			$data = '';
		}

		if ( ! empty( $title ) ) {
			echo '<h4><label for="' . esc_attr( $label_name ) . '">' . esc_html( $title ) . '</label></h4>';
		}

		echo '<p class="' . trim( implode( ' ', $label_class) ) . '"><input class="regular-text" placeholder="' . esc_attr( $placeholder ) . '" type="text" id="' . esc_attr( $label_name ) . '" name="' . esc_attr( $page_name ) . '[' . esc_attr( $label ) . ']" value="' . esc_attr( $data ) . '" /></p>';

		if ( isset( $description ) ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}
}

use hakoniwa\theme\util;
new CreateForm();
