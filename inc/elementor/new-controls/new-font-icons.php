<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adding new value to exist control - icon box
 */
function tz_tf_add_more_icon( $controls_registry ) {
	// Get existing icons
	$icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
	// Append new icons
	$new_icons = array_merge(
		array(
			'zmdi zmdi-play' => 'iconic play',
			'zmdi zmdi-check-square' => 'iconic check square',
		),
		$icons
	);
	// Then we set a new list of icons as the options of the icon control
	$controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}

add_action( 'elementor/controls/controls_registered', 'tz_tf_add_more_icon', 10, 1 );

/**
 * Adding new control to exist widget - icon box
 * https://code.elementor.com/php-hooks/#elementorelementsection_namesection_idbefore_section_end
 * https://github.com/elementor/elementor/issues/6499
 */
function tz_tf_add_control_to_icon_box( $element, $args )
{
	$element->start_injection( [
		'at' => 'after',
		'of' => 'secondary_color',
	] );

	$element->add_control(
		'tz_tf_border_color',
		[
			'type' => Controls_Manager::COLOR,
			'label' => __( 'Border Color Control', 'butler' ),
			'scheme' => [
				'type' => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'border-color: {{VALUE}} !important;',
			],
		]
	);
	$element->end_injection();
	$element->start_injection( [
		'at' => 'after',
		'of' => 'hover_secondary_color',
	] );

	$element->add_control(
		'tz_tf_border_hover_color',
		[
			'type' => Controls_Manager::COLOR,
			'label' => __( 'Border Color', 'butler' ),
			'scheme' => [
				'type' => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'border-color: {{VALUE}} !important;',
			],
		]
	);
	$element->end_injection();
}

/* New Icon Control */
class TZ_Flaticon_Control extends \Elementor\Base_Data_Control {

	public function get_type() 
	{
		return 'flaticon';
	}

	/**
	 * Get icons.
	 *
	 * Retrieve all the available icons.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array Available icons.
	 */
	public static function get_icons() 
	{
		return [
			'flaticon-001-strategy-5'	=>	'strategy-5',
			'flaticon-002-strategy-4'	=>	'strategy-4',
			'flaticon-003-development'	=>	'development',
			'flaticon-004-maze'	=>	'maze',
			'flaticon-005-analysis-1'	=>	'analysis-1',
			'flaticon-006-handshake'	=>	'handshake',
			'flaticon-007-strategy-3'	=>	'strategy-3',
			'flaticon-008-develop'	=>	'develop',
			'flaticon-009-communications'	=>	'communications',
			'flaticon-010-analysis'	=>	'analysis',
			'flaticon-011-strategies'	=>	'strategies',
			'flaticon-012-direction'	=>	'direction',
			'flaticon-013-vision'	=>	'vision',
			'flaticon-014-setting-1'	=>	'setting-1',
			'flaticon-015-network'	=>	'network',
			'flaticon-016-strategy-2'	=>	'strategy-2',
			'flaticon-017-skills'	=>	'skills',
			'flaticon-018-pie-graphic'	=>	'pie-graphic',
			'flaticon-019-workers'	=>	'workers',
			'flaticon-020-pyramid'	=>	'pyramid',
			'flaticon-021-management-1'	=>	'management-1',
			'flaticon-022-idea'	=>	'idea',
			'flaticon-023-marketing'	=>	'marketing',
			'flaticon-024-organization-2'	=>	'organization-2',
			'flaticon-025-setting'	=>	'setting',
			'flaticon-026-chess'	=>	'chess',
			'flaticon-027-strategy-1'	=>	'strategy-1',
			'flaticon-029-choose'	=>	'choose',
			'flaticon-030-training-1'	=>	'training-1',
			'flaticon-031-target'	=>	'target',
			'flaticon-032-training'	=>	'training',
			'flaticon-033-chart'	=>	'chart',
			'flaticon-034-organization'	=>	'organization',
			'flaticon-035-start'	=>	'start',
			'flaticon-036-selective'	=>	'selective',
			'flaticon-037-timer'	=>	'timer',
			'flaticon-038-creative'	=>	'creative',
			'flaticon-039-people'	=>	'people',
			'flaticon-040-progress'	=>	'progress',
			'flaticon-041-management'	=>	'management',
			'flaticon-042-analytics'	=>	'analytics',
			'flaticon-043-value'	=>	'value',
			'flaticon-044-planning'	=>	'planning',
			'flaticon-045-human-resources'	=>	'human-resources',
			'flaticon-046-tie'	=>	'tie',
			'flaticon-047-business'	=>	'business',
			'flaticon-048-strategy'	=>	'strategy',
			'flaticon-049-options'	=>	'options',
			'flaticon-050-achievement'	=>	'achievement',
		];
	}

	/**
	 * Get icons control default settings.
	 *
	 * Retrieve the default settings of the icons control. Used to return the default
	 * settings while initializing the icons control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
			'include' => '',
			'exclude' => '',
		];
	}

	/**
	 *  method registers and enqueues scripts and styles used by the control.
	 */
	public function enqueue()
	{
		wp_enqueue_script( 'flaticon', TZ_TF_ELEMENTOR_URL . 'assets/js/load-select2.js', ['jquery'], '1.0.0' );
	}

	/**
	 * Render icons control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="custom-control-icon2" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'elementor' ); ?>">
					<option value=""><?php echo __( 'Select Icon', 'elementor' ); ?></option>
					<# _.each( data.options, function( option_title, option_value ) { #>
						<option value="{{ option_value }}" data-icon="{{ option_value }}">{{{ option_title }}}</option>
						<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{ data.description }}</div>
			<# } #>
		<?php
	}

}