(function ($, elementor) {
    'use strict';

    let heroCarouselData = {
        init: function ($scope) {
            console.log('carousel init');
            const CAROUSEL_SELECTORS = {
                section: ".js-gtea_animated_carousel",
                slider: ".js-gtea_animated_carousel-slider",
                sliderNextBtn: ".js-gtea_animated_carousel-next-btn",
                sliderPrevBtn: ".js-gtea_animated_carousel-prev-btn",
                activeSlide: ".swiper-slide-active",
                sliderVideo: ".js-gtea_animated_carousel-video",
            };

            const $carouselSections = document.querySelectorAll(
                CAROUSEL_SELECTORS.section
            );

            if ($carouselSections?.length < 1) return;

            $carouselSections.forEach(($wrap) => {
                const $slider = $wrap.querySelector(CAROUSEL_SELECTORS.slider);
                if (!$slider) return;

                const desktopSlidesPerView = $slider.dataset.slides || "auto";
                const mobileSlidesPerView = $slider.dataset.mobileSlides || "auto";
                const autoplayTrigger = $slider.dataset.autoplayOn === 'true';
                console.log($slider.dataset.autoplayOn );

                const sliderInstance = new Swiper($slider, {
                    loop: true,
                    centeredSlides: true,
                    grabCursor: true,
                    initialSlide: 2,
                    speed: 450,
                    effect: "coverflow",
                    slideToClickedSlide: true,
                    loopPreventsSliding: true,
                    onInit: () => {
                        ScrollTrigger?.refresh();
                    },
                    navigation: {
                        nextEl: CAROUSEL_SELECTORS.sliderNextBtn,
                        prevEl: CAROUSEL_SELECTORS.sliderPrevBtn,
                    },
                    autoplay: autoplayTrigger,
                    on: {
                        slideChangeTransitionStart: () => {
                            const $activeSlide = $slider.querySelector(
                                CAROUSEL_SELECTORS.activeSlide
                            );
                            if (!$activeSlide) return;

                            const $activeVideo = $activeSlide.querySelector(
                                CAROUSEL_SELECTORS.sliderVideo
                            );
                            const $allVideos = $slider.querySelectorAll(
                                CAROUSEL_SELECTORS.sliderVideo
                            );

                            $allVideos.forEach(($video) => {
                                if ($video !== $activeVideo && !$video.paused) {
                                    $video.pause();
                                }
                            });

                            if ($activeVideo) {
                                $activeVideo.play();
                            }
                        },
                    },
                    breakpoints: {
                        1: {
                            spaceBetween: 20,
                            slidesPerView: mobileSlidesPerView,
                            coverflowEffect: {
                                depth: 1200,
                                rotate: -125,
                                modifier: 0.25,
                                stretch: 0,
                                scale: 0.75,
                            },
                        },
                        1024: {
                            spaceBetween: 50,
                            slidesPerView: desktopSlidesPerView,
                            coverflowEffect: {
                                depth: 1700,
                                rotate: -85,
                                modifier: 0.12,
                                stretch: -100,
                                scale: 0.95,
                            },
                        },
                    },
                });
            });
        }
    };

    // Initialize the widget when it is rendered in the frontend or editor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/gtea_hero_carousel_widget.default', heroCarouselData.init);
    });

})(jQuery, window.elementorFrontend);
