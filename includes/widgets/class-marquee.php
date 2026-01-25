<?php
/**
 * Marquee Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Marquee extends Widgets_Base {

	const W_NAME = 'ua_marquee_';

	/**
	 * Retrieve the widget name
	 */
	public function get_name() {
		return 'ua-marquee';
	}

	/**
	 * Retrieve the widget title
	 */
	public function get_title() {
		return __( 'Marquee', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widget icon
	 */
	public function get_icon() {
		return 'ua-icon eicon-animation';
	}

	/**
	 * Widget Category
	 */
	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depends on
	 */
	public function get_script_depends() {
		return [ 'ua-script-marquee' ];
	}

	/**
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [ 'ua-style-marquee' ];
	}

	/**
	 * Register the widget controls
	 */
	protected function ua_register_controls() {
		// =====================
		// CONTENT SECTION
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'content_section',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
			]
		);

		// Layout Selector
		$this->add_control(
			self::W_NAME . 'layout',
			[
				'label'   => __( 'Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text'  => __( 'Text', 'ultra-elementor-addons' ),
					'image' => __( 'Image', 'ultra-elementor-addons' ),
					'video' => __( 'Video', 'ultra-elementor-addons' ),
				],
			]
		);

		// Direction
		$this->add_control(
			self::W_NAME . 'direction',
			[
				'label'   => __( 'Direction', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left to Right', 'ultra-elementor-addons' ),
					'right' => __( 'Right to Left', 'ultra-elementor-addons' ),
				],
			]
		);

		// Speed
		$this->add_control(
			self::W_NAME . 'speed',
			[
				'label'   => __( 'Speed (seconds)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [ 'min' => 5, 'max' => 100 ],
				],
				'default' => [
					'size' => 20,
				],
			]
		);

		// Pause on Hover
		$this->add_control(
			self::W_NAME . 'pause_hover',
			[
				'label'        => __( 'Pause on Hover', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		// =====================
		// TEXT ITEMS
		// =====================
		$this->add_control(
			self::W_NAME . 'text_heading',
			[
				'label'     => __( 'Text Items', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					self::W_NAME . 'layout' => 'text',
				],
			]
		);

		$repeater_text = new Repeater();

		$repeater_text->add_control(
			'marquee_text',
			[
				'label'   => __( 'Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Your marquee text here', 'ultra-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			self::W_NAME . 'text_items',
			[
				'label'      => __( 'Items', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'fields'     => $repeater_text->get_controls(),
				'default'    => [
					[
						'marquee_text' => __( '★ Welcome to our site ★ Best wishes for all ★ Moving forward together ★', 'ultra-elementor-addons' ),
					],
					[
						'marquee_text' => __( '★ Welcome to our site ★ Best wishes for all ★ Moving forward together ★', 'ultra-elementor-addons' ),
					],
				],
				'condition'  => [
					self::W_NAME . 'layout' => 'text',
				],
			]
		);

		// =====================
		// IMAGE ITEMS
		// =====================
		$this->add_control(
			self::W_NAME . 'image_heading',
			[
				'label'     => __( 'Image Items', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					self::W_NAME . 'layout' => 'image',
				],
			]
		);

		$repeater_image = new Repeater();

		$repeater_image->add_control(
			'marquee_image',
			[
				'label'   => __( 'Image', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400',
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			self::W_NAME . 'image_items',
			[
				'label'      => __( 'Items', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'fields'     => $repeater_image->get_controls(),
				'default'    => [
					[
						'marquee_image' => [ 'url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400' ],
					],
					[
						'marquee_image' => [ 'url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400' ],
					],
					[
						'marquee_image' => [ 'url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400' ],
					],
				],
				'condition'  => [
					self::W_NAME . 'layout' => 'image',
				],
			]
		);

		// =====================
		// VIDEO ITEMS
		// =====================
		$this->add_control(
			self::W_NAME . 'video_heading',
			[
				'label'     => __( 'Video Items', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					self::W_NAME . 'layout' => 'video',
				],
			]
		);

		$repeater_video = new Repeater();

		$repeater_video->add_control(
			'marquee_video',
			[
				'label'   => __( 'Video URL', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'https://videos.pexels.com/video-files/3209828/3209828-uhd_2560_1440_25fps.mp4',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			self::W_NAME . 'video_items',
			[
				'label'      => __( 'Items', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'fields'     => $repeater_video->get_controls(),
				'default'    => [
					[
						'marquee_video' => 'https://videos.pexels.com/video-files/3209828/3209828-uhd_2560_1440_25fps.mp4',
					],
					[
						'marquee_video' => 'https://videos.pexels.com/video-files/2611250/2611250-uhd_2560_1440_24fps.mp4',
					],
				],
				'condition'  => [
					self::W_NAME . 'layout' => 'video',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// STYLE SECTION
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_style',
			[
				'label' => __( 'Marquee Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'height',
			[
				'label'      => __( 'Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 50, 'max' => 500 ],
					'em' => [ 'min' => 5, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-marquee-blocks' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// TEXT STYLE
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_text_style',
			[
				'label'     => __( 'Text Style', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					self::W_NAME . 'layout' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => self::W_NAME . 'text_typography',
				'selector' => '{{WRAPPER}} .orivo-marquee-blocks__item',
			]
		);

		$this->add_control(
			self::W_NAME . 'text_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1f2937',
				'selectors' => [
					'{{WRAPPER}} .orivo-marquee-blocks__item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// IMAGE STYLE
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_image_style',
			[
				'label'     => __( 'Image Style', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					self::W_NAME . 'layout' => 'image',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'image_width',
			[
				'label'      => __( 'Image Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 50, 'max' => 500 ],
					'%'  => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [
					'size' => 200,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__item img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'image_gap',
			[
				'label'      => __( 'Image Gap', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'em' => [ 'min' => 0, 'max' => 5 ],
				],
				'default'    => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__inner' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'image_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__item img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// VIDEO STYLE
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_video_style',
			[
				'label'     => __( 'Video Style', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					self::W_NAME . 'layout' => 'video',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'video_width',
			[
				'label'      => __( 'Video Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 100, 'max' => 800 ],
					'%'  => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__item video' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'video_gap',
			[
				'label'      => __( 'Video Gap', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'em' => [ 'min' => 0, 'max' => 5 ],
				],
				'default'    => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__inner' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'video_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-marquee-blocks__item video' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout = $settings[ self::W_NAME . 'layout' ] ?? 'text';
		$direction = $settings[ self::W_NAME . 'direction' ] ?? 'left';
		$speed = $settings[ self::W_NAME . 'speed' ]['size'] ?? 20;
		$pause_hover = $settings[ self::W_NAME . 'pause_hover' ] === 'yes';

		$layout_class = 'orivo-marquee-blocks';
		if ( 'text' === $layout ) {
			$layout_class .= ' orivo-marquee-blocks--layout-1';
		} elseif ( 'image' === $layout ) {
			$layout_class .= ' orivo-marquee-blocks--layout-2';
		} elseif ( 'video' === $layout ) {
			$layout_class .= ' orivo-marquee-blocks--layout-3';
		}

		$data_attrs = [
			'data-direction' => $direction,
			'data-speed'     => $speed,
		];

		if ( $pause_hover ) {
			$data_attrs['data-pause'] = 'true';
		}

		$this->add_render_attribute( 'marquee_wrapper', 'class', $layout_class );
		foreach ( $data_attrs as $key => $value ) {
			$this->add_render_attribute( 'marquee_wrapper', $key, $value );
		}

		$this->add_render_attribute( 'marquee_inner', 'class', 'orivo-marquee-blocks__inner' );
		$this->add_render_attribute( 'marquee_inner', 'style', 'animation-duration: ' . intval( $speed ) . 's;' );
		$this->add_render_attribute( 'marquee_inner', 'data-cloned', 'true' );
		?>
		<div <?php $this->print_render_attribute_string( 'marquee_wrapper' ); ?>>
			<div <?php $this->print_render_attribute_string( 'marquee_inner' ); ?>>
				<?php
				if ( 'text' === $layout ) {
					$this->render_text_items( $settings );
				} elseif ( 'image' === $layout ) {
					$this->render_image_items( $settings );
				} elseif ( 'video' === $layout ) {
					$this->render_video_items( $settings );
				}
				// Duplicate items for seamless looping
				if ( 'text' === $layout ) {
					$this->render_text_items( $settings );
				} elseif ( 'image' === $layout ) {
					$this->render_image_items( $settings );
				} elseif ( 'video' === $layout ) {
					$this->render_video_items( $settings );
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render text items
	 */
	private function render_text_items( $settings ) {
		$items = $settings[ self::W_NAME . 'text_items' ];
		if ( empty( $items ) ) {
			return;
		}

		foreach ( $items as $item ) {
			$text = $item['marquee_text'];
			if ( empty( $text ) ) {
				continue;
			}
			?>
			<div class="orivo-marquee-blocks__item">
				<?php echo esc_html( $text ); ?>
			</div>
			<?php
		}
	}

	/**
	 * Render image items
	 */
	private function render_image_items( $settings ) {
		$items = $settings[ self::W_NAME . 'image_items' ];
		if ( empty( $items ) ) {
			return;
		}

		foreach ( $items as $item ) {
			$image_url = $item['marquee_image']['url'] ?? '';
			if ( empty( $image_url ) ) {
				continue;
			}
			?>
			<div class="orivo-marquee-blocks__item">
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( basename( $image_url ) ); ?>">
			</div>
			<?php
		}
	}

	/**
	 * Render video items
	 */
	private function render_video_items( $settings ) {
		$items = $settings[ self::W_NAME . 'video_items' ];
		if ( empty( $items ) ) {
			return;
		}

		foreach ( $items as $item ) {
			$video_url = $item['marquee_video'];
			if ( empty( $video_url ) ) {
				continue;
			}
			?>
			<div class="orivo-marquee-blocks__item">
				<video muted loop autoplay playsinline>
					<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
				</video>
			</div>
			<?php
		}
	}
}
