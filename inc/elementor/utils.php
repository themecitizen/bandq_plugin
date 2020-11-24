<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Check elementor loaded
if ( ! did_action( 'elementor/loaded' ) ) {
	return;
}

function wpf_get_image_custom_size_url( $image_id, $width = 0, $height = 0 )
{
	$args = [
		'image_size'    =>  'custom',
		'image_custom_dimension' => [
			'width' =>  $width,
			'height' =>  $height,
		],
	];
	$image_src = Elementor\Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image', $args );
	if ( ! empty( $image_src ) )
	{
		return $image_src;
	}
	else
	{
		return false;
	}
}

function wpf_get_image_custom_size_html( $image_id, $width = 0, $height = 0 )
{
	$image_src = get_image_custom_size_url( $image_id, $width, $height );

	if ( ! empty( $image_src ) )
	{
		echo sprintf( '<img src="%s" title="%s" alt="%s" />', esc_attr( $image_src ), Elementor\Control_Media::get_image_title( $image_id ), Elementor\Control_Media::get_image_alt( $image_id ) );
	}
	else
	{
		return false;
	}
}