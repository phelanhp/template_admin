/** Show/Hide Left Sidebar **/
function menuAction(btn, menu, status) {
    var item_link = menu.find('a');
    var item_title = menu.find('.title-item');
    if (status === 'show') {
        menu.removeClass('hide-menu');
        /* Has Child */
        menu.find('#has-child').removeClass('list-child-hide position-relative');
        menu.find('#child').removeClass('list-child-hide');
        menu.find('#has-child').attr('data-toggle', 'collapse');
        /*Show full menu*/
        menu.animate({width: '220px'});
        setTimeout(function () {
            item_link.removeClass('hide-title-link');
            item_title.removeClass('hide-title');
            item_title.show();
            $('.has-child').show();
            $('#child').removeAttr('style');
        }, 200);
        setTimeout(function () {
            btn.parent('#logo').animate({width: '220px'});
        }, 10);
    }
    else {
        menu.addClass('hide-menu');

        /* Has Child */
        menu.find('#has-child').addClass('list-child-hide position-relative');
        menu.find('#child').addClass('list-child-hide');
        menu.find('#has-child').removeAttr('data-toggle');
        menu.find('#child').hide();
        /*Hide menu only show icon*/
        menu.animate({width: '60px'});
        setTimeout(function () {
            item_link.addClass('hide-title-link');
            item_title.addClass('hide-title');
            item_title.hide();
            $('.has-child').hide();
        }, 100);
        setTimeout(function () {
            btn.parent('#logo').animate({width: '130px'});
        }, 10);
    }
}

$(document).on('click', '#menu-button', function () {
    var left_sidebar = $('.left-sidebar');
    if (left_sidebar.is(":hidden")) {
        left_sidebar.addClass('mobile-view');
        left_sidebar.animate({left: '0px'});
        left_sidebar.show();
    }
    else {
        if (!left_sidebar.hasClass('mobile-view')){
            if (left_sidebar.hasClass('hide-menu')) {
                menuAction($(this), left_sidebar, 'show');
            }
            else {
                menuAction($(this), left_sidebar, 'hide');
            }
        }else{
            left_sidebar.animate({left: '-220px'});
            setTimeout(function () {
                left_sidebar.hide();
            },500);
        }
    }
});

$(document).on({
    mouseenter: function () {
        $(this).find('.hide-title').show();
        $(this).parent('li').find('.list-child-hide').show();
    },
    mouseleave: function () {
        $(this).find('.hide-title').hide();
    }
}, ".hide-title-link");

$(document).on({
    mouseleave: function () {
        $(this).find(".list-child-hide").hide();
    }
}, "#has-child");