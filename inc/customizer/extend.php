<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Add Range Customizer
	 */
	class Nishiki_WP_Customize_Range extends WP_Customize_Control {
		/**
		 * タイプ
		 *
		 * @var string
		 */
		public $type = 'range';

		/**
		 * Construct
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance
		 * @param int                  $id Control ID
		 * @param array                $args 設定
		 */
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$defaults = array(
				'min'  => 0,
				'max'  => 10,
				'step' => 1,
			);
			$args     = wp_parse_args( $args, $defaults );

			$this->min  = $args['min'];
			$this->max  = $args['max'];
			$this->step = $args['step'];
		}

		/**
		 * レンダリング
		 *
		 * @return void
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( $this->description ) { ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input class='range-slider' min="<?php echo absint( $this->min ); ?>" max="<?php echo absint( $this->max ); ?>" step="<?php echo absint( $this->step ); ?>" type='range' <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" oninput="jQuery(this).next('input').val( jQuery(this).val() )">
				<input <?php $this->link(); ?> onKeyUp="jQuery(this).prev('input').val( jQuery(this).val() )" type='number' min="<?php echo absint( $this->min ); ?>" max="<?php echo absint( $this->max ); ?>" step="<?php echo absint( $this->step ); ?>" value='<?php echo esc_attr( $this->value() ); ?>'>
			</label>
			<?php
		}
	}

	/**
	 * Add Content
	 */
	class Nishiki_WP_Customize_Content extends WP_Customize_Control {
		/**
		 * コンテンツ
		 *
		 * @var string
		 */
		public $content = '';

		/**
		 * コンテンツ（開始）
		 *
		 * @var string
		 */
		public $start_content = '';

		/**
		 * コンテンツ（終了）
		 *
		 * @var string
		 */
		public $end_content = '';

		/**
		 * レンダリング
		 *
		 * @return void
		 */
		public function render_content() {
			if ( isset( $this->start_content ) ) {
				echo esc_html( $this->start_content );
			}
			if ( isset( $this->label ) ) {
				echo '<span class="customize-control-title">' . wp_kses_post( $this->label ) . '</span>';
			}
			if ( isset( $this->content ) ) {
				echo wp_kses_post( $this->content );
			}
			if ( isset( $this->description ) ) {
				echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
			}
			if ( isset( $this->end_content ) ) {
				echo esc_html( $this->end_content );
			}
		}
	}

	/**
	 * Add Radio Image Controll
	 */
	class Nishiki_WP_Customize_Image_Radio_Control extends WP_Customize_Control {
		/**
		 * レンダリング
		 *
		 * @return void
		 */
		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-radio-' . $this->id;
			?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<ul id='nishiki-radio-image-container'>
				<?php
				foreach ( $this->choices as $value => $label ) {
					$class = ( $this->value() === $value ) ? 'nishiki-radio-image-selected' : '';
					?>
					<li>
						<label>
							<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" 
								<?php
								$this->link();
								checked( $this->value(), $value );
								?>
							/>
							<img alt="<?php echo esc_attr( $value ); ?>" src='<?php echo esc_attr( $label ); ?>' class='<?php echo esc_attr( $class ); ?>' />
						</label>
					</li>
					<?php
				}
				?>
				</ul>
			<?php
		}
	}
}
