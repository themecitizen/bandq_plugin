(
    function ($)
    {
        'use strict';

        var videoPopup = function ( $scope, $ )
        {
            $scope.find( '.play-link' ).magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        };

        $(window).on('elementor/frontend/init', function ()
        {

            if (elementorFrontend.isEditMode()) {
                elementorFrontend.hooks.addAction('frontend/element_ready/airi_video_button.default', videoPopup );
            }
            else {
                elementorFrontend.hooks.addAction('frontend/element_ready/airi_video_button.default', videoPopup );
            }
        });
    }
)( jQuery );