<?php

defined('ABSPATH') || die();
?>
<div class="wrap">
    <h1 class="screen-reader-text"> <?php _e('Ultra Elementor Addons', UA_TD); ?></h1>
    <form action="" class="ua-dashboard-form" method="POST">
        <div class="ua-db-tabs">
            <ul class="ua-tabs__nav">
                <?php
                $tabs = self::tabs();
                foreach ($tabs as $key => $value) {
                ?>
                    <li><a href="#<?php echo $key; ?>"><?php echo $value['title']; ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="ua-w-s__btn">
            <?php echo submit_button( "Save Changes", 'submit', 'save-w', '', ''); ?>
        </div>
        <div class="ua-tabs__content">
            <?php
            $tabs = self::tabs();
            foreach ( $tabs as $key => $value) {
                if (empty($value['view']) || !is_callable($value['view'])) {
                    continue;
                }
            ?>
            <div class="ua-tabs__item" id="<?php echo $key; ?>">
                <?php call_user_func($value['view'], $key, $value); ?>
            </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>