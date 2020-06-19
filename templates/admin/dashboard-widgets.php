<?php

defined('ABSPATH') || die();

$all_widgets = self::all_widgets();
$inactive_widgets = self::inactive_widgets();
if ( isset($_POST['save-w']) ) {
    $i_widgets = array_diff(array_keys($all_widgets), $_POST['widgets']);
    self::save_inactive_widgets(  $i_widgets );
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

            if ( ua_fs()->is_not_paying() ) {
                if ( $value['is_pro'] == true ) {
                    $checked = 'disabled="disabled"';
                }
            }
        ?>

            <div class="ua-w__item">
                <span class="ua-w-i__icon">
                    <i class="<?php echo $value['icon']; ?>"></i>
                </span>
                <h3 class="ua-w-i__name"><?php echo $value['title']; ?> <a href="<?php echo $value['demo']; ?>"><i class="eicon-eye"></i></a></h3>
                <div class="ua-w-i__toggle switch_box">
                    <input class="ua-toggle" <?php echo $checked;?> id="ua-widget-<?php echo $key;?>" type="checkbox" name="widgets[]" value="<?php echo $key;?>">
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</div>