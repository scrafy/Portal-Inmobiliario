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

    $('.modal').on('hidde.bs.modal', function (e) {
        $("#header").css("z-index", "6000");
    });

    $(window).bind("resize", function (event) {

        var total_padding = Number.parseInt($('#wrapper').css("padding-left").replace("px", "")) +
                Number.parseInt($('#wrapper').css("padding-right").replace("px", ""));
        $('#header').width($('#wrapper').width() + total_padding);
        $('#header').trigger("CheckHeaderFixedHeight");

    });


    // Block scroll for > iPhone 5
    $(document).on('touchmove', 'body.no-scroll', function (e) {
        if ($('.show-mobile-menu').length > 0 || ($('.show-mobile-filter-menu')) && window.innerWidth > 320) {
            e.preventDefault();
        }
    });

});



