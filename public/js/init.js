var conf = {
    endpoint: location.protocol + "//" + location.host + "/"
};


(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);


if (!Object.prototype.watch)
{
    Object.defineProperty(Object.prototype, "watch",
            {
                enumerable: false,
                configurable: true,
                writable: false,
                value: function (prop, handler) {
                    var oldval = this[prop];
                    var newval = oldval;
                    getter = function ()
                    {
                        return newval;
                    },
                            setter = function (val)
                            {
                                oldval = newval;
                                return newval = handler.call(this, prop, oldval, val);
                            };
                    if (delete this[prop]) {
                        Object.defineProperty(this, prop,
                                {
                                    get: getter,
                                    set: setter,
                                    enumerable: true,
                                    configurable: true
                                });
                    }
                }
            });
}

if (!Object.prototype.unwatch)
{
    Object.defineProperty(Object.prototype, "unwatch",
            {
                enumerable: false,
                configurable: true,
                writable: false,
                value: function (prop)
                {
                    var val = this[prop];
                    delete this[prop];
                    this[prop] = val;
                }
            });
}

$(document).ready(function () {

    home_api.SetUpMobileEvents();
    footer.SetUp();
    
    var total_padding = Number.parseInt($('#wrapper').css("padding-left").replace("px", "")) +
        Number.parseInt($('#wrapper').css("padding-right").replace("px", ""));

    $('#header').width($('#wrapper').width() + total_padding);
    if ($(window).width() >= 640) {

        $("#separator").css("margin-top", $('#header').height() + "px");
    } else {
        $("#separator").css("margin-top", "0px");
    }
    $('#header').bind("CheckHeaderFixedHeight", function (event) {
        if ($(window).width() >= 640) {

            $("#separator").css("margin-top", $('#header').height() + "px");
        } else {
            $("#separator").css("margin-top", "0px");
        }
    });

    //FIXED MODALS

    $('.modal').on('show.bs.modal', function (e) {
        $("#header").css("z-index", "-1");
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $("#header").css("z-index", "6000");
    });
});

$(window).bind("resize", function (event) {

    var total_padding = Number.parseInt($('#wrapper').css("padding-left").replace("px", "")) +
            Number.parseInt($('#wrapper').css("padding-right").replace("px", ""));
    $('#header').width($('#wrapper').width() + total_padding);
    $('#header').trigger("CheckHeaderFixedHeight");

});

$("#contactus").bind("click", null, function (event) {

    $(this).parent().siblings(".show-flex").toggleClass("show-flex");
    $(this).siblings(".selected-red").toggleClass("selected-red");
    $("div[data-target='" + $(this).attr("id") + "']").toggleClass("show-flex")
    if (!$(this).hasClass("selected-red")) {
        $(this).toggleClass("selected-red");
    }
});
$("#openinghours").bind("click", null, function (event) {

    $(this).parent().siblings(".show-flex").toggleClass("show-flex");
    $(this).siblings(".selected-red").toggleClass("selected-red");
    $("div[data-target='" + $(this).attr("id") + "']").toggleClass("show-flex");
    if (!$(this).hasClass("selected-red")) {
        $(this).toggleClass("selected-red");
    }
});
$("#emailform").bind("click", null, function (event) {

    $(this).parent().siblings(".show-flex").toggleClass("show-flex");
    $(this).siblings(".selected-red").toggleClass("selected-red");
    $("div[data-target='" + $(this).attr("id") + "']").toggleClass("show-flex");
    if (!$(this).hasClass("selected-red")) {
        $(this).toggleClass("selected-red");
    }
});

$("#show-sprite").bind("click", function (event) {

    var ladverts = $("#l-adverts");
    if (!ladverts.hasClass("l-adverts"))
    {
        ladverts.children().not(".l-pagination").toggleClass("l-advert-landscape").toggleClass("l-advert");
        ladverts.toggleClass("l-adverts-landscape").toggleClass("l-adverts");
    }
    $('#show-landscape a').removeClass('active');
    $(this).find('a').addClass('active');
});

$("#show-landscape").bind("click", function (event) {

    var ladverts = $("#l-adverts");
    if (!ladverts.hasClass("l-adverts-landscape"))
    {
        $("#l-adverts").children().not(".l-pagination").toggleClass("l-advert").toggleClass("l-advert-landscape");
        $("#l-adverts").toggleClass("l-adverts").toggleClass("l-adverts-landscape");
    }
    $('#show-sprite a').removeClass('active');
    $(this).find('a').addClass('active');
});

