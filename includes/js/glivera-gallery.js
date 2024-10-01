document.addEventListener("DOMContentLoaded", () => {
    const SELECTORS = {
        card: ".js-team-card",
    };
    const CLASSNAMES = {
        active: "gtea_team_card--active_state",
    };

    const exist = (elementOrArray) => {
        if (!elementOrArray && elementOrArray !== 0) return false;
        if (elementOrArray.length === 0) {
            return false;
        }
        return true;
    };

    const $cards = document.querySelectorAll(SELECTORS.card);
    if (!exist($cards)) return;

    const deleteActiveClasses = ($array) => {
        const $items = $array || $cards;

        $items.forEach(($item) => {
            $item.classList.remove(CLASSNAMES.active);
        });
    };

    const handleButtonClick = ($card) => {
        if ($card.classList.contains(CLASSNAMES.active)) {
            $card.classList.remove(CLASSNAMES.active);
        } else {
            deleteActiveClasses();
            $card.classList.add(CLASSNAMES.active);
        }
    };

    const handleDocumentClick = ($target) => {
        const $card = $target.closest(SELECTORS.card);

        if (exist($card)) {
            handleButtonClick($card);
        } else {
            const $activeCards = document.querySelectorAll(`.${CLASSNAMES.active}`);
            if (!exist($activeCards)) return;
            deleteActiveClasses($activeCards);
        }
    };

    document.addEventListener("click", (e) => handleDocumentClick(e.target));
});
