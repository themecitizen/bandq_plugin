<# var itemId = data.data['menu-item-db-id']; #>
<div id="kmm-panel-design" class="kmm-panel-design kmm-panel">
	<# if ( 1 == data.depth ) { #>
	<div class="setting-fieldset spacing-fieldset">
		<p class="padding-fields">
			<label><?php esc_html_e( 'Padding', 'tz-addons' ) ?></label><br>
			<label>
				<input type="text" value="{{ data.megaData.padding.top }}" name="{{ kmm.getFieldName( 'padding.top', itemId ) }}" size="4" placeholder="30px"><br>
				<span class="description"><?php esc_html_e( 'Top', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.padding.bottom }}" name="{{ kmm.getFieldName( 'padding.bottom', itemId ) }}" size="4" placeholder="20px"><br>
				<span class="description"><?php esc_html_e( 'Bottom', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.padding.left }}" name="{{ kmm.getFieldName( 'padding.left', itemId ) }}" size="4" placeholder="23px"><br>
				<span class="description"><?php esc_html_e( 'Left', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.padding.right }}" name="{{ kmm.getFieldName( 'padding.right', itemId ) }}" size="4" placeholder="20px"><br>
				<span class="description"><?php esc_html_e( 'Right', 'tz-addons' ) ?></span>
			</label>
		</p>

		<p class="margin-fields">
			<label><?php esc_html_e( 'Margin', 'tz-addons' ) ?></label><br>
			<label>
				<input type="text" value="{{ data.megaData.margin.top }}" name="{{ kmm.getFieldName( 'margin.top', itemId ) }}" size="4"><br>
				<span class="description"><?php esc_html_e( 'Top', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.margin.bottom }}" name="{{ kmm.getFieldName( 'margin.bottom', itemId ) }}" size="4"><br>
				<span class="description"><?php esc_html_e( 'Bottom', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.margin.left }}" name="{{ kmm.getFieldName( 'margin.left', itemId ) }}" size="4"><br>
				<span class="description"><?php esc_html_e( 'Left', 'tz-addons' ) ?></span>
			</label>
			&nbsp;
			<label>
				<input type="text" value="{{ data.megaData.margin.right }}" name="{{ kmm.getFieldName( 'margin.right', itemId ) }}" size="4"><br>
				<span class="description"><?php esc_html_e( 'Right', 'tz-addons' ) ?></span>
			</label>
		</p>
	</div>
	<# } #>

	<div class="setting-fieldset background-fieldset background-image-fieldset">
		<p class="background-image">
			<label><?php esc_html_e( 'Background Image', 'tz-addons' ) ?></label><br>
			<span class="background-image-preview {{ data.megaData.background.image ? 'has-image' : '' }}">
				<# if ( data.megaData.background.image ) { #>
					<img src="{{ data.megaData.background.image }}">
				<# } #>
			</span>

			<button type="button" class="button remove-button <# if ( ! data.megaData.background.image ) { print( 'hidden' ) } #>"><?php esc_html_e( 'Remove', 'tz-addons' ) ?></button>
			<button type="button" class="button upload-button" id="background_image-button"><?php esc_html_e( 'Select Image', 'tz-addons' ) ?></button>

			<input type="hidden" name="{{ kmm.getFieldName( 'background.image', itemId ) }}" value="{{ data.megaData.background.image }}">
		</p>
	</div>

	<div class="setting-fieldset background-fieldset">
		<p class="background-color">
			<label><?php esc_html_e( 'Background Color', 'tz-addons' ) ?></label><br>
			<input type="text" class="background-color-picker" name="{{ kmm.getFieldName( 'background.color', itemId ) }}" value="{{ data.megaData.background.color }}">
		</p>

		<p class="background-repeat">
			<label><?php esc_html_e( 'Background Repeat', 'tz-addons' ) ?></label><br>
			<select name="{{ kmm.getFieldName( 'background.repeat', itemId ) }}">
				<option value="no-repeat" {{ 'no-repeat' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'No Repeat', 'tz-addons' ) ?></option>
				<option value="repeat" {{ 'repeat' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile', 'tz-addons' ) ?></option>
				<option value="repeat-x" {{ 'repeat-x' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile Horizontally', 'tz-addons' ) ?></option>
				<option value="repeat-y" {{ 'repeat-y' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile Vertically', 'tz-addons' ) ?></option>
			</select>
		</p>

		<p class="background-position background-position-x">
			<label><?php esc_html_e( 'Background Position', 'tz-addons' ) ?></label><br>

			<select name="{{ kmm.getFieldName( 'background.position.x', itemId ) }}">
				<option value="left" {{ 'left' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Left', 'tz-addons' ) ?></option>
				<option value="center" {{ 'center' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Center', 'tz-addons' ) ?></option>
				<option value="right" {{ 'right' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Right', 'tz-addons' ) ?></option>
				<option value="custom" {{ 'custom' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Custom', 'tz-addons' ) ?></option>
			</select>

			<input
				type="text"
				name="{{ kmm.getFieldName( 'background.position.custom.x', itemId ) }}"
				value="{{ data.megaData.background.position.custom.x }}"
				class="{{ 'custom' != data.megaData.background.position.x ? 'hidden' : '' }}">
		</p>

		<p class="background-position background-position-y">
			<select name="{{ kmm.getFieldName( 'background.position.y', itemId ) }}">
				<option value="top" {{ 'top' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Top', 'tz-addons' ) ?></option>
				<option value="center" {{ 'center' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Middle', 'tz-addons' ) ?></option>
				<option value="bottom" {{ 'bottom' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Bottom', 'tz-addons' ) ?></option>
				<option value="custom" {{ 'custom' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Custom', 'tz-addons' ) ?></option>
			</select>
			<input
				type="text"
				name="{{ kmm.getFieldName( 'background.position.custom.y', itemId ) }}"
				value="{{ data.megaData.background.position.custom.y }}"
				class="{{ 'custom' != data.megaData.background.position.y ? 'hidden' : '' }}">
		</p>

		<p class="background-attachment">
			<label><?php esc_html_e( 'Background Attachment', 'tz-addons' ) ?></label><br>
			<select name="{{ kmm.getFieldName( 'background.attachment', itemId ) }}">
				<option value="scroll" {{ 'scroll' == data.megaData.background.attachment ? 'selected="selected"' : '' }}><?php esc_html_e( 'Scroll', 'tz-addons' ) ?></option>
				<option value="fixed" {{ 'fixed' == data.megaData.background.attachment ? 'selected="selected"' : '' }}><?php esc_html_e( 'Fixed', 'tz-addons' ) ?></option>
			</select>
		</p>

		<p class="background-size">
			<label><?php esc_html_e( 'Background Size', 'tz-addons' ) ?></label><br>
			<select name="{{ kmm.getFieldName( 'background.size', itemId ) }}">
				<option value=""><?php esc_html_e( 'Default', 'tz-addons' ) ?></option>
				<option value="cover" {{ 'cover' == data.megaData.background.size ? 'selected="selected"' : '' }}><?php esc_html_e( 'Cover', 'tz-addons' ) ?></option>
				<option value="contain" {{ 'contain' == data.megaData.background.size ? 'selected="selected"' : '' }}><?php esc_html_e( 'Contain', 'tz-addons' ) ?></option>
			</select>
		</p>
	</div>
</div>