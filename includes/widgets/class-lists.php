<?php
/**
 * List Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Lists extends Widgets_Base {

	const W_NAME = 'ua_list_';

	/**
	 * Retrieve the widget name
	 *
	 * @return string Widget Name
	 */
	public function get_name() {
		return __( 'ua-list', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widget title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'List', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widget icon
	 *
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'ua-icon eicon-bullet-list';
	}

	/**
	 * Widget Category
	 *
	 * @return array Widget categories
	 */
	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depends on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [
			'ua-style-list',
		];
	}

	/**
	 * Register the widget controls.
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
				'default' => 'icon-left',
				'options' => [
					'icon-left'       => __( 'Icon Left', 'ultra-elementor-addons' ),
					'icon-top-center' => __( 'Icon Top', 'ultra-elementor-addons' ),
				],
			]
		);

		// Show Badges
		$this->add_control(
			self::W_NAME . 'show_badges',
			[
				'label'        => __( 'Show Badges', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		// =====================
		// LIST ITEM
		// =====================
		$this->add_control(
			self::W_NAME . 'item_icon',
			[
				'label'            => __( 'Icon', 'ultra-elementor-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'list_item_icon',
				'default'          => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'item_text',
			[
				'label'   => __( 'Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'List Item', 'ultra-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			self::W_NAME . 'item_badge',
			[
				'label'   => __( 'Badge', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		// =====================
		// LIST CONTAINER STYLES
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_container',
			[
				'label' => __( 'List Container', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			self::W_NAME . 'container_bg',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'container_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// LIST ITEMS STYLES
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_items',
			[
				'label' => __( 'List Items', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'item_gap',
			[
				'label'      => __( 'Item Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'em' => [ 'min' => 0, 'max' => 3 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__items' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'item_bg',
			[
				'label'     => __( 'Item Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'item_padding',
			[
				'label'      => __( 'Item Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'content_gap',
			[
				'label'      => __( 'Content Gap', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'em' => [ 'min' => 0, 'max' => 3 ],
				],
				'default'    => [
					'size' => 12,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// =====================
		// ALIGNMENT
		// =====================

		// Layout Position - positions the entire list container
		$this->add_responsive_control(
			self::W_NAME . 'layout_position',
			[
				'label'       => __( 'Layout Position', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => 'left',
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .orivo-blocks-list' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
				'separator'   => 'before',
			]
		);

		// Content Position for Icon Left layout (vertical alignment of items)
		$this->add_responsive_control(
			self::W_NAME . 'content_position_vertical',
			[
				'label'       => __( 'Content Position', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-arrow-up',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-arrow-down',
					],
				],
				'default'     => 'center',
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .orivo-blocks-list__item' => 'align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'center' => 'center',
					'bottom' => 'flex-end',
				],
				'condition'    => [
					self::W_NAME . 'layout!' => 'icon-top-center',
				],
			]
		);

		// Content Position for Icon Top layout (horizontal alignment of items)
		$this->add_responsive_control(
			self::W_NAME . 'content_position_horizontal',
			[
				'label'       => __( 'Content Position', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => 'center',
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .orivo-blocks-list__item' => 'align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
				'condition'    => [
					self::W_NAME . 'layout' => 'icon-top-center',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// ICON STYLES
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( self::W_NAME . 'icon_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			self::W_NAME . 'icon_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .orivo-blocks-list__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#22c55e',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-list__icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			self::W_NAME . 'icon_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			self::W_NAME . 'icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__item:hover .orivo-blocks-list__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-list__item:hover .orivo-blocks-list__icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// =====================
		// TEXT STYLES
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_text',
			[
				'label' => __( 'Text', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => self::W_NAME . 'text_typography',
				'selector' => '{{WRAPPER}} .orivo-blocks-list__text',
			]
		);

		$this->add_control(
			self::W_NAME . 'text_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1f2937',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// BADGE STYLES
		// =====================
		$this->start_controls_section(
			self::W_NAME . 'section_badge',
			[
				'label' => __( 'Badge', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => self::W_NAME . 'badge_typography',
				'selector' => '{{WRAPPER}} .orivo-blocks-list__badge',
			]
		);

		$this->add_control(
			self::W_NAME . 'badge_color',
			[
				'label'     => __( 'Badge Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'badge_bg',
			[
				'label'     => __( 'Badge Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#22c55e',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-list__badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'badge_padding',
			[
				'label'      => __( 'Badge Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'badge_radius',
			[
				'label'      => __( 'Badge Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-blocks-list__badge' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output in the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get layout
		$layout = $settings[ self::W_NAME . 'layout' ] ?? 'icon-left';

		// Build container class based on layout
		$container_class = 'orivo-blocks-list';
		if ( 'icon-top-center' === $layout ) {
			$container_class .= ' orivo-blocks-list--icon-top';
		}

		// Show badges
		$show_badges = $settings[ self::W_NAME . 'show_badges' ] === 'yes';

		// Get item data
		$item_icon = $settings[ self::W_NAME . 'item_icon' ];
		$item_text = $settings[ self::W_NAME . 'item_text' ];
		$item_badge = $settings[ self::W_NAME . 'item_badge' ];

		// Check if its already migrated
		$migrated = isset( $settings['__fa4_migrated'][ self::W_NAME . 'item_icon' ] );
		// Check if its a new widget without previously selected icon using the old Icon control
		$is_new = empty( $settings['list_item_icon'] );

		$this->add_render_attribute( 'list_container', 'class', $container_class );
		?>
		<div <?php $this->print_render_attribute_string( 'list_container' ); ?>>
			<ul class="orivo-blocks-list__items">
				<li class="orivo-blocks-list__item">
					<span class="orivo-blocks-list__icon">
						<?php
						if ( $is_new || $migrated ) {
							Icons_Manager::render_icon( $item_icon, [ 'aria-hidden' => 'true' ] );
						} else {
							?>
							<i class="<?php echo esc_attr( $settings['list_item_icon'] ); ?>" aria-hidden="true"></i>
							<?php
						}
						?>
					</span>
					<p class="orivo-blocks-list__text">
						<?php echo esc_html( $item_text ); ?>
					</p>
					<?php if ( $show_badges && ! empty( $item_badge ) ) : ?>
						<span class="orivo-blocks-list__badge">
							<?php echo esc_html( $item_badge ); ?>
						</span>
					<?php endif; ?>
				</li>
			</ul>
		</div>
		<?php
	}
}
