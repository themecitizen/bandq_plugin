<?php

/**
 * Plugin Name: BandQ Theme Addons
 * Description: The plugin includes important functions use for theme
 * Version: 1.0
 * Author: ThemeCitizen
 */

define('TZ_TF_PATH', plugin_dir_path(__FILE__));
define('TZ_TF_URL', plugin_dir_url(__FILE__));

define('TZ_TF_INC_PATH', trailingslashit(TZ_TF_PATH . 'inc'));
define('TZ_TF_INC_URL', trailingslashit(TZ_TF_URL . 'inc'));

define('TZ_TF_CSS_URL', trailingslashit(TZ_TF_URL . 'css'));
define('TZ_TF_JS_URL', trailingslashit(TZ_TF_URL . 'js'));

define('TZ_TF_ELEMENTOR_PATH', trailingslashit(TZ_TF_INC_PATH . 'elementor'));
define('TZ_TF_ELEMENTOR_URL', trailingslashit(TZ_TF_INC_URL . 'elementor'));

define('TZ_TF_VERSION', '1.0.0');

/** Include Elementor **/

require TZ_TF_INC_PATH . 'template-tag.php';
require TZ_TF_ELEMENTOR_PATH . 'utils.php';
require TZ_TF_ELEMENTOR_PATH . 'elementor.php';
TZ_Elementor_Widgets::instance();

function tz_register_extend_elements()
{
}
add_action('after_setup_theme', 'tz_register_extend_elements');
