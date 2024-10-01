document.addEventListener("DOMContentLoaded", () => {
    const SELECTORS = {
        section: ".js-gtea-pricing",
        input: ".js-gtea-pricing-input",
        priceContainer: ".js-gtea-pricing-container",
    };

    const exist = (elementOrArray) => {
        if (!elementOrArray && elementOrArray !== 0) return false;
        if (elementOrArray.length === 0) {
            return false;
        }
        return true;
    };

    const togglePricing = ({ checked, $containers }) => {
        $containers.forEach(($container) => {
            const $containerEl = $container;

            if (checked) {
                if ($container.dataset.yearly)
                    $containerEl.innerHTML = $container.dataset.yearly;
            } else {
                if ($container.dataset.monthly)
                    $containerEl.innerHTML = $container.dataset.monthly;
            }
        });
    };

    const $sections = document.querySelectorAll(SELECTORS.section);
    if (!exist($sections)) return;

    $sections.forEach(($section) => {
        const $input = $section.querySelector(SELECTORS.input);
        if (!exist($input)) return;

        const $containers = $section.querySelectorAll(SELECTORS.priceContainer);
        if (!exist($containers)) return;

        $input.addEventListener("change", () =>
            togglePricing({ checked: $input.checked, $containers })
        );
    });
});
