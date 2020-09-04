/** Show/Hide Left Sidebar **/
function menuAction(btn, menu, status) {
    var item_link = menu.find('a');
    var item_title = menu.find('.title-link');
    var item_has_child = menu.find('#has-child');
    var list_child = menu.find('#child');
    if (status === 'show') {
        /*Show full menu*/
        menu.animate({width: '220px'});
        menu.removeClass('hide-menu');
        btn.parent('#logo').animate({width: '220px'});

        /* Has Child */
        item_has_child.find('span').show();
        list_child.removeClass('list-child-hide');
        list_child.removeAttr('style');

        /* No child */
        item_link.removeClass('hide-title-link');
        item_title.removeClass('hide-title');
        item_title.show();
    }
    else {
        /*Hide menu only show icon*/
        menu.animate({width: '60px'}, 'slow');
        menu.addClass('hide-menu');
        btn.parent('#logo').animate({width: '130px'});

        /* Has Child */
        item_has_child.find('span').hide();
        list_child.hide();
        list_child.addClass('list-child-hide hide-title-link');

        /* No child */
        item_link.addClass('hide-title-link');
        item_title.addClass('hide-title');
        item_title.hide();
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
                $('.page-wrapper').animate({marginLeft: '220px'});
            }
            else {
                menuAction($(this), left_sidebar, 'hide');
                $('.page-wrapper').animate({marginLeft: '60px'});
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
        $(this).parent('li').find('.list-child-hide').hide();
    }
}, ".hide-title-link");

$(document).on({
    mouseleave: function () {
        $(this).next(".list-child-hide").hide();
    }
}, "#has-child");