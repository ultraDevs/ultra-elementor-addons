<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Flipbox extends Widgets_Base {

	public function get_name() {
		return 'ua_flipbox';
	}

	public function get_title() {
		return __( 'Flip Blocks', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-flip-box';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'flip', 'flip box', 'card', '3d', 'hover', 'blocks' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-flip-blocks' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Flip Blocks', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Preset Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1: 3D Cube Rotate Y', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Layout 2: 3D Cube Rotate X', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Layout 3: Neon Glow Flip Y', 'ultra-elementor-addons' ),
					'layout-4' => __( 'Layout 4: Neon Glow Flip X', 'ultra-elementor-addons' ),
					'layout-5' => __( 'Layout 5: Split Reveal Horizontal', 'ultra-elementor-addons' ),
					'layout-6' => __( 'Layout 6: Split Reveal Vertical', 'ultra-elementor-addons' ),
					'layout-7' => __( 'Layout 7: Zoom & Rotate Y', 'ultra-elementor-addons' ),
					'layout-8' => __( 'Layout 8: Zoom & Rotate X', 'ultra-elementor-addons' ),
				],
			]
		);

		/**
		 * Grid Controls: Columns + Rows
		 * Visible items = rows * columns (0 rows => show all)
		 */
		$this->add_responsive_control(
			'grid_columns',
			[
				'label' => __( 'Columns', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->add_responsive_control(
			'grid_rows',
			[
				'label' => __( 'Rows (Visible)', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'description' => __( '0 = Show all cards', 'ultra-elementor-addons' ),
				'options' => [
					'0' => __( 'All', 'ultra-elementor-addons' ),
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
			]
		);

		$repeater = new Repeater();

		/* ---------- Repeater Tabs: Front / Back ---------- */
		$repeater->start_controls_tabs( 'orivo_flip_item_tabs' );

		/* ================= FRONT TAB ================= */
		$repeater->start_controls_tab(
			'orivo_flip_item_front_tab',
			[
				'label' => __( 'Front', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'front_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-palette',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'front_title',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'UI/UX Design', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'front_desc',
			[
				'label' => __( 'Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'আকর্ষণীয় এবং ব্যবহারবান্ধব ইন্টারফেস তৈরি করি', 'ultra-elementor-addons' ),
			]
		);

		// Per-item Front BG (works for layouts 1/2/3/4/7/8 on .orivo-flip-blocks__front)
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'front_bg',
				'label' => __( 'Front Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__front',
			]
		);

		// For split layouts (5/6) - per item background for left/right or top/bottom
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'split_bg',
				'label' => __( 'Split Background (Layout 5/6)', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__left,
				               {{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__right,
				               {{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__top,
				               {{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__bottom',
			]
		);

		$repeater->end_controls_tab();

		/* ================= BACK TAB ================= */
		$repeater->start_controls_tab(
			'orivo_flip_item_back_tab',
			[
				'label' => __( 'Back', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'back_icon_same',
			[
				'label' => __( 'Use Same Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'back_icon',
			[
				'label' => __( 'Back Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-palette',
					'library' => 'fa-solid',
				],
				'condition' => [
					'back_icon_same!' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'back_title',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'UI/UX Design', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'back_desc',
			[
				'label' => __( 'Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'ব্যবহারকারীদের অভিজ্ঞতা উন্নত করতে আকর্ষণীয় এবং কার্যকরী ইন্টারফেস ডিজাইন করি।', 'ultra-elementor-addons' ),
			]
		);

		// Per-item Back BG (works for layouts that use .orivo-flip-blocks__back)
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'back_bg',
				'label' => __( 'Back Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .orivo-flip-blocks__back',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'options' => [ 'url', 'is_external', 'nofollow' ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'items',
			[
				'label' => __( 'Cards', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'front_title' => 'UI/UX Design',
						'front_desc'  => 'আকর্ষণীয় এবং ব্যবহারবান্ধব ইন্টারফেস তৈরি করি',
						'back_title'  => 'UI/UX Design',
						'back_desc'   => 'ব্যবহারকারীদের অভিজ্ঞতা উন্নত করতে আকর্ষণীয় এবং কার্যকরী ইন্টারফেস ডিজাইন করি।',
					],
					[
						'front_title' => 'Business Strategy',
						'front_desc'  => 'লাভজনক কৌশল তৈরি করি',
						'back_title'  => 'Business Strategy',
						'back_desc'   => 'আপনার ব্যবসার জন্য কার্যকরী এবং লাভজনক কৌশল তৈরি করি।',
					],
				],
				'title_field' => '{{{ front_title }}}',
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Front
		 * ======================= */
		$this->start_controls_section(
			'section_style_front',
			[
				'label' => __( 'Front Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'front_title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'front_desc_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_description_typography',
				'label' => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc',
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Back
		 * ======================= */
		$this->start_controls_section(
			'section_style_back',
			[
				'label' => __( 'Back Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'back_title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'back_desc_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_description_typography',
				'label' => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc',
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Card
		 * ======================= */
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => __( 'Card Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_height',
			[
				'label' => __( 'Card Height', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 180, 'max' => 520 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 350 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front, {{WRAPPER}} .orivo-flip-blocks__back, {{WRAPPER}} .orivo-flip-blocks--layout-5, {{WRAPPER}} .orivo-flip-blocks--layout-6',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'layout-1';

		// Rows x Columns = visible items limit (0 rows means show all)
		$cols = isset( $settings['grid_columns'] ) ? (int) $settings['grid_columns'] : 2;
		$rows = isset( $settings['grid_rows'] ) ? (int) $settings['grid_rows'] : 0;

		$max_items = 0;
		if ( $rows > 0 && $cols > 0 ) {
			$max_items = $rows * $cols;
		}

		$items = ! empty( $settings['items'] ) ? $settings['items'] : [];
		if ( $max_items > 0 ) {
			$items = array_slice( $items, 0, $max_items );
		}

		$wrap_classes = [
			'orivo-flip-blocks-wrapper',
		];

		echo '<div class="' . esc_attr( implode( ' ', $wrap_classes ) ) . '">';
		echo '<div class="orivo-flip-blocks-grid" style="display:grid; gap:20px;">';

		if ( empty( $items ) ) {
			echo '</div></div>';
			return;
		}

		foreach ( $items as $index => $item ) {

			$card_key = 'card_link_' . $index;

			$card_classes = [
				'orivo-flip-blocks',
				'orivo-flip-blocks--' . esc_attr( $layout ),
			];

			// Enable {{CURRENT_ITEM}} selectors for repeater controls
			$item_id = ! empty( $item['_id'] ) ? $item['_id'] : $index;
			$card_classes[] = 'elementor-repeater-item-' . $item_id;

			$open_tag  = '<div class="' . esc_attr( implode( ' ', $card_classes ) ) . '">';
			$close_tag = '</div>';

			if ( ! empty( $item['link']['url'] ) ) {
				$this->add_link_attributes( $card_key, $item['link'] );
				$open_tag  = '<a class="' . esc_attr( implode( ' ', $card_classes ) ) . '" ' . $this->get_render_attribute_string( $card_key ) . '>';
				$close_tag = '</a>';
			}

			$back_icon = ( ! empty( $item['back_icon_same'] ) && 'yes' === $item['back_icon_same'] )
				? ( $item['front_icon'] ?? [] )
				: ( $item['back_icon'] ?? [] );

			echo $open_tag;

			if ( 'layout-5' === $layout ) {
				?>
				<div class="orivo-flip-blocks__left"></div>
				<div class="orivo-flip-blocks__right"></div>

				<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
					<div class="orivo-flip-blocks__icon">
						<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
					</div>
					<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['back_title'] ?? '' ); ?></h3>
					<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['back_desc'] ?? '' ); ?></p>
				</div>

				<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
					<div class="orivo-flip-blocks__icon">
						<?php if ( ! empty( $item['front_icon']['value'] ) ) { Icons_Manager::render_icon( $item['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
					</div>
					<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['front_title'] ?? '' ); ?></h3>
					<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['front_desc'] ?? '' ); ?></p>
				</div>
				<?php
			} elseif ( 'layout-6' === $layout ) {
				?>
				<div class="orivo-flip-blocks__top"></div>
				<div class="orivo-flip-blocks__bottom"></div>

				<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
					<div class="orivo-flip-blocks__icon">
						<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
					</div>
					<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['back_title'] ?? '' ); ?></h3>
					<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['back_desc'] ?? '' ); ?></p>
				</div>

				<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
					<div class="orivo-flip-blocks__icon">
						<?php if ( ! empty( $item['front_icon']['value'] ) ) { Icons_Manager::render_icon( $item['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
					</div>
					<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['front_title'] ?? '' ); ?></h3>
					<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['front_desc'] ?? '' ); ?></p>
				</div>
				<?php
			} else {
				?>
				<div class="orivo-flip-blocks__inner">
					<div class="orivo-flip-blocks__front">
						<div class="orivo-flip-blocks__content">
							<div class="orivo-flip-blocks__icon">
								<?php if ( ! empty( $item['front_icon']['value'] ) ) { Icons_Manager::render_icon( $item['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
							</div>
							<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['front_title'] ?? '' ); ?></h3>
							<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['front_desc'] ?? '' ); ?></p>
						</div>
					</div>

					<div class="orivo-flip-blocks__back">
						<div class="orivo-flip-blocks__content">
							<div class="orivo-flip-blocks__icon">
								<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
							</div>
							<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $item['back_title'] ?? '' ); ?></h3>
							<p class="orivo-flip-blocks__desc"><?php echo esc_html( $item['back_desc'] ?? '' ); ?></p>
						</div>
					</div>
				</div>
				<?php
			}

			echo $close_tag;
		}

		echo '</div></div>';
	}
}
