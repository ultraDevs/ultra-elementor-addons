<?php
defined( 'ABSPATH' ) || die();
?>
<div class="wrap">
	<h1 class="screen-reader-text"><?php esc_html_e( 'Ultra Elementor Addons', 'ultra-elementor-addons' ); ?></h1>
	<form action="" class="ua-dashboard-form" method="POST">
		<?php wp_nonce_field( 'ua-dashboard' ); ?>
		<div class="ua-db-tabs">
			<ul class="ua-tabs__nav">
				<?php
				$tabs = self::tabs();
				foreach ($tabs as $key => $value) {
				?>
					<li><a href="#<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value['title'] ); ?></a></li>
				<?php
				}
				?>
			</ul>
		</div>
		<div class="ua-w-s__btn">
			<?php submit_button( esc_html__( 'Save', 'ultra-elementor-addons' ), 'submit', 'save-w', '', '' ); ?>
		</div>
		<div class="ua-tabs__content">
			<?php
			$tabs = self::tabs();
			foreach ( $tabs as $key => $value) {
				if (empty($value['view']) || !is_callable($value['view'])) {
					continue;
				}
			?>
			<div class="ua-tabs__item" id="<?php echo esc_attr( $key ); ?>">
				<?php call_user_func($value['view'], $key, $value); ?>
			</div>
			<?php
			}
			?>
		</div>
	</form>
</div>
