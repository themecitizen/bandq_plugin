<?php
$id = uniqid( 'accordion-' );
?>
<div class="tz-accordion-manager">
	<div id="<?php echo esc_attr( $id ); ?>">
	<?php
	if ( $settings['tabs'] )
	{
		$count = 0;
		foreach ( $settings['tabs'] as $tab )
		{
		?>
			<div class="card">
				<div class="card-header">
					<a class="card-link <?php echo $count > 0 ? 'collapsed' : ''; ?>" data-toggle="collapse" href="#<?php echo esc_attr( sprintf( 'item-%s', $count ) ); ?>">
						<?php
						if ( isset( $tab['tab_title'] ) )
						{
							echo esc_html($tab['tab_title']  );
						}
						?>
						<span class="icon-container"></span>
					</a>
				</div>
				<div id="<?php echo esc_attr( sprintf( 'item-%s', $count ) ); ?>" class="collapse <?php echo $count == 0 ? 'show' : ''; ?>" data-parent="#<?php echo esc_attr( $id ); ?>">
					<div class="card-body">
						<?php
						if ( isset( $tab['tab_content'] ) )
						{
							echo wp_kses_post($tab['tab_content']);
						}
						?>
					</div>
				</div>
			</div>
		<?php
			$count++;
		}
	}
	?>
	</div>
</div>