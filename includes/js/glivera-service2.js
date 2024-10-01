document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const exist = (elementOrArray) => {
        if (!elementOrArray && elementOrArray !== 0) return false;
        if (elementOrArray.length === 0) {
            return false;
        }
        return true;
    };

    const SELECTORS = {
        translateEl: ".js-translate-el",
    };

    const $translateEl = document.querySelectorAll(SELECTORS.translateEl);
    if (!exist($translateEl)) return;

    const translateAnimation = ($translateEl) => {
        const mm = gsap.matchMedia();

        $translateEl.forEach(($el) => {
            const direction = $el.dataset.direction;

            const translate = gsap.fromTo(
                $el,
                { xPercent: direction === "left" ? 150 : -150 },
                { xPercent: 0, duration: 1 }
            );

            mm.add(`(min-width: 1024px)`, () => {
                ScrollTrigger.create({
                    trigger: $el,
                    start: "10% center",
                    animation: translate,
                    ease: "power1.out",
                });
            });

            mm.add(`(max-width: 1023px)`, () => {
                ScrollTrigger.create({
                    trigger: $el,
                    start: "top center",
                    animation: translate,
                    ease: "power1.out",
                });
            });
        });
    };

    translateAnimation($translateEl);
});
