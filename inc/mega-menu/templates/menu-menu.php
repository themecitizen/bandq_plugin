<# if ( data.depth == 0 ) { #>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Mega Menu', 'tz-addons' ) ?>" data-panel="mega"><?php esc_html_e( 'Mega Menu', 'tz-addons' ) ?></a>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Mega Menu Design', 'tz-addons' ) ?>" data-panel="design"><?php esc_html_e( 'Design', 'tz-addons' ) ?></a>
<div class="separator"></div>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'tz-addons' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'tz-addons' ) ?></a>
<# } else if ( data.depth == 1 ) { #>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu Setting', 'tz-addons' ) ?>" data-panel="settings"><?php esc_html_e( 'Settings', 'tz-addons' ) ?></a>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Mega Column Design', 'tz-addons' ) ?>" data-panel="design"><?php esc_html_e( 'Design', 'tz-addons' ) ?></a>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Content', 'tz-addons' ) ?>" data-panel="content"><?php esc_html_e( 'Content', 'tz-addons' ) ?></a>
<div class="separator"></div>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'tz-addons' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'tz-addons' ) ?></a>
<# } else { #>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu Content', 'tz-addons' ) ?>" data-panel="content"><?php esc_html_e( 'Content', 'tz-addons' ) ?></a>
<div class="separator"></div>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'tz-addons' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'tz-addons' ) ?></a>
<# } #>
