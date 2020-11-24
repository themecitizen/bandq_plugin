<div id="kmm-panel-mega" class="kmm-panel-mega kmm-panel">
	<p class="mega-settings">
		<span class="setting-field">
			<label>
				<?php esc_html_e( 'Enable mega menu', 'tz-addons' ) ?><br>
				<select name="{{ kmm.getFieldName( 'mega', data.data['menu-item-db-id'] ) }}">
					<option value="0"><?php esc_html_e( 'No', 'tz-addons' ) ?></option>
					<option value="1" {{ parseInt( data.megaData.mega ) ? 'selected="selected"' : '' }}><?php esc_html_e( 'Yes', 'tz-addons' ) ?></option>
				</select>
			</label>
		</span>

		<span class="setting-field kmm-mega-width-field">
			<label>
				<?php esc_html_e( 'Container width', 'tz-addons' ) ?><br>
				<select name="{{ kmm.getFieldName( 'width', data.data['menu-item-db-id'] ) }}">
					<option value="container"><?php esc_html_e( 'Default', 'tz-addons' ) ?></option>
					<option value="container-fluid" {{ 'container-fluid' == data.megaData.width ? 'selected="selected"' : '' }}><?php esc_html_e( 'Fluid', 'tz-addons' ) ?></option>
					<option value="custom" {{ 'custom' == data.megaData.width ? 'selected="selected"' : '' }}><?php esc_html_e( 'Custom', 'tz-addons' ) ?></option>
				</select>
			</label>
		</span>


		<span class="setting-field" style="{{ 'custom' == data.megaData.width ? '' : 'display: none;' }}">
			<label>
				<?php esc_html_e( 'Custom width', 'tz-addons' ) ?><br>
				<input type="text" name="{{ kmm.getFieldName( 'custom_width', data.data['menu-item-db-id'] ) }}" placeholder="1140px" value="{{ data.megaData.custom_width }}">
			</label>
		</span>
	</p>

	<div id="kmm-mega-content" class="kmm-mega-content">
		<#
		var items = _.filter( data.children, function( item ) {
		return item.subDepth == 0;
		} );
		#>
		<# _.each( items, function( item, index ) { #>

		<div class="kmm-submenu-column" data-width="{{ item.megaData.width }}">
			<ul>
				<li class="menu-item menu-item-depth-{{ item.subDepth }}">
					<# if ( item.megaData.icon ) { #>
					<i class="{{ item.megaData.icon }}"></i>
					<# } #>
					{{{ item.data['menu-item-title'] }}}
					<# if ( item.subDepth == 0 ) { #>
					<span class="kmm-column-handle kmm-resizable-e"><i class="dashicons dashicons-arrow-left-alt2"></i></span>
					<span class="kmm-column-width-label"></span>
					<span class="kmm-column-handle kmm-resizable-w"><i class="dashicons dashicons-arrow-right-alt2"></i></span>
					<input type="hidden" name="{{ kmm.getFieldName( 'width', item.data['menu-item-db-id'] ) }}" value="{{ item.megaData.width }}" class="menu-item-width">
					<# } #>
				</li>
			</ul>
		</div>

		<# } ) #>
	</div>
</div>
