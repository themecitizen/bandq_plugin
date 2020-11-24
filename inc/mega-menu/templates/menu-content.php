<?php
global $wp_widget_factory;
?>
<div id="kmm-panel-content" class="kmm-panel-content kmm-panel">
	<p>
		<textarea name="{{ kmm.getFieldName( 'content', data.data['menu-item-db-id'] ) }}" class="widefat" rows="20" contenteditable="true">{{{ data.megaData.content }}}</textarea>
	</p>
	<p class="description"><?php esc_html_e( 'Allow HTML and Shortcodes', 'tz-addons' ) ?></p>
	<p class="description"><?php esc_html_e( 'Tip: Build your content inside a page with visual page builder then copy generated content here.', 'tz-addons' ) ?></p>
</div>