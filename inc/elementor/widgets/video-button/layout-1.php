<?php
$link = isset( $settings['link'] ) ? $settings['link'] : '#';
?>
<div class="video-button-container layout-1">
	<a class="play-link" href="<?php echo esc_url( $link ); ?>"><img src="<?php echo TZ_TF_ELEMENTOR_URL . '/assets/img/play.png';?>" alt="video button" /></a>
</div>