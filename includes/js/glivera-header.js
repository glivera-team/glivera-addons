document.addEventListener("DOMContentLoaded", () => {
    const isFunction = (func) => {
        return func instanceof Function;
    };

    const exist = (elementOrArray) => {
        if (!elementOrArray && elementOrArray !== 0) return false;
        if (elementOrArray.length === 0) {
            return false;
        }
        return true;
    };

    const debounce = (delay, fn) => {
        let timerId;
        return (...args) => {
            if (timerId) {
                clearTimeout(timerId);
            }
            timerId = setTimeout(() => {
                fn(...args);
                timerId = null;
            }, delay);
        };
    };

    const onWindowResize = (cb) => {
        if (!cb && !isFunction(cb)) return;

        const handleResize = () => {
            cb();
        };

        window.addEventListener("resize", debounce(15, handleResize));

        handleResize();
    };

    const onWindowScroll = (cb) => {
        if (!cb && !isFunction(cb)) return;

        const handleScroll = () => {
            cb(window.scrollY);
        };

        window.addEventListener("scroll", debounce(15, handleScroll));

        handleScroll();
    };

    const getWindowSize = () => {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        return {
            windowWidth,
            windowHeight,
        };
    };

    const BREAKPOINTS = {
        mediaPoint1: 1024,
        mediaPoint2: 768,
        mediaPoint3: 480,
        mediaPoint4: 320,
    };

    const SELECTORS = {
        header: ".js-gtea-header",
        submenu: ".js-gtea-header-submenu",
        submenuContent: ".js-gtea-header-submenu-content",
        submenuTrigger: ".js-gtea-header-submenu-trigger",
        menuTrigger: ".js-gtea-header-menu-trigger",
    };

    const CLASSNAMES = {
        headerScrollState: "gtea_header--scroll_state",
        bodyOpenMenuState: "body--open_menu_state",
        itemSubmenuOpen: "gtea_header__item--active_state",
    };

    const $body = document.body;
    const $header = document.querySelector(SELECTORS.header);
    const $menuTriggers = document.querySelectorAll(SELECTORS.menuTrigger);
    const $submenus = document.querySelectorAll(SELECTORS.submenu);

    if (!exist($header)) return;

    let isMenuOpen = false;
    let prevWidth = window.innerWidth;
    const scrollValue = 10;

    const headerScroll = (scrollY) => {
        const hasHeaderScrollState = $header.classList.contains(
            CLASSNAMES.headerScrollState
        );

        if (scrollY > scrollValue && !hasHeaderScrollState) {
            $header.classList.add(CLASSNAMES.headerScrollState);
        } else if (scrollY <= scrollValue && hasHeaderScrollState) {
            $header.classList.remove(CLASSNAMES.headerScrollState);
        }
    };

    const handleTriggerClick = () => {
        if (!isMenuOpen) {
            $body.classList.add(CLASSNAMES.bodyOpenMenuState);
            $body.style.overflow = "hidden";
            isMenuOpen = true;
        } else {
            $body.classList.remove(CLASSNAMES.bodyOpenMenuState);
            $body.style.overflow = "visible";
            isMenuOpen = false;
        }
    };

    const closeAllAccordions = () => {
        const $activeAcc = document.querySelector(
            `${SELECTORS.submenu}.${CLASSNAMES.itemSubmenuOpen}`
        );
        if (!exist($activeAcc)) return;

        const $content = $activeAcc.querySelector(SELECTORS.submenuContent);
        if (!exist($content)) return;

        $activeAcc.classList.remove(CLASSNAMES.itemSubmenuOpen);
        $content.style.maxHeight = "0px";
    };

    const toggleAcc = (e, $submenu, $content) => {
        e?.preventDefault();

        const $contentEl = $content;

        if ($submenu.classList.contains(CLASSNAMES.itemSubmenuOpen)) {
            $submenu.classList.remove(CLASSNAMES.itemSubmenuOpen);
            $contentEl.style.maxHeight = "0px";
        } else {
            closeAllAccordions();
            $submenu.classList.add(CLASSNAMES.itemSubmenuOpen);
            $contentEl.style.maxHeight = `${$contentEl.scrollHeight}px`;
        }
    };

    const headerResize = () => {
        const currentWidth = window.innerWidth;

        if (currentWidth === prevWidth || currentWidth >= BREAKPOINTS.mediaPoint1)
            return;

        const $activeAcc = document.querySelector(
            `${SELECTORS.submenu}.${CLASSNAMES.itemSubmenuOpen}`
        );
        if (!exist($activeAcc)) return;

        const $content = $activeAcc.querySelector(SELECTORS.submenuContent);
        if (!exist($content)) return;

        $content.style.maxHeight = `${$content.scrollHeight}px`;

        prevWidth = currentWidth;
    };

    const initializeEventListeners = () => {
        if (exist($menuTriggers)) {
            $menuTriggers.forEach(($trigger) => {
                $trigger.addEventListener("click", handleTriggerClick);
            });
        }

        if (!exist($submenus)) return;

        $submenus.forEach(($submenu) => {
            const $trigger = $submenu.querySelector(SELECTORS.submenuTrigger);
            const $content = $submenu.querySelector(SELECTORS.submenuContent);
            if (!exist($trigger) || !exist($content)) return;

            const mobileClickHandler = (e) => toggleAcc(e, $submenu, $content);
            const { windowWidth } = getWindowSize();

            if (windowWidth >= BREAKPOINTS.mediaPoint1) {
                $trigger.removeEventListener("click", mobileClickHandler);
            } else {
                $trigger.addEventListener("click", mobileClickHandler);
            }
        });
    };

    onWindowScroll(headerScroll);
    onWindowResize(headerResize);
    onWindowResize(initializeEventListeners);
});
