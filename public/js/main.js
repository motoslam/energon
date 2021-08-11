$(function() {

    $(window).on('load', function() {
        let phones = [
            { 'mask': '+7 \\ \\ ###-###-##-##' }
        ];

        $('input[type=tel]').inputmask({
            mask: phones,
            greedy: false,
            definitions: {
                '#': {
                    validator: '[0-9]',
                    cardinality: 1
                }
            }
        });
    });


    $('#hamburger-icon').click(function() {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('.mobile-menu').addClass('active');
            $('html').addClass('ov-hidden');
        } else {
            $('.mobile-menu').removeClass('active');
            $('html').removeClass('ov-hidden');
        }
    });

    $('select:not(.js-native)').niceSelect();

    $('.profile').click(function(i) {
        $(this).addClass('active');
        var profileHide = $('.profile-hide');

        if (profileHide.css('display') != 'block') {
            profileHide.show(300);


            var firstClick = true;
            $(document).bind('click.Profile', function(i) {
                if (!firstClick && $(i.target).closest('.profile-hide').length == 0) {
                    profileHide.hide(300);
                    $('.profile').removeClass('active');
                    $(document).unbind('click.Profile');
                }

                firstClick = false;
            });
        }

        i.preventDefault();

    });

    $('#search').autocomplete({
        minChars: 2,
        maxHeight: 410,
        lookupLimit: 13,
        lookup: contractors
    });

    $('.elem-item-list').each(function() {
        if ($(this).closest('.elem-item').attr('style') != 'display: none;') {
            var Len = $(this).find('.elem-item-box').length;
            if (Len == 2) {
                $(this).children('.add-card').addClass('add-card-2');
            } else if (Len == 1) {
                $(this).children('.add-card').addClass('add-card-1');
            }
        }

    });

    // $('.btn-switch').click(function() {
    //     $('.elem-information__btns').find('.active').removeClass('active');
    //     $(this).addClass('active');
    //     $('.elem-information__box').find('.elem-item').hide();
    //     $('#' + $(this).data('switch')).show();
    //     if ($(this).hasClass('active')) {
    //         $('.elem-item-list').each(function() {
    //             if ($(this).closest('.elem-item').attr('style') != 'display: none;') {
    //                 var Len = $(this).find('.elem-item-box').length;
    //                 if (Len == 2) {
    //                     $(this).children('.add-card').addClass('add-card-2');
    //                 } else if (Len == 1) {
    //                     $(this).children('.add-card').addClass('add-card-1');
    //                 }
    //             }
    //         });
    //     }
    // });

    $('.btn-more').click(function(e) {
        e.preventDefault();
        $('.btn-more').removeClass('active');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            // $('.btn-el-items').css({"opacity":"0", "visibility":"visibile"});
        } else {
            $(this).addClass('active');
            // var btnItems = $(this).siblings('.btn-el-items');
            // if (btnItems.css('opacity') == '0' && btnItems.css('visibility') == 'hidden'){
            //     btnItems.css({"opacity":"1", "visibility":"visibile"});
            // }
        }
    });

    $(document).mouseup(function(e) {
        var div2 = $(".btn-el-items");
        if (!div2.is(e.target) &&
            div2.has(e.target).length === 0) {
            $('.btn-more').removeClass('active');
            // $('.btn-el-items').css('opacity', '0');
        }
    });

    // $('.btn-more').click(function(e) {
    //     $(this).addClass('active');
    //     var btnItems = $(this).siblings('.btn-el-items');

    //     if (btnItems.css('opacity') != '1') {
    //         btnItems.css('opacity', '1');


    //         var firstClickBtns = true;
    //         $(document).bind('click.btns', function(e) {
    //             if (!firstClickBtns && $(e.target).closest('.btn-el-items').length == 0) {
    //                 btnItems.css('opacity', '0');
    //                 $('.btn-more').removeClass('active');
    //                 $(document).unbind('click.btns');
    //             }

    //             firstClickBtns = false;
    //         });
    //     }

    //     e.preventDefault();
    // });

    $('#datepicker').datepicker({
        range: 'multiple',
        showWeek: true,
        firstDay: 1,
        dateFormat: 'mm.dd.yyyy',
        onSelect: function(fd, d, picker) {
            $(".start_one").val(fd.split("-")[0]);
            $(".end_one").val(fd.split("-")[1]);
        }
    });

    $('.date-request').datepicker({

    });

    $('.data-messages').datepicker({

    });


    $('.date-new-event').datepicker({

    });



    $('.plans-box__right .add-card').click(function() {
        elementClick = $(this).attr("href")
        destination = $(elementClick).offset().top;
        $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination }, 700);
        setTimeout(() => {
            $('.plans-request .btn-blue').trigger('click');
        }, 500);

        return false;
    });

    // $('#time-from').datepicker({
    //     range: 'multiple',
    //     showWeek: true,
    //     firstDay: 1,
    //     timeFormat: 'HH:mm',
    //     dateFormat: 'mm.dd.yyyy',
    //     onSelect: function(fd, d, picker) {
    //         $(".start_one").val(fd.split("-")[0]);
    //         $(".end_one").val(fd.split("-")[1]);
    //     }
    // });

    // $('.dates-plans').scrollbar({
    //     ignoreOverlay: false,
    //     autoScrollSize: true,
    //     autoUpdate: true
    // });

    // $('.list').addClass('scrollbar-outer');

    // $('.nice-select .list').scrollbar({
    //     ignoreOverlay: false,
    //     autoScrollSize: true,
    //     autoUpdate: false
    // });



    $('.plans-calendar').datepicker({});

    $('.end_one').click(function() {
        $('.start_one').trigger('focus');
    });

    $('.table-tr-btn').click(function() {
        $(this).closest('.table-tr').toggleClass('active');
    });

    $('.btn-filter').click(function() {
        $('.events-dates').toggleClass('active');
        $('body').toggleClass('overlay');
    });

});

