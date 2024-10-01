(function ($, elementor) {
    'use strict';

    let marqueeData = {
        init: function ($scope) {
            let windowWidth;

            updateSizes();
            initBanner();

            window.addEventListener("resize", function () {
                resizeFunc();
            });

            function resizeFunc() {
                updateSizes();
            }

            function updateSizes() {
                windowWidth = window.innerWidth;
            }

            function initBanner() {
                const tl1 = gsap.timeline({ paused: false, repeat: -1 });
                const tl2 = gsap.timeline({ paused: false, repeat: -1 });
                const duration = 8;
                const duration1 =
                    duration *
                    document.querySelectorAll(".gtea_marquee_gallery__col_in.v1_mod > *").length;
                const duration2 =
                    duration *
                    1.5 *
                    document.querySelectorAll(".gtea_marquee_gallery__col_in.v3_mod > *").length;

                tl1
                    .addLabel("start")
                    .fromTo(
                        [".gtea_marquee_gallery__col_in.v1_mod", ".gtea_marquee_gallery__col_in.v2_mod"],
                        { yPercent: 0 },
                        { yPercent: -100, duration: duration1, ease: "none" }
                    );

                tl2
                    .addLabel("start")
                    .fromTo(
                        [".gtea_marquee_gallery__col_in.v3_mod", ".gtea_marquee_gallery__col_in.v4_mod"],
                        { yPercent: 0 },
                        { yPercent: 100, duration: duration2, ease: "none" }
                    );

                if (windowWidth >= 768) {
                    const imgWraps = document.querySelectorAll(".gtea_marquee_gallery__img_wrap");

                    imgWraps.forEach(function (imgWrap) {
                        imgWrap.addEventListener("mouseenter", function () {
                            let $parent = imgWrap.closest(".gtea_marquee_gallery__col");

                            if ($parent.classList.contains("v1_mod")) {
                                tl1.pause();
                            }

                            if ($parent.classList.contains("v2_mod")) {
                                tl2.pause();
                            }
                        });

                        imgWrap.addEventListener("mouseleave", function () {
                            let $parent = imgWrap.closest(".gtea_marquee_gallery__col");

                            if ($parent.classList.contains("v1_mod")) {
                                tl1.play();
                            }

                            if ($parent.classList.contains("v2_mod")) {
                                tl2.play();
                            }
                        });
                    });
                }
            }
        }
    };

    // Initialize the widget when it is rendered in the frontend or editor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/gtea_marquee_widget.default', marqueeData.init);
    });

})(jQuery, window.elementorFrontend);
