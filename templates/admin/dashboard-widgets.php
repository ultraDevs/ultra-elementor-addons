<?php

defined( 'ABSPATH' ) || die();

$all_widgets = self::all_widgets();
$inactive_widgets = self::inactive_widgets();
if ( isset( $_POST['save-w']) ) {

	// Validate nonce.
	if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'ua-dashboard' ) ) {
		wp_die( esc_html__( 'Nonce validation failed!', 'ultra-elementor-addons' ) );
	}

	$widgets   = ! empty( $_POST['widgets'] ) ? wp_unslash( $_POST['widgets'] ) : []; // @phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$i_widgets = array_diff( array_keys( $all_widgets ), $widgets );
	self::save_inactive_widgets( $i_widgets );
	wp_safe_redirect( admin_url( 'admin.php?page=ultra-addons#widgets' ) );
	exit();
}
?>
<div class="wrap">
	<div class="ua-widgets-list">
		<?php
		uksort( $all_widgets, 'ua_custom_sort' );
		function ua_custom_sort( $a, $b) {
			return strcasecmp( $a, $b);
		}
		foreach ( $all_widgets as $key => $value) {
			
			if ( ! in_array( $key, $inactive_widgets)) {
				$checked = 'checked="checked"';
			}
			
			else {
				$checked = '';
			}

			if ( ultra_addons_fs()->is_not_paying() ) {
				if ( $value['is_pro'] == true ) {
					$checked = 'disabled="disabled"';
				}
			}
		?>

			<div class="ua-w__item">
				<span class="ua-w-i__icon">
					<i class="<?php echo esc_html( $value['icon'] ); ?>"></i>
				</span>
				<h3 class="ua-w-i__name"><?php echo esc_html( $value['title'] ); ?> <a href="<?php echo esc_url( $value['demo'] ); ?>"><i class="eicon-eye"></i></a></h3>
				<div class="ua-w-i__toggle switch_box">
					<input class="ua-toggle" <?php echo esc_attr( $checked );?> id="ua-widget-<?php echo esc_attr( $key );?>" type="checkbox" name="widgets[]" value="<?php echo esc_attr( $key );?>">
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
