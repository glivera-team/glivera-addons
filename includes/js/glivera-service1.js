document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const SPLIT_TEXT_ANIM_CLIP_PATH =
        "polygon(0% 0%, 100% 0%, 100% 107%, 0% 107%)";

    const exist = (elementOrArray) => {
        if (!elementOrArray && elementOrArray !== 0) return false;
        if (elementOrArray.length === 0) {
            return false;
        }
        return true;
    };

    const createSplitTextMarkup = (nodeArray) => {
        if (!nodeArray?.length) return null;

        const splitTextItems = nodeArray?.map(($item) => {
            const splitInner = new SplitText($item, { type: "lines", tag: "span" });
            const splitWrapper = new SplitText($item, { type: "lines", tag: "span" });

            return {
                wrappers: splitWrapper.lines,
                lines: splitInner.lines,
            };
        });

        if (!splitTextItems?.length) return null;

        return {
            wrappers: splitTextItems.map((item) => item.wrappers).flat(1),
            items: splitTextItems.map((item) => item.lines).flat(1),
        };
    };

    const setSplitTextInitialStyles = (wrappers, inners, offset = true) => {
        const tl = gsap.timeline();
        tl.set(wrappers, {
            clipPath: SPLIT_TEXT_ANIM_CLIP_PATH,
        }).set(inners, {
            willChange: "transform",
            yPercent: offset ? 110 : undefined,
        });

        return tl;
    };

    const useAnimationTrigger = ({ animation, target, options = {} }) => {
        const SELECTORS = {
            animTimeline: ".js-anim-timeline",
            animTrigger: ".js-anim-trigger",
        };
        let isScrolled = false;

        if (!target || !animation) {
            return null;
        }

        const $closestTimelineNode =
            target.closest(SELECTORS.animTimeline) || target;
        const $closestTriggerNode = target.closest(SELECTORS.animTrigger) || target;

        const createAnimConfig = ($animElement) => {
            const animConfigDefault = {
                start: "top 75%",
                end: "top 75%",
                duration: 1,
                ease: "none",
                delay: 0,
                offset: 0,
                label: ">",
                markers: false,
                stagger: false,
                ...options,
            };

            return {
                start: $animElement.dataset.animStart || animConfigDefault.start,
                end: $animElement.dataset.animeEnd || animConfigDefault.end,
                ease: $animElement.dataset.animEase || animConfigDefault.ease,
                duration:
                    Number($animElement.dataset.animDuration) ||
                    animConfigDefault.duration,
                delay:
                    Number($animElement.dataset.animDelay) || animConfigDefault.delay,
                mobDelay:
                    Number($animElement.dataset.animMobDelay) || animConfigDefault.delay,
                offset:
                    Number($animElement.dataset.animOffset) || animConfigDefault.offset,
                label: $animElement.dataset.animLabel || animConfigDefault.label,
                stagger: $animElement.dataset.animStagger || animConfigDefault.stagger,
                markers: animConfigDefault.markers,
            };
        };

        const animConfig = createAnimConfig(target);

        if (!$closestTimelineNode.timeline) {
            $closestTimelineNode.timeline = gsap.timeline({
                delay: Number($closestTimelineNode.dataset.timelineDelay) || 0,
            });
        }
        const { timeline } = $closestTimelineNode;
        timeline.addLabel("start");

        ScrollTrigger.create({
            trigger: $closestTriggerNode,
            start: animConfig.start,
            end: animConfig.end,
            once: true,
            markers: animConfig.markers,
            onEnter: () => {
                const isActive = timeline.isActive();
                let { label } = animConfig;

                if (animConfig.stagger) {
                    let { lastTimeMark = 0 } = timeline;
                    const tlDuration = timeline.duration();

                    const labelTimeValue =
                        Number(label.match(/-?\d+(?:\.\d+)?/, "g")?.[0]) || 0; // for time in label
                    const labelSign = !label.includes("-=") ? 1 : -1; // check label sign
                    const labelPosition = !label.includes("<"); // check arrows

                    let labelOrigin = labelPosition ? tlDuration : lastTimeMark;
                    let labelTimelinePosition = labelOrigin + labelTimeValue * labelSign;
                    let safeLabelTimelinePosition = Math.max(
                        timeline.time(),
                        labelTimelinePosition || 0
                    );

                    const animTween = animation(animConfig);

                    timeline.add(animTween, safeLabelTimelinePosition);
                    timeline.lastTimeMark = safeLabelTimelinePosition;
                } else {
                    if (
                        (label.includes("<") || label.includes("-=")) &&
                        !isActive &&
                        isScrolled
                    ) {
                        label = ">";
                    }

                    timeline.add(animation(animConfig), label);
                    timeline.play();
                }
            },
        });
    };

    const gridItemsAnim = () => {
        const SELECTORS = {
            item: ".js-grid-item",
            img: ".js-grid-img",
            imgIn: ".js-grid-img-in",
            title: ".js-grid-title",
            text: ".js-grid-text",
        };

        const $items = document.querySelectorAll(SELECTORS.item);

        if (!exist($items)) return;

        const createAnimation = () => {
            const setInitialValues = ({ $img, $imgIn, titleSplit, textSplit }) => {
                gsap.set($img, {
                    clipPath: "polygon(0 0, 100% 0, 100% 0%, 0 0%)",
                });
                gsap.set($imgIn, {
                    scale: 1.2,
                });
                gsap.set(textSplit?.items, {
                    opacity: 0,
                });

                if (titleSplit.wrappers || textSplit.wrappers) {
                    setSplitTextInitialStyles(
                        [...titleSplit.wrappers, ...textSplit.wrappers],
                        [...titleSplit.items, ...textSplit.items]
                    );
                }
            };

            [...$items].map(($item) => {
                const $img = $item.querySelector(SELECTORS.img);
                const $imgIn = $item.querySelector(SELECTORS.imgIn);
                const $title = $item.querySelector(SELECTORS.title);
                const $text = $item.querySelector(SELECTORS.text);
                const titleSplit = createSplitTextMarkup([$title]);
                const textSplit = createSplitTextMarkup([$text]);

                setInitialValues({
                    $img,
                    $imgIn,
                    titleSplit,
                    textSplit,
                });

                useAnimationTrigger({
                    target: $item,

                    animation: (animConfig) => {
                        const delay =
                            window.innerWidth > 768 ? animConfig.delay : animConfig.mobDelay;

                        gsap
                            .timeline({
                                delay,
                            })
                            .to($imgIn, {
                                scale: 1,
                                ease: "power3.out",
                                duration: 1.6,
                            })
                            .to(
                                $img,
                                {
                                    clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
                                    duration: 1.6,
                                    ease: "power3.out",
                                },
                                "<"
                            )
                            .to(
                                titleSplit?.items,
                                {
                                    yPercent: 0,
                                    stagger: 0.05,
                                },
                                "-=.7"
                            )
                            .to(
                                textSplit?.items,
                                {
                                    opacity: 1,
                                    yPercent: 0,
                                    stagger: 0.05,
                                },
                                "-=.5"
                            );
                    },
                });
            });
        };

        createAnimation();
    };

    gridItemsAnim();

    const splitTextAnimation = () => {
        const $animTargets = document.querySelectorAll(".js-split-item");

        if (!$animTargets.length) return null;

        [...$animTargets].map(($target) => {
            const splitText = createSplitTextMarkup([$target]);
            if (!splitText) return null;

            const { wrappers, items } = splitText;

            setSplitTextInitialStyles(wrappers, items);

            useAnimationTrigger({
                target: $target,
                options: {
                    ease: "power2.inOut",
                    duration: 0.8,
                },
                animation: (animConfig) => {
                    gsap.timeline().to(items, {
                        yPercent: 0,
                        stagger: 0.15,
                        duration: animConfig.duration,
                        delay: animConfig.delay,
                        ease: animConfig.ease,
                    });
                },
            });
        });
    };

    splitTextAnimation();
});
