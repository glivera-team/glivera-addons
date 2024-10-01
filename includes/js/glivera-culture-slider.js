

(function ($, elementor) {
    'use strict';

    let cultureSliderData = {
        init: function ($scope) {
            console.log('culture slider init');
            const SELECTORS = {
                section: ".js-gtea_culture",
                slider: ".js-gtea_culture-slider",
                slide: ".js-gtea_culture-content",
                icon: ".js-gtea_culture-icon",
                title: ".js-gtea_culture-title",
                text: ".js-gtea_culture-text",
                slideButton: ".js-gtea_culture-button",
                image: ".js-gtea_culture-image",
                pagination: ".js-gtea_culture-pagination",
                button: ".js-gtea_btn-hover",
                parallax: ".js-gtea_parallax",
            };

            const CLASSNAMES = {
                line: "section_descr_line",
                paginationDisabled: "gtea_culture_slider__pagination--disabled_state",
            };

            const DEFAULT_EASE = "power2.out";

            let isAnimation = false;

            const exist = (elementOrArray) => {
                if (!elementOrArray && elementOrArray !== 0) return false;
                if (elementOrArray.length === 0) {
                    return false;
                }
                return true;
            };

            const initScaleParallax = ($el) => {
                const parallaxTl = gsap.timeline({
                    paused: true,
                    scrollTrigger: {
                        scrub: 1,
                        start: "top center+=30%",
                        end: `+=${window.innerHeight * 2}`,
                    },
                });

                parallaxTl.fromTo(
                    $el,
                    {
                        scale: 1.3,
                    },
                    {
                        scale: 1,
                        duration: 1.4,
                        ease: "expoScale(1.3, 1)",
                    }
                );
            };

            const onButtonHover = (e, $btn) => {
                const rect = $btn.getBoundingClientRect();

                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const btnWidth = $btn.clientWidth;
                const btnHeight = $btn.clientHeight;

                const xCoordinate = Math.round(x / btnWidth);
                const yCoordinate = Math.round((y + (btnWidth - btnHeight) / 2) / btnWidth);

                $btn.style.setProperty("--mouse-x", 100 * (xCoordinate - 0.5) + "%");
                $btn.style.setProperty("--mouse-y", 100 * (yCoordinate - 0.5) + "%");
            };

            const appearAnimtion = ($title, $text) => {
                if ($title) {
                    const splittedTitle = new SplitText($title, {
                        type: "words,lines",
                        linesClass: CLASSNAMES.line,
                    });

                    gsap.fromTo(
                        splittedTitle.words,
                        {
                            yPercent: 200,
                        },
                        {
                            yPercent: 0,
                            duration: 1.1,
                            stagger: 0.15,
                            ease: DEFAULT_EASE,
                            scrollTrigger: {
                                trigger: $title,
                                start: "top bottom-=20%",
                            },
                        }
                    );
                }

                if ($text) {
                    const splittedText = new SplitText($text, {
                        type: "lines",
                        linesClass: CLASSNAMES.line,
                    });

                    gsap.fromTo(
                        splittedText.lines,
                        {
                            y: 50,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: 0.5,
                            stagger: 0.12,
                            ease: DEFAULT_EASE,
                            scrollTrigger: {
                                trigger: $text,
                                start: "top bottom-=20%",
                            },
                        }
                    );
                }
            };

            const slideAnimation = (
                { $pagination, $slide, $prevSlide, $prevItems, $currentItems },
                duration
            ) => {
                if (
                    !exist($prevItems) ||
                    exist(!$currentItems) ||
                    !$prevSlide ||
                    !$slide ||
                    isAnimation
                )
                    return;

                isAnimation = true;
                const tl = gsap.timeline();

                $pagination?.classList.add(CLASSNAMES.paginationDisabled);

                tl.fromTo(
                    $prevItems,
                    {
                        y: 0,
                        opacity: 1,
                    },
                    {
                        opacity: 0,
                        duration,
                        stagger: duration / -10,
                        ease: "power1.out",
                        y: 40,
                    }
                )
                    .to($prevSlide, { opacity: 0, duration: 0.001 })
                    .to($slide, { opacity: 1, duration: 0.001 })
                    .fromTo(
                        $currentItems,
                        {
                            y: 40,
                            opacity: 0,
                        },
                        {
                            opacity: 1,
                            duration,
                            stagger: duration / 10,
                            ease: DEFAULT_EASE,

                            y: 0,
                            onComplete: () => {
                                $pagination?.classList.remove(CLASSNAMES.paginationDisabled);
                                isAnimation = false;
                            },
                        }
                    );
            };

            const $body = document.body;
            $body.setAttribute("data-js-inited", "true");

            const $parallaxBlocks = document.querySelectorAll(SELECTORS.parallax);
            gsap.registerPlugin(ScrollTrigger);

            if ($parallaxBlocks?.length !== 0) {
                $parallaxBlocks.forEach(($parallaxBlock) => {
                    initScaleParallax($parallaxBlock);
                });
            }

            const $buttons = document.querySelectorAll(SELECTORS.button);
            if ($buttons?.length !== 0) {
                $buttons.forEach(($btn) => {
                    $btn.addEventListener("mouseenter", (e) => onButtonHover(e, $btn));
                });
            }

            const $sections = document.querySelectorAll(SELECTORS.section);
            if ($sections?.length < 1) return;

            $sections.forEach(($wrap) => {
                const $slider = $wrap.querySelector(SELECTORS.slider);
                const $pagination = $wrap.querySelector(SELECTORS.pagination);
                if (!$slider) return;

                const $slides = $slider.querySelectorAll(SELECTORS.slide);
                if (!$slides.length) return;

                const { swipeDuration, autoplayDuration } = $slider.dataset;
                const duration = swipeDuration || 0.6;

                const $icons = $wrap.querySelectorAll(SELECTORS.icon);
                const $titles = $wrap.querySelectorAll(SELECTORS.title);
                const $texts = $wrap.querySelectorAll(SELECTORS.text);
                const $btns = $wrap.querySelectorAll(SELECTORS.slideButton);
                const $images = $wrap.querySelectorAll(SELECTORS.image);

                const getSlideAnimtionItems = (index) => {
                    return [
                        $icons[index],
                        $titles[index],
                        $texts[index],
                        $btns[index],
                        $images[index],
                    ];
                };

                const sliderInstance = new Swiper($slider, {
                    slidesPerView: 1,
                    speed: duration * 1000,
                    allowTouchMove: false,
                    effect: "fade",
                    autoplay: {
                        delay: autoplayDuration * 1000 || 5000,
                    },
                    fadeEffect: {
                        crossFade: true,
                    },
                    pagination: {
                        el: $pagination,
                        clickable: true,
                    },
                    on: {
                        init: (swiper) => {
                            const currentIdx = swiper.activeIndex;
                            const $slide = $slides[currentIdx];
                            const $image = $images[currentIdx];

                            if ($slide && $image) {
                                gsap.set([$slide, $image], {
                                    opacity: 1,
                                });
                            }

                            appearAnimtion($titles[currentIdx], $texts[currentIdx]);

                            ScrollTrigger.create({
                                trigger: $slider,
                                onEnter: () => swiper.autoplay.resume(),
                                onEnterBack: () => swiper.autoplay.resume(),
                                onLeave: () => swiper.autoplay.pause(),
                                onLeaveBack: () => swiper.autoplay.pause(),
                            });
                        },
                        beforeTransitionStart: (swiper) => {
                            const prevIndex = swiper.previousIndex;
                            const currentIdx = swiper.activeIndex;

                            slideAnimation(
                                {
                                    $pagination,
                                    $slide: $slides[currentIdx],
                                    $prevSlide: $slides[prevIndex],
                                    $prevItems: getSlideAnimtionItems(prevIndex),
                                    $currentItems: getSlideAnimtionItems(currentIdx),
                                },
                                duration
                            );
                        },
                    },
                });
            });
        }
    };

    // Initialize the widget when it is rendered in the frontend or editor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/gtea_culture_slider_widget.default', cultureSliderData.init);
    });

})(jQuery, window.elementorFrontend);
