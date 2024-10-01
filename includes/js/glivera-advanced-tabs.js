(function ($, elementor) {
    'use strict';

    var tabsDataCollection = {
        init: function ($scope) {
            console.log('Widget is being initialized');
            let $tabButtons = $scope.find('.gtea_advanced_tabs__button');
            let $tabPanels = $scope.find('.gtea_advanced_tabs__panel');

            if ($tabButtons.length && $tabPanels.length) {
                $tabButtons.each(function () {
                    let $button = $(this);
                    $button.on('click', function () {
                        let tab = $button.data('tab');
                        $tabButtons.removeClass('active');
                        $tabPanels.removeClass('active');

                        $button.addClass('active');
                        $('#' + tab).addClass('active');
                    });
                });
            } else {
                console.log('No tab buttons or panels found within widget scope.');
            }
        }
    };

    // Initialize the widget when it is rendered in the frontend or editor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/gtea_advanced_tabs_widget.default', tabsDataCollection.init);
    });

})(jQuery, window.elementorFrontend);
