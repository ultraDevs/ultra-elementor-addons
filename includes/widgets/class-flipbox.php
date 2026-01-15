<?php

/**
 * Flipbox Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

/**
 * Flipbox widget class.
 */
class Flipbox extends Widgets_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'flipbox';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Flipbox', 'ultra-elementor-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-flip-box';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ultra-elementor-addons' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function _register_controls() {
		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( '3D Cube Rotate Y', 'ultra-elementor-addons' ),
					'layout-2' => __( '3D Cube Rotate X', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Neon Glow Flip Y', 'ultra-elementor-addons' ),
					'layout-4' => __( 'Neon Glow Flip X', 'ultra-elementor-addons' ),
					'layout-5' => __( 'Split Reveal Horizontal', 'ultra-elementor-addons' ),
					'layout-6' => __( 'Split Reveal Vertical', 'ultra-elementor-addons' ),
					'layout-7' => __( 'Zoom & Rotate Y', 'ultra-elementor-addons' ),
					'layout-8' => __( 'Zoom & Rotate X', 'ultra-elementor-addons' ),
				],
			]
		);

		// Front Content
		$this->add_control(
			'front_icon',
			[
				'label'   => __( 'Front Icon', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'front_title',
			[
				'label'       => __( 'Front Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Front Title', 'ultra-elementor-addons' ),
				'placeholder' => __( 'Enter title', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'front_description',
			[
				'label'       => __( 'Front Description', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Front description', 'ultra-elementor-addons' ),
				'placeholder' => __( 'Enter description', 'ultra-elementor-addons' ),
			]
		);

		// Back Content
		$this->add_control(
			'back_icon',
			[
				'label'   => __( 'Back Icon', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'back_title',
			[
				'label'       => __( 'Back Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Back Title', 'ultra-elementor-addons' ),
				'placeholder' => __( 'Enter title', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'back_description',
			[
				'label'       => __( 'Back Description', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Back description', 'ultra-elementor-addons' ),
				'placeholder' => __( 'Enter description', 'ultra-elementor-addons' ),
			]
		);

		$this->end_controls_section();

		// Style Tab
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'height',
			[
				'label'      => __( 'Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Front Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'label'    => __( 'Front Background', 'ultra-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front',
			]
		);

		// Back Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'back_background',
				'label'    => __( 'Back Background', 'ultra-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back',
			]
		);

		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__title',
			]
		);

		// Description Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__desc',
			]
		);

		// Icon Size
		$this->add_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout = $settings['layout'];

		$front_icon   = $settings['front_icon'];
		$front_title  = $settings['front_title'];
		$front_desc   = $settings['front_description'];
		$back_icon    = $settings['back_icon'];
		$back_title   = $settings['back_title'];
		$back_desc    = $settings['back_description'];

		if ( 'layout-5' === $layout ) {
			// Split Reveal Horizontal
			?>
			<div class="orivo-flip-blocks orivo-flip-blocks--layout-5">
				<div class="orivo-flip-blocks__left"></div>
				<div class="orivo-flip-blocks__right"></div>
				<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
					<?php if ( ! empty( $back_icon['value'] ) ) : ?>
						<div class="orivo-flip-blocks__icon">
							<?php Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $back_title ) ) : ?>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $back_title ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $back_desc ) ) : ?>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $back_desc ); ?></p>
					<?php endif; ?>
				</div>
				<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
					<?php if ( ! empty( $front_icon['value'] ) ) : ?>
						<div class="orivo-flip-blocks__icon">
							<?php Icons_Manager::render_icon( $front_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $front_title ) ) : ?>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $front_title ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $front_desc ) ) : ?>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $front_desc ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php
		} elseif ( 'layout-6' === $layout ) {
			// Split Reveal Vertical
			?>
			<div class="orivo-flip-blocks orivo-flip-blocks--layout-6">
				<div class="orivo-flip-blocks__top"></div>
				<div class="orivo-flip-blocks__bottom"></div>
				<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
					<?php if ( ! empty( $back_icon['value'] ) ) : ?>
						<div class="orivo-flip-blocks__icon">
							<?php Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $back_title ) ) : ?>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $back_title ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $back_desc ) ) : ?>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $back_desc ); ?></p>
					<?php endif; ?>
				</div>
				<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
					<?php if ( ! empty( $front_icon['value'] ) ) : ?>
						<div class="orivo-flip-blocks__icon">
							<?php Icons_Manager::render_icon( $front_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $front_title ) ) : ?>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $front_title ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $front_desc ) ) : ?>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $front_desc ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php
		} else {
			// Standard layouts 1-4,7,8
			?>
			<div class="orivo-flip-blocks orivo-flip-blocks--<?php echo esc_attr( $layout ); ?>">
				<div class="orivo-flip-blocks__inner">
					<div class="orivo-flip-blocks__front">
						<div class="orivo-flip-blocks__content">
							<?php if ( ! empty( $front_icon['value'] ) ) : ?>
								<div class="orivo-flip-blocks__icon">
									<?php Icons_Manager::render_icon( $front_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $front_title ) ) : ?>
								<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $front_title ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $front_desc ) ) : ?>
								<p class="orivo-flip-blocks__desc"><?php echo esc_html( $front_desc ); ?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="orivo-flip-blocks__back">
						<div class="orivo-flip-blocks__content">
							<?php if ( ! empty( $back_icon['value'] ) ) : ?>
								<div class="orivo-flip-blocks__icon">
									<?php Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $back_title ) ) : ?>
								<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $back_title ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $back_desc ) ) : ?>
								<p class="orivo-flip-blocks__desc"><?php echo esc_html( $back_desc ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
