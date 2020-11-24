<?php
/**
 * Load and register widgets
 *
 * @package
 */

require_once TZ_TF_INC_PATH . 'widgets/twitter/lib/TwitterAPIExchange.php';
require_once TZ_TF_INC_PATH . 'widgets/twitter/twitter.php';

/**
 * Register widgets
 *
 * @since  1.0
 *
 * @return void
 */
function wpf_register_widgets()
{
    register_widget( 'TZ_Tweet_Widget' );
}
add_action( 'widgets_init', 'wpf_register_widgets' );