<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Info_Box extends Widgets_Base {

	public function get_name() {
		return 'ua_info_boxes';
	}

	public function get_title() {
		return __( 'Info Box', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-info-box';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'info', 'box', 'cards', 'preset' ];
	}

	protected function ua_register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'preset',
			[
				'label'   => __( 'Preset Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => __( 'Info Boxes 1', 'ultra-elementor-addons' ),
					'layout2'  => __( 'Info Boxes 2', 'ultra-elementor-addons' ),
					'layout3'  => __( 'Info Boxes 3', 'ultra-elementor-addons' ),
					'layout4'  => __( 'Info Boxes 4', 'ultra-elementor-addons' ),
					'layout5'  => __( 'Info Boxes 5', 'ultra-elementor-addons' ),
					'layout6'  => __( 'Info Boxes 6', 'ultra-elementor-addons' ),
					'layout7'  => __( 'Info Boxes 7', 'ultra-elementor-addons' ),
					'layout8'  => __( 'Info Boxes 8', 'ultra-elementor-addons' ),
					'layout9'  => __( 'Info Boxes 9', 'ultra-elementor-addons' ),
					'layout10' => __( 'Info Boxes 10', 'ultra-elementor-addons' ),
					'last'     => __( 'Info Boxes Last', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'box_style',
			[
				'label'   => __( 'Box Style', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Style 1', 'ultra-elementor-addons' ),
					'2' => __( 'Style 2', 'ultra-elementor-addons' ),
					'3' => __( 'Style 3', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'   => __( 'Icon', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Image (Optional)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => [
					'selected_icon[value]' => '',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Easy DropBox Integration', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Description', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Easy DropBox Integration - Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => __( 'Tag', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New Plugin', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'More Details', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label'   => __( 'Button URL', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
			]
		);

		// Optional images for specific layouts
		$this->add_control(
			'bottom_image',
			[
				'label'   => __( 'Bottom Image (Layout 3)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'top_image',
			[
				'label'   => __( 'Top Image (Layout 6)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'btm_left_image',
			[
				'label'   => __( 'Bottom Left Image (Layout 6)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
	}

	private function icon_html() {
		$settings = $this->get_settings_for_display();
		// Check if icon is set
		if ( ! empty( $settings['selected_icon']['value'] ) ) {
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
			return;
		}

		// Fallback to image
		$img_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		if ( ! empty( $img_url ) ) {
			echo '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $settings['title'] ?? '' ) . '">';
		}
	}

	private function btn_html() {
		$settings = $this->get_settings_for_display();
		$url  = ! empty( $settings['button_url']['url'] ) ? $settings['button_url']['url'] : '#';
		$text = ! empty( $settings['button_text'] ) ? $settings['button_text'] : __( 'More Details', 'ultra-elementor-addons' );
		return '<div class="orivo-blocks-info-box__btn"><a href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></div>';
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$preset      = ! empty( $settings['preset'] ) ? $settings['preset'] : 'layout1';
		$box_style   = ! empty( $settings['box_style'] ) ? $settings['box_style'] : '1';

		// Get box style classes based on layout and style selection
		$box_class = $this->get_box_class( $preset, $box_style );
		$extra_elements = $this->get_extra_elements( $preset, $box_style );

		// Container class
		$container_class = 'info-boxes--single'; ?>

		<div class="info-boxes <?php echo esc_attr( $container_class ); ?>">
			<div class="orivo-blocks-info-box <?php echo esc_attr( $box_class ); ?>">
				<?php $this->render_box_content( $preset, $box_style, $extra_elements ); ?>
			</div>
		</div>

	<?php }

	private function get_box_class( $preset, $box_style ) {
		$classes = [
			'layout1' => [ '1' => '', '2' => '', '3' => 'orivo-blocks-info-box--bg' ],
			'layout2' => [ '1' => 'orivo-blocks-info-box--one', '2' => 'orivo-blocks-info-box--two', '3' => 'orivo-blocks-info-box--three' ],
			'layout3' => [ '1' => '', '2' => '', '3' => '' ],
			'layout4' => [ '1' => 'orivo-blocks-info-box--four', '2' => 'orivo-blocks-info-box--five', '3' => 'orivo-blocks-info-box--six' ],
			'layout5' => [ '1' => 'orivo-blocks-info-box--seven', '2' => 'orivo-blocks-info-box--seven orivo-blocks-info-box--eight', '3' => 'orivo-blocks-info-box--nine' ],
			'layout6' => [ '1' => 'orivo-blocks-info-box--ten', '2' => 'orivo-blocks-info-box--ten orivo-blocks-info-box--eleven', '3' => 'orivo-blocks-info-box--ten' ],
			'layout7' => [ '1' => 'orivo-blocks-info-box__gradient-bg', '2' => 'orivo-blocks-info-box__gradient-bg', '3' => 'orivo-blocks-info-box__gradient-bg' ],
			'layout8' => [ '1' => 'orivo-blocks-info-box--half-bg', '2' => 'orivo-blocks-info-box--half-bg', '3' => 'orivo-blocks-info-box--half-bg' ],
			'layout9' => [ '1' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg', '2' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg', '3' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg' ],
			'layout10' => [ '1' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart', '2' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart', '3' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart' ],
			'last' => [ '1' => 'orivo-blocks-info-box__last txt-center', '2' => 'orivo-blocks-info-box__last txt-center', '3' => 'orivo-blocks-info-box__last txt-center' ],
		];

		return isset( $classes[ $preset ][ $box_style ] ) ? $classes[ $preset ][ $box_style ] : '';
	}

	private function get_extra_elements( $preset, $box_style ) {
		$extra = [
			'has_border' => false,
			'has_gradient_wrapper' => false,
			'has_half_bg_wrapper' => false,
			'show_tag_outside' => false,
			'show_tag_first' => false,
			'triangle_class' => '',
			'img_bg_class' => '',
			'show_bottom_img' => false,
			'show_extra_images' => false,
		];

		// Layout 2 triangle classes
		if ( $preset === 'layout2' ) {
			$extra['triangle_class'] = [
				'1' => 'tri-right btm-left-in',
				'2' => '',
				'3' => 'tri-right btm-right',
			];
		}

		// Layout 3 img bg class
		if ( $preset === 'layout3' ) {
			$extra['img_bg_class'] = 'orivo-blocks-info-box__img--bg';
			$extra['show_bottom_img'] = true;
		}

		// Layout 5 has border for styles 1 & 2
		if ( $preset === 'layout5' ) {
			$extra['has_border'] = ( $box_style === '1' || $box_style === '2' );
			$extra['img_bg_class'] = ( $box_style === '1' || $box_style === '2' ) ? 'orivo-blocks-info-box__img--bg' : '';
			$extra['show_tag_outside'] = ( $box_style === '3' );
		}

		// Layout 6 extra images
		if ( $preset === 'layout6' ) {
			$extra['show_extra_images'] = ( $box_style === '1' || $box_style === '2' );
		}

		// Layout 7 gradient wrapper
		if ( $preset === 'layout7' ) {
			$extra['has_gradient_wrapper'] = true;
		}

		// Layout 8 & 9 half bg wrapper
		if ( $preset === 'layout8' || $preset === 'layout9' ) {
			$extra['has_half_bg_wrapper'] = true;
		}

		// Layout 10 & last tag first
		if ( $preset === 'layout10' || $preset === 'last' ) {
			$extra['show_tag_first'] = true;
		}

		return $extra;
	}

	private function render_box_content( $preset, $box_style, $extra ) {
		$settings = $this->get_settings_for_display();
		$triangle_class = isset( $extra['triangle_class'][ $box_style ] ) ? $extra['triangle_class'][ $box_style ] : '';

		// Start gradient wrapper if needed
		if ( $extra['has_gradient_wrapper'] ) {
			echo '<div class="orivo-blocks-info-box__white-bg txt-center">';
		}

		// Start half-bg wrapper if needed
		if ( $extra['has_half_bg_wrapper'] ) {
			$wrapper_class = ( $preset === 'layout9' ) ? 'orivo-blocks-info-box__round-bg-two' : 'orivo-blocks-info-box__round-bg';
			echo '<div class="' . esc_attr( $wrapper_class ) . '">';
		}

		// Start border wrapper if needed
		if ( $extra['has_border'] ) {
			echo '<div class="orivo-blocks-info-box__border">';
		}

		// Tag first (for layout10 & last)
		if ( $extra['show_tag_first'] ) {
			$tag_class = ( $preset === 'layout6' && $box_style === '2' ) ? 'orivo-blocks-info-box__tag--two' : '';
			$tag_element = ( $preset === 'layout10' ) ? 'h5' : 'h6';
			echo '<div class="orivo-blocks-info-box__tag ' . esc_attr( $tag_class ) . '">';
			echo '<' . $tag_element . '>' . esc_html( $settings['tag'] ) . '</' . $tag_element . '>';
			echo '</div>';
		}

		// Icon
		echo '<div class="orivo-blocks-info-box__img ' . esc_attr( $triangle_class . ' ' . $extra['img_bg_class'] ) . '">';
		$this->icon_html();
		echo '</div>';

		// Details
		echo '<div class="orivo-blocks-info-box__details">';

		if ( $extra['show_tag_first'] ) {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo $this->btn_html();
		} elseif ( $extra['show_tag_outside'] ) {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo $this->btn_html();
		} else {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo '<h3>' . esc_html( $settings['tag'] ) . '</h3>';
			echo $this->btn_html();
		}

		echo '</div>';

		// Tag outside (for layout5 style 3)
		if ( $extra['show_tag_outside'] ) {
			echo '<div class="orivo-blocks-info-box__tag">';
			echo '<h5>' . esc_html( $settings['tag'] ) . '</h5>';
			echo '</div>';
		}

		// End border wrapper
		if ( $extra['has_border'] ) {
			echo '</div>';
		}

		// Tag for layouts with tag (layout6, 8, 9)
		if ( ! $extra['show_tag_first'] && ! $extra['show_tag_outside'] && ( $preset === 'layout6' || $preset === 'layout8' || $preset === 'layout9' ) ) {
			$tag_class = ( $preset === 'layout6' && $box_style === '2' ) ? 'orivo-blocks-info-box__tag--two' : '';
			echo '<div class="orivo-blocks-info-box__tag ' . esc_attr( $tag_class ) . '">';
			$tag_element = ( $preset === 'layout6' || $preset === 'layout8' || $preset === 'layout9' ) ? 'h5' : 'h6';
			echo '<' . $tag_element . '>' . esc_html( $settings['tag'] ) . '</' . $tag_element . '>';
			echo '</div>';
		}

		// End half-bg wrapper
		if ( $extra['has_half_bg_wrapper'] ) {
			echo '</div>';
			echo '<div class="orivo-blocks-info-box__primary-bg"></div>';
		}

		// End gradient wrapper
		if ( $extra['has_gradient_wrapper'] ) {
			echo '</div>';
		}

		// Bottom image (layout3)
		if ( $extra['show_bottom_img'] ) {
			$img_url = ! empty( $settings['bottom_image']['url'] ) ? $settings['bottom_image']['url'] : '';
			if ( $img_url ) {
				echo '<div class="orivo-blocks-info-box__btm-img">';
				echo '<img src="' . esc_url( $img_url ) . '" alt="">';
				echo '</div>';
			}
		}

		// Extra images (layout6)
		if ( $extra['show_extra_images'] ) {
			$top_img_url = ! empty( $settings['top_image']['url'] ) ? $settings['top_image']['url'] : '';
			$btm_left_img_url = ! empty( $settings['btm_left_image']['url'] ) ? $settings['btm_left_image']['url'] : '';

			if ( $top_img_url ) {
				echo '<div class="orivo-blocks-info-box__top-img">';
				echo '<img src="' . esc_url( $top_img_url ) . '" alt="">';
				echo '</div>';
			}

			if ( $btm_left_img_url ) {
				echo '<div class="orivo-blocks-info-box__btm-left-img">';
				echo '<img src="' . esc_url( $btm_left_img_url ) . '" alt="">';
				echo '</div>';
			}
		}
	}
}
