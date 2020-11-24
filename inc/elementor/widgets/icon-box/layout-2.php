<div class="airi-icon_box_wrapper layout-2">
	<h3><?php echo esc_html( $settings['title_text'] ); ?></h3>
	<div class="desciption">
		<div class="content"><?php echo wp_kses_post( $settings['description_text'] ); ?></div>
	</div>
	<?php
	if ( $settings['icon'] )
	{
		?>
		<div class="icon"><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></div>
		<?php
	}
	?>
</div>