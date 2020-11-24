<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Plugin;

if ( empty( $settings['images'] ) ) {
	return;
}

$slides = [];
foreach ( $settings['images'] as $image )
{
	$image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'image_size', $settings );
	$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $image ) ) . '" />';
	$slides[] = $image_html;
}

?>
<div class="butler-images layout-1" data-autoplay="<?php echo esc_attr( empty( $settings['carousel_autoplay'] ) ? 'false' : 'true' ); ?>" data-hide-pagination="<?php echo esc_attr( empty( $settings['hide_pagination'] ) ? 'true' : 'false' ); ?>">
	<div class="images">
		<?php echo implode( '', $slides ); ?>
	</div>
</div>