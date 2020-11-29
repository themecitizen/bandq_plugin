(
    function ($)
    {
        'use strict';

        var testimonials = function ($scope, $) {
            var $container = $scope.find('.bandp-testimonial-container');

            if ($container.hasClass('layout-1')) {
                var $slide = $scope.find('.carousel');
                $slide.not('.slick-initialized').slick({
                    arrows: false,
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    swipeToSlide: true,
                    autoplay: true
                });
            }
        }

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

            if ($container.hasClass('layout-2')) {
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
                            breakpoint: 577,
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

        var slider = function ($scope, $) {
            var $container = $scope.find('.band-slider');

            if ($container.hasClass('layout-1')) {
                var $slide = $scope.find('.carousel');
                $slide.not('.slick-initialized').slick({
                    arrows: true,
                    dots: false,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    swipeToSlide: true,
                    autoplay: true,
                    variableWidth: true,
                    centerMode: true,
                    prevArrow:"<span class='prev'><</span>",
                    nextArrow:"<span class='next'>></span>",
                    responsive: [
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                                centerMode: true,
                                autoplay: true,
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
                elementorFrontend.hooks.addAction('frontend/element_ready/band_slider.default', slider);
                elementorFrontend.hooks.addAction('frontend/element_ready/bandq_testimonial.default', testimonials);
            }
            else {
                elementorFrontend.hooks.addAction('frontend/element_ready/band_video_button.default', videoPopup );
                elementorFrontend.hooks.addAction('frontend/element_ready/bandq_team.default', teams);
                elementorFrontend.hooks.addAction('frontend/element_ready/band_slider.default', slider);
                elementorFrontend.hooks.addAction('frontend/element_ready/bandq_testimonial.default', testimonials);
            }
        });

        $(window).scroll(function () {
            if ($('.page').hasClass('page-id-145')) {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > $('.site-header').height()) {
                    $('.site-header').css('background-color', '#081734');
                } else {
                    $('.site-header').css('background-color', 'unset');
                }
            }
        });
    }
)( jQuery );