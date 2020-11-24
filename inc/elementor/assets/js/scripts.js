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

        var teams = function ($scope, $) {
            var $container = $scope.find('.bandp-team-container');

            if ($container.hasClass('layout-1')) {
                var $slide = $scope.find('.carousel');
                $slide.not('.slick-initialized').slick({
                    arrows: false,
                    dots: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    swipeToSlide: true,
                    autoplay: false,
                    responsive: [
                        {
                            breakpoint: 639,
                            settings: {
                                slidesToShow: 1,
                                centerMode: false,
                                autoplay: true,
                                dots: true,
                            }
                        }
                    ]
                });
            }
        }

        $(window).on('elementor/frontend/init', function ()
        {

            if (elementorFrontend.isEditMode()) {
                elementorFrontend.hooks.addAction('frontend/element_ready/band_video_button.default', videoPopup );
                elementorFrontend.hooks.addAction('frontend/element_ready/bandq_team.default', teams);
            }
            else {
                elementorFrontend.hooks.addAction('frontend/element_ready/band_video_button.default', videoPopup );
                elementorFrontend.hooks.addAction('frontend/element_ready/bandq_team.default', teams);
            }
        });
    }
)( jQuery );