$('.plans-request .btn-blue').click(function(e) {
    e.preventDefault();
    $('.plans-request-info').hide();
    $('.plans-request-form').show();
});

$('.plans-request .btn-blue').click(function(e) {
    e.preventDefault();
    $('.plans-request-info').hide();
    $('.plans-request-form').show();
});

$('.btn-new-event').click(function(e) {
    e.preventDefault();
    $('.new-event-box').show();
});

$('.new-event-box__top a').click(function(e) {
    e.preventDefault();
    $('.new-event-box').hide();
});


$('body').on('click', '.pass-show', function(e) {
    e.preventDefault();
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('#user-auth-password').attr('type', 'password');
    } else {
        $(this).addClass('active');
        $('#user-auth-password').attr('type', 'text');
    }
});

$(window).on('load', function() {

    var widthLoad = $(window).width();

    if (widthLoad < '992') {
        $(".events-dates").prepend("<a href='javascript:void(0);' class='filter-btn'></a>");
        $(".events-dates").prepend("<a href='javascript:void(0);' class='filter-remove'>Сбросить</a>");
        $(".events-dates").append("<a href='javascript:void(0);' class='filter-enter'>Применить</a>");
    }

    $('.filter-btn').click(function() {
        $('.events-dates').removeClass('active');
        $('body').removeClass('overlay');
    });

});

$(window).on('load resize', function() {
    var width = $(window).width();


    if (width > '1200') {
        $('.btn-abc').click(function() {
            $(this).toggleClass('active');
            var toggleWidth = $(".alfavite").width() == 1115 ? "0px" : "1115px";
            $('.alfavite').animate({ width: toggleWidth }, 100);
        });
    }

    if (width < '801') {
        $('.menu').insertAfter($('.header-box'));
        $('.header').addClass('load');
    }

    if (width > '800') {
        $('.menu').insertAfter($('.logo'));
    }

    if (width < '516') {
        $('.menu').not('.slick-initialized').slick({
            slidesToShow: 1,
            infinite: false,
            arrows: false,
            variableWidth: true,
            dots: false,
            swipeToSlide: true,
            slidesToScroll: 1
        });
    } else {
        $('.menu').filter('.slick-initialized').slick('unslick');
    }

    if (width < '992') {
        $('.btn-new-event').prependTo($('#tab_1'));
    } else {
        $('.btn-new-event').prependTo($('.events-dates'));
    }

    if (width > '750') {
        // var objToStick = $("#objToStick");
        // var topOfObjToStick = $(objToStick).offset().top;

        let objToStick2 = $("#message-form");
        let topOfObjToStick2 = 0;
        if (objToStick2.length) {
            topOfObjToStick2 = objToStick2.offset().top;
        }

        // $(window).scroll(function() {
        //     var windowScroll = $(window).scrollTop();

        //     if (windowScroll > topOfObjToStick) {
        //         $(objToStick).addClass("topWindow");
        //     } else {
        //         $(objToStick).removeClass("topWindow");
        //     };
        // });

        $(window).scroll(function() {
            var windowScroll = $(window).scrollTop();

            if (windowScroll > topOfObjToStick2) {
                $(objToStick2).addClass("topWindowMess");
            } else {
                $(objToStick2).removeClass("topWindowMess");
            };
        });
    }


});
