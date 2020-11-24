<?php
function tz_tf_cat_parent_index( $arr, $id ) {
	$len = count( $arr );
	if ( 0 == $len ) {
		return false;
	}
	$id = absint( $id );
	for ( $i = 0; $i < $len; $i++ ) {
		if ( $id == $arr[ $i ][ 'id' ] ) {
			return $i;
		}
	}
	return false;
}

if ( ! function_exists( 'tz_get_mega_menu_setting_default' ) ) :
	/**
	 * Get the default mega menu settings of a menu item
	 *
	 * @return array
	 */
	function tz_get_mega_menu_setting_default() {
		return apply_filters(
			'tz_mega_menu_setting_default',
			array(
				'mega'         => false,
				'icon'         => '',
				'hide_text'    => false,
				'disable_link' => false,
				'content'      => '',
				'width'        => '',
				'border'       => array(
					'left' => 0,
				),
				'background'   => array(
					'image'      => '',
					'color'      => '',
					'attachment' => 'scroll',
					'size'       => '',
					'repeat'     => 'no-repeat',
					'position'   => array(
						'x'      => 'left',
						'y'      => 'top',
						'custom' => array(
							'x' => '',
							'y' => '',
						),
					),
				),
			)
		);
	}
endif;

if ( ! function_exists( 'tz_parse_args' ) ) :
	/**
	 * Recursive merge user defined arguments into defaults array.
	 *
	 * @param array $args
	 * @param array $default
	 *
	 * @return array
	 */
	function tz_parse_args( $args, $default = array() ) {
		$args   = (array) $args;
		$result = $default;

		foreach ( $args as $key => $value ) {
			if ( is_array( $value ) && isset( $result[ $key ] ) ) {
				$result[ $key ] = tz_parse_args( $value, $result[ $key ] );
			} else {
				$result[ $key ] = $value;
			}
		}

		return $result;
	}

endif;

// for mega menu

function tz_addons_recurse_parse_args( $args, $default = array() ) {
	$args   = (array) $args;
	$result = $default;

	foreach ( $args as $key => $value ) {
		if ( is_array( $value ) && isset( $result[ $key ] ) ) {
			$result[ $key ] = tz_addons_recurse_parse_args( $value, $result[ $key ] );
		} else {
			$result[ $key ] = $value;
		}
	}

	return $result;
}
