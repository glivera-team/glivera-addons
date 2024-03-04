document.addEventListener("DOMContentLoaded", () => {
    const SELECTORS = {
        section: ".js-carousel",
        slider: ".js-carousel-slider",
    };

    const $sections = document.querySelectorAll(SELECTORS.section);
    if ($sections?.length < 1) return;

    $sections.forEach(($wrap) => {
        const $slider = $wrap.querySelector(SELECTORS.slider);
        if (!$slider) return;

        const sliderInstance = new Swiper($slider, {
            loop: true,
            slidesPerView: "auto",
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
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1: {
                    spaceBetween: 20,
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
});
