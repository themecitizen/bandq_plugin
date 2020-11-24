<?php
use Elementor\Group_Control_Image_Size;

if ( empty( $settings['image']['id'] ) ) {
	return;
}

?>
<div class="butler-images layout-2" data-autoplay="<?php echo esc_attr( empty( $settings['carousel_autoplay'] ) ? 'false' : 'true' ); ?>" data-hide-pagination="<?php echo esc_attr( empty( $settings['hide_pagination'] ) ? 'true' : 'false' ); ?>">
	<div class="image">
		<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings , 'image_size', 'image' ); ?>
	</div>
</div>