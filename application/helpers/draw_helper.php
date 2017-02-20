<?php 
if ( ! defined ( 'BASEPATH' ) ) {
    exit( 'No direct script access allowed' );
}

/**
 * Draw Banner
 *
 * Draw a success or failure banner.
 * @access public
 * @param string  $content banner content
 * @param integer $type    banner type
 * @return string
 */
function mod_draw_banner($content, $type = 0, $extra = "") {

    // Set Preferences
    switch ($type) {

        case 0:
            $type = "no";
            break;
        case 1:
            $type = "yes";
            break;
        case 2:
            $type = "info";
            break;

        default:
            $type = "no";
            break;
    }

    if (!empty($extra)) {
        $extra = "_" . $extra;
    }
    $banner = '<div class="alert_banner_' . $type . $extra . '">' . helper_html_img("", "icon_main_$type.png", "16", "16", "Notifier") . $content . '</div>';

    return $banner;
}
