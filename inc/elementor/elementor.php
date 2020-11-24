<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'TZ_Elementor_Widgets' ) )
{
	/**
	 * Main TZ_Elementor_Widgets Class
	 *
	 */

	final class TZ_Elementor_Widgets {
		/** Singleton *************************************************************/

		private static $_instance = null;

		public static  function instance()
		{
			if ( is_null( self::$_instance ) )
			{
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct()
		{
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		public function init()
		{
			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}
			// Register new widget category
			add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ] );

			add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
			// Register Widget Styles
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
			// Register Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
			// Register new controls
			add_action( 'elementor/controls/controls_registered', [ $this, 'widget_new_controls' ] );
		}

		public function widget_categories(  $elements_manager )
		{
			$elements_manager->add_category(
				'bandq',
				[
					'title' => __( 'BANDQ', 'bandq' ),
					'icon' => 'fa fa-plug',
				]
			);
		}

		public function widget_new_controls( $elementor )
		{
			require_once( TZ_TF_ELEMENTOR_PATH . 'new-controls/new-font-icons.php' );
			$elementor->register_control( 'flaticon', new TZ_Flaticon_Control() );
		}

		public function widget_styles()
		{
			wp_enqueue_style( 'widget-elementor-style', TZ_TF_ELEMENTOR_URL . 'assets/css/style.css'  );
		}

		public function widget_scripts()
		{
			wp_enqueue_script( 'widget-elementor-scripts', TZ_TF_ELEMENTOR_URL . 'assets/js/scripts.js', [ 'jquery' ] );
		}
		public function init_widgets( $widgets_manager ) {

//			// Include Widget files
			require_once( TZ_TF_ELEMENTOR_PATH . 'widgets/team/team.php' );
			require_once( TZ_TF_ELEMENTOR_PATH . 'widgets/video-button/video-button.php' );
		}

		public function admin_notice_missing_main_plugin() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'bandq' ),
				'<strong>' . esc_html__( 'Elementor Test Extension', 'bandq' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'bandq' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}
	}
}