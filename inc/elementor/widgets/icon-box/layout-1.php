<div class="airi-icon_box_wrapper layout-1">
	<?php
	if ( $settings['icon'] )
	{
	?>
		<div class="icon"><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></div>
	<?php
	}
	?>
	<h3><?php echo esc_html( $settings['title_text'] ); ?></h3>
	<div class="desciption">
		<?php echo esc_html( $settings['description_text'] ); ?>
	</div>
</div>