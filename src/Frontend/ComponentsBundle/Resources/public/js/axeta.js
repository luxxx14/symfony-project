/**
 * Created by Sergey on 08.10.2015.
 */
console.log("axeta.js");
$(document).ready(function() {
    var $siteBar = $('.main-sidebar'),
        $tabs = $("ul.tabs li"),
        dep = $siteBar.length > 0 ? {left: $siteBar.offset().left, width: $siteBar.width()} : {left: 0, width: 0},
        currentWidth = 0, onWidth = 961;

    function init() {
        initEvents();
        onResize();
    }

    function initEvents() {
        $tabs.click(function(e) {
            if (!$(this).hasClass("active")) {
                var tabId = '#' + $(this).data('for');

                $(this).parent().find('li.active').removeClass("active");
                $(this).addClass("active");

                $(tabId).parent().find('li.active').removeClass("active");
                $(tabId).addClass("active");
            }
        });
        $('.spoiler-action').on('click', function(){
            $(this).parent().find('.spoiler-body').slideToggle(100);
            $(this).toggleClass('active');
            return false;
        });
        $( window ).resize(function() {
            onResize();
        });
        $('.menu-trigger').click(function(e) {
            if(currentWidth < onWidth)
                $siteBar.toggleClass('open');
            else
                $siteBar.toggleClass('collapse');
            return false;
        });
        $(window).click(function(e) {
            if($siteBar.hasClass('open') && !$(e.target).closest('.main-sidebar').length) {
                $siteBar.removeClass('open');
            }
        });
    }

    $.fn.center = function (options) {
        options = $.extend({
            parent: window,
            left: 0
        }, options);
        return $(this).each(function() {
            var parent = options.parent,
                left = options.left;
            $(this).css("position","absolute");
            $(this).css("top", Math.max(0, (($(parent).height() - $(this).outerHeight()) / 2) +
                    $(parent).scrollTop()) + "px");
            $(this).css("left", Math.max(0, (($(parent).width() - $(this).outerWidth()) / 2) +
                    $(parent).scrollLeft()) + left/2 + "px");
            return $(this);
        });
    };

    function onResize () {
        $('.fix-center').center({
            left: dep.left + dep.width
        });
        currentWidth = window.innerWidth;
    }

    function triggerPosition () {

    }

    init();
});