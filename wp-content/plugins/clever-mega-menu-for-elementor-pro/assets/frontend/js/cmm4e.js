/**
 * cmm4e.js
 *
 * @version 1.0.0
 * @author CleverSoft <hello.cleversoft@gmail.com>
 */
(function($) {
    'use strict';

    /**
     * Main class
     *
     * @param {Object} menu
     */
    function Cmm4e(menu) {
        var mask = null,
            toggle = null,
            config = menu.data('config');

        var $el = {
            container: null, // A custom container loaded from menu skin
            cmm4eContainer: menu.parent(), // Default container
            items: menu.find('.cmm4e-menu-item')
        };

        if (config.mobile.toggleDisable === '1' && config.mobile.toggleTrigger) {
            var trigger = $(config.mobile.toggleTrigger);
            if (trigger.length === 1) {
                toggle = trigger;
            }
        }

        if (config.container) {
            var container = $(config.container);
            if (container.length === 1) {
                $el.container = container;
            }
        }

        if (!$el.container) {
            $el.container = $el.cmm4eContainer;
        }

        /**
         * Insert nav icons, item toggle buttons, mask layer for off-canvas menu.
         */
        function fetchUI() {
            // Ensure mega panels are wide as container in horizontal orientation.
            if ('horizontal' === config.desktop.orientation && !cmm4eFrontendConfig.isMobile && !$el.container.hasClass('cmm4e-container')) {
                var cWidth = $el.container.width();
                // $el.container.css({position: 'relative'});
                menu.find('.cmm4e-content-container').each(function(i) {
                    var t = $(this),
                        item = t.parent('li');
                    if (cmm4eFrontendConfig.iRTL) {
                        // t.css({width: cWidth + parseFloat(item.css('padding-right')) + 'px'});
                        t.css({
                            width: cWidth + 'px'
                        });
                    } else {
                        // t.css({width: cWidth + parseFloat(item.css('padding-left')) + 'px'});
                        t.css({
                            width: cWidth + 'px'
                        });
                    }
                });
            }

            // Fetch toggle button.
            if (!toggle && config.mobile.animation !== 'none') {
                var btn = '<div class="cmm4e-toggle-wrapper"><button class="cmm4e-toggle">',
                    icon = '<span class="toggle-icon-open ' + config.mobile.toggleIconOpen + '"></span><span class="toggle-icon-close ' + config.mobile.toggleIconClose + '"></span>';

                if (!cmm4eFrontendConfig.isRTL) {
                    btn = btn + icon + '<span class="toggle-text" style="display:inline-block; margin-left: 5px">' + config.mobile.toggleMenuText + '</span>';
                } else {
                    btn = btn + '<span class="toggle-text" style="display:inline-block; margin-right: 5px">' + config.mobile.toggleMenuText + '</span>' + icon;
                }

                btn += '</button></div>';

                $el.cmm4eContainer.prepend(btn);

                toggle = $el.cmm4eContainer.find('.cmm4e-toggle');
            }

            // Ensure menu does not overlap toggle and always fit into the viewport.
            if (toggle && 'slide-down' === config.mobile.animation) {
                var cPos = $el.container.offset(),
                    cParent = $el.container.parent();

                // if (menu.offset().top < (toggle.offset().top + toggle.outerHeight())) {
                //     menu.css({
                //         marginTop: toggle.outerHeight()
                //     });
                // }

                if ($(window).width() < config.breakpoint) {
                    if (cParent.hasClass('elementor-nav-menu--dropdown elementor-nav-menu__container')) {
                        cParent.css({
                            overflow: 'visible'
                        });
                    }

                    menu.css({
                        left: -cPos.left
                    });
                }
            }

            // Fetch off-canvas mask.
            if ('off-canvas' === config.mobile.animation) {
                var canvasMask = $el.cmm4eContainer.find('> .cmm4e-off-canvas-mask');
                if (!canvasMask.length) {
                    $el.cmm4eContainer.append('<div role="presentation" class="cmm4e-off-canvas-mask"></div>');
                    mask = $el.cmm4eContainer.find('> .cmm4e-off-canvas-mask');
                } else {
                    mask = canvasMask;
                }
            }

            // Fetch menu items' toggle.
            $el.items.each(function(i) {
                var item = $(this);

                if (item.hasClass('menu-item-has-children') && !item.hasClass('cmm4e-hide-sub-on-mobile')) {
                    item.append('<span class="cmm4e-item-toggle cs-font clever-icon-plus"></span>');
                }
            });
        }

        function toggleMenu(e) {
            e.preventDefault();
            e.stopPropagation();

            var target = $(e.currentTarget);

            $el.cmm4eContainer.toggleClass('cmm4e-active');

            if ('off-canvas' === config.mobile.animation) {
                if (target.hasClass('cmm4e-off-canvas-mask')) {
                    $el.cmm4eContainer.removeClass('cmm4e-active');
                    toggle.toggleClass('toggled');
                } else {
                    target.toggleClass('toggled');
                }
            } else {
                menu.slideToggle(250);
                target.toggleClass('toggled');
            }

            if ($el.cmm4eContainer.hasClass('cmm4e-active')) {
                $(document).trigger('cmm4e_menu_expanded');
            } else {
                $(document).trigger('cmm4e_menu_collapsed');
            }
        }

        /**
         * Toggle item
         */
        var prevItem = null;

        function toggleItem(e) {
            var btn = $(e.target),
                item = btn.parent(),
                itemSub = item.find('> .cmm4e-sub-container');

            if (prevItem && !item.is(prevItem)) {
                if (itemSub.length && !item.hasClass('cmm4e-item-depth-0')) {

                } else {
                    prevItem.find('.cmm4e-item-toggle').css({
                        transform: 'none'
                    });
                    prevItem.find('.menu-item-has-children').removeClass('cmm4e-item-expanded');
                    if (prevItem.hasClass('cmm4e-mega')) {
                        prevItem.find('> .cmm4e-content-container').slideUp();
                    } else {
                        prevItem.find('.cmm4e-sub-container').slideUp();
                    }
                    prevItem.removeClass('cmm4e-item-expanded');
                }
            }

            item.toggleClass('cmm4e-item-expanded');

            if (item.hasClass('cmm4e-mega')) {
                item.find('> .cmm4e-content-container').slideToggle();
            } else {
                item.find('> .cmm4e-sub-container').slideToggle();
            }

            if (item.hasClass('cmm4e-item-expanded')) {
                btn.css({
                    transform: 'rotate(225deg)'
                });
            } else {
                btn.css({
                    transform: 'none'
                });
            }

            if (item.hasClass('cmm4e-item-depth-0')) {
                prevItem = item;
            }
        }

        /**
         * Bind events
         */
        function bindEvents() {
            // Menu Toggle
            if (toggle && config.mobile.animation !== 'none') {
                toggle.on('click', toggleMenu);
            }

            // Off-Canvas Mask
            if (mask) {
                mask.on('click', toggleMenu);
            }

            // Item Toggle
            menu.find('.cmm4e-item-toggle').on('click', toggleItem);
        }

        // Init
        fetchUI();
        bindEvents();
    }

    // Fetch menus
    $(function() {
        $('.cmm4e').each(function(i) {
            Cmm4e($(this));
        });
    })
}(jQuery))
