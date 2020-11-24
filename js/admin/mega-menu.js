var kmm = kmm || {};

(function ( $, _ ) {
	'use strict';

	var wp = window.wp;

	kmm = {
		init: function () {
			this.$body = $( document.body );
			this.$modal = $( '#kmm-mega-menu' );
			this.itemData = {};
			this.templates = {};

			this.frame = wp.media( {
				library: {
					type: 'image'
				}
			} );

			this.initTemplates();
			this.initActions();
		},

		initTemplates: function () {
			_.each( tzMenuModal, function ( name ) {
				kmm.templates[name] = wp.template( 'kmm-' + name );
			} );
		},

		initActions: function () {
			kmm.$body
				.on( 'click', '.opensettings', this.openModal )
				.on( 'click', '.kmm-modal-backdrop, .kmm-modal-close, .kmm-button-cancel', this.closeModal );

			kmm.$modal
				.on( 'click', '.kmm-menu a', this.switchPanel )
				.on( 'change', '.kmm-mega-width-field select', this.toggleWidthField )
				.on( 'click', '.kmm-column-handle', this.resizeMegaColumn )
				.on( 'click', '.kmm-button-save', this.saveChanges );
		},

		openModal: function ( event ) {
			event.preventDefault();

			kmm.getItemData( this );

			kmm.$modal.show();
			kmm.$body.addClass( 'modal-open' );
			kmm.render();

			return false;
		},

		closeModal: function () {
			kmm.$modal.hide().find( '.kmm-content' ).html( '' );
			kmm.$body.removeClass( 'modal-open' );
			return false;
		},

		switchPanel: function ( e ) {
			e.preventDefault();

			var $el = $( this ),
				panel = $el.data( 'panel' );

			$el.addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );
			kmm.openSettings( panel );
		},

		render: function () {
			// Render menu
			kmm.$modal.find( '.kmm-frame-menu .kmm-menu' ).html( kmm.templates.menu( kmm.itemData ) );

			var $activeMenu = kmm.$modal.find( '.kmm-menu a.active' );

			// Render content
			this.openSettings( $activeMenu.data( 'panel' ) );
		},

		openSettings: function ( panel ) {
			var $content = kmm.$modal.find( '.kmm-frame-content .kmm-content' ),
				$panel = $content.children( '#kmm-panel-' + panel );

			if ( $panel.length ) {
				$panel.addClass( 'active' ).siblings().removeClass( 'active' );
			} else {
				$content.append( kmm.templates[panel]( kmm.itemData ) );
				$content.children( '#kmm-panel-' + panel ).addClass( 'active' ).siblings().removeClass( 'active' );

				if ( 'mega' === panel ) {
					kmm.initMegaColumns();
				}
				if ( 'design' === panel ) {
					kmm.initDesignFields();
				}
				if ( 'settings' === panel ) {
					kmm.initSettingsFields();
				}
				if ( 'icon' === panel ) {
					kmm.initIconFields();
				}
			}

			// Render title
			var title = kmm.$modal.find( '.kmm-frame-menu .kmm-menu a[data-panel=' + panel + ']' ).data( 'title' );
			kmm.$modal.find( '.kmm-frame-title' ).html( kmm.templates.title( {title: title} ) );
		},

		toggleWidthField: function() {
			if ( 'custom' === $( this ).val() ) {
				$( this ).closest( '.setting-field' ).next( '.setting-field' ).show();
			} else {
				$( this ).closest( '.setting-field' ).next( '.setting-field' ).hide();
			}
		},

		resizeMegaColumn: function ( e ) {
			e.preventDefault();

			var $el = $( e.currentTarget ),
				$column = $el.closest( '.kmm-submenu-column' ),
				currentWidth = $column.data( 'width' ),
				widthData = kmm.getWidthData( currentWidth ),
				nextWidth;

			if ( ! widthData ) {
				return;
			}

			if ( $el.hasClass( 'kmm-resizable-w' ) ) {
				nextWidth = widthData.increase ? widthData.increase : widthData;
			} else {
				nextWidth = widthData.decrease ? widthData.decrease : widthData;
			}

			$column[0].style.width = nextWidth.width;
			$column.data( 'width', nextWidth.width );
			$column.find( '.kmm-column-width-label' ).text( nextWidth.label );
			$column.find( '.menu-item-depth-0 .menu-item-width' ).val( nextWidth.width );
		},

		getWidthData: function( width ) {
			var steps = [
				{width: '12.50%', label: '1/8'},
				{width: '25.00%', label: '1/4'},
				{width: '33.33%', label: '1/3'},
				{width: '37.50%', label: '3/8'},
				{width: '50.00%', label: '1/2'},
				{width: '62.50%', label: '5/8'},
				{width: '66.66%', label: '2/3'},
				{width: '75.00%', label: '3/4'},
				{width: '87.50%', label: '7/8'},
				{width: '100.00%', label: '1/1'}
			];

			var index = _.findIndex( steps, function( data ) { return data.width === width; } );

			if ( index === 'undefined' ) {
				return false;
			}

			var data = {
				index: index,
				width: steps[index].width,
				label: steps[index].label
			};

			if ( index > 0 ) {
				data.decrease = {
					index: index - 1,
					width: steps[index - 1].width,
					label: steps[index - 1].label
				};
			}

			if ( index < steps.length - 1 ) {
				data.increase = {
					index: index + 1,
					width: steps[index + 1].width,
					label: steps[index + 1].label
				};
			}

			return data;
		},

		initMegaColumns: function () {
			var $columns = kmm.$modal.find( '#kmm-panel-mega .kmm-submenu-column' ),
				defaultWidth = '25.00%';

			if ( !$columns.length ) {
				return;
			}

			// Support maximum 4 columns
			if ( $columns.length <= 4 ) {
				defaultWidth = String( ( 100 / $columns.length ).toFixed( 2 ) ) + '%';
			}

			_.each( $columns, function ( column ) {
				var width = column.dataset.width;

				if ( ! parseInt( width ) ) {
					width = defaultWidth;
				}

				var widthData = kmm.getWidthData( width );

				column.style.width = widthData.width;
				column.dataset.width = widthData.width;
				$( column ).find( '.menu-item-depth-0 .menu-item-width' ).val( width );
				$( column ).find( '.kmm-column-width-label' ).text( widthData.label );
			} );
		},

		initDesignFields: function () {
			kmm.$modal.find( '.background-color-picker' ).wpColorPicker();

			// Background image
			kmm.$modal.on( 'click', '.background-image .upload-button', function ( e ) {
				e.preventDefault();

				var $el = $( this );

				// Remove all attached 'select' event
				kmm.frame.off( 'select' );

				// Update inputs when select image
				kmm.frame.on( 'select', function () {
					// Update input value for single image selection
					var url = kmm.frame.state().get( 'selection' ).first().toJSON().url;

					$el.siblings( '.background-image-preview' ).addClass( 'has-image' ).html( '<img src="' + url + '">' );
					$el.siblings( 'input' ).val( url );
					$el.siblings( '.remove-button' ).removeClass( 'hidden' );
				} );

				kmm.frame.open();
			} ).on( 'click', '.background-image .remove-button', function ( e ) {
				e.preventDefault();

				var $el = $( this );

				$el.siblings( '.background-image-preview' ).removeClass( 'has-image' ).html( '' );
				$el.siblings( 'input' ).val( '' );
				$el.addClass( 'hidden' );
			} );

			// Background position
			kmm.$modal.on( 'change', '.background-position select', function () {
				var $el = $( this );

				if ( 'custom' === $el.val() ) {
					$el.next( 'input' ).removeClass( 'hidden' );
				} else {
					$el.next( 'input' ).addClass( 'hidden' );
				}
			} );
		},

		initSettingsFields: function() {
			kmm.$modal.on( 'change', '.item-visible-fields input', function () {
				var $row = $( this ).closest( '.item-visible-fields' ),
					val = $row.find( 'input:checked' ).val();

				if ( 'visible' === val ) {
					$row.next( '.item-link-field' ).show();
				} else {
					$row.next( '.item-link-field' ).hide();
				}
			} );
		},

		initIconFields: function () {
			var $input = kmm.$modal.find( '#kmm-icon-input' ),
				$preview = kmm.$modal.find( '#kmm-selected-icon' ),
				$icons = kmm.$modal.find( '.kmm-icon-selector .icons i' );

			kmm.$modal.on( 'click', '.kmm-icon-selector .icons i', function () {
				var $el = $( this ),
					icon = $el.data( 'icon' );

				$el.addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );

				$input.val( icon );
				$preview.html( '<i class="' + icon + '"></i>' );
			} );

			$preview.on( 'click', 'i', function () {
				$( this ).remove();
				$input.val( '' );
			} );

			kmm.$modal.on( 'keyup', '.kmm-icon-search', function () {
				var term = $( this ).val().toUpperCase();

				if ( !term ) {
					$icons.show();
				} else {
					$icons.hide().filter( function () {
						return $( this ).data( 'icon' ).toUpperCase().indexOf( term ) > -1;
					} ).show();
				}
			} );
		},

		getItemData: function ( menuItem ) {
			var $menuItem = $( menuItem ).closest( 'li.menu-item' ),
				$menuData = $menuItem.find( '.mega-data' ),
				children = $menuItem.childMenuItems(),
				megaData = $menuData.data( 'mega' );

			megaData.content = $menuData.html();

			kmm.itemData = {
				depth   : $menuItem.menuItemDepth(),
				megaData: megaData,
				data    : $menuItem.getItemData(),
				children: [],
				element : $menuItem.get( 0 )
			};

			if ( !_.isEmpty( children ) ) {
				_.each( children, function ( item ) {
					var $item = $( item ),
						$itemData = $item.find( '.mega-data' ),
						depth = $item.menuItemDepth(),
						megaData = $itemData.data( 'mega' );

					megaData.content = $itemData.html();

					kmm.itemData.children.push( {
						depth   : depth,
						subDepth: depth - kmm.itemData.depth - 1,
						data    : $item.getItemData(),
						megaData: megaData,
						element : item
					} );
				} );
			}
		},

		setItemData: function ( item, data ) {
			var $dataHolder = $( item ).find( '.mega-data' );

			if ( _.has( data, 'content' ) ) {
				$dataHolder.html( data.content );
				delete data.content;
			}

			$dataHolder.data( 'mega', data );
		},

		getFieldName: function ( name, id ) {
			name = name.split( '.' );
			name = '[' + name.join( '][' ) + ']';

			return 'menu-item-mega[' + id + ']' + name;
		},

		saveChanges: function () {
			var $inputs = kmm.$modal.find( '.kmm-content :input' ),
				$spinner = kmm.$modal.find( '.kmm-toolbar .spinner' );

			$inputs.each( function() {
				var $input = $( this );

				if ( $input.is( ':checkbox' ) && $input.is( ':not(:checked)' ) ) {
					$input.attr( 'value', '0' ).prop( 'checked', true );
				}
			} );

			var data = $inputs.serialize();

			$inputs.filter( '[value="0"]' ).prop( 'checked', false );

			$spinner.addClass( 'is-active' );
			$.post( ajaxurl, {
				action: 'tz_addons_save_menu_item_data',
				data  : data
			}, function ( res ) {
				if ( !res.success ) {
					return;
				}

				var data = res.data['menu-item-mega'];

				// Update parent menu item
				if ( _.has( data, kmm.itemData.data['menu-item-db-id'] ) ) {
					kmm.setItemData( kmm.itemData.element, data[kmm.itemData.data['menu-item-db-id']] );
				}

				_.each( kmm.itemData.children, function ( menuItem ) {
					if ( !_.has( data, menuItem.data['menu-item-db-id'] ) ) {
						return;
					}

					kmm.setItemData( menuItem.element, data[menuItem.data['menu-item-db-id']] );
				} );

				$spinner.removeClass( 'is-active' );
				kmm.closeModal();
			} );
		}
	};

	$( function () {
		kmm.init();
	} );
})( jQuery, _ );
