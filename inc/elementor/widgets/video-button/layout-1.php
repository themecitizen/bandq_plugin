<?php
$link = isset( $settings['link'] ) ? $settings['link'] : '#';
?>
<div class="video-button-container layout-1">
	<a class="play-link" href="<?php echo esc_url( $link ); ?>"><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></a>
</div>