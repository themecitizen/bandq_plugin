jQuery( window ).on( 'elementor:init', function() {

    var ControlFlaticonItemView = elementor.modules.controls.BaseData.extend( {

        onReady: function() {
            var self = this;
            var $source = self.$el.find( '.custom-control-icon2' ).children(),
                $data = [];
            self.$el.find( '.custom-control-icon2' ).select2({
                templateResult: function(icon) {
                    var originalOption = icon.element;
                    return '<i style="margin-left: 0" class="' + jQuery(originalOption).data('icon') + '"></i> ' + icon.text;
                },
                templateSelection: function(icon) {
                    var originalOption = icon.element;
                    return '<i style="margin-left: 0" class="' + jQuery(originalOption).data('icon') + '"></i> ' + icon.text;
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });
        }
    } );
    elementor.addControlView( 'flaticon', ControlFlaticonItemView );
} );