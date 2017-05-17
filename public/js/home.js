var home_api = (function () {

    function HomeApi() {

        var querystring = "";
        var param_filters = {

            sortby: null,
            area: null,
            minprice: null,
            maxprice: null,
            numbeds: null,
            furnished: null
        };
        var final_parameters = {

            type_property: [],
            sortby: null,
            area: null,
            minprice: null,
            maxprice: null,
            numbeds: null,
            furnished: null
        };
        for (var prop in param_filters)
        {
            param_filters.watch(prop, function (prop, oldval, newval) {

                home_api.ApplyFilters(prop, newval);
            });
        }

        this.GetParameterFilters = function () {

            return param_filters;
        };
        this.GetFinalParameters = function () {

            return final_parameters;
        };
        this.GetQueryString = function () {

            return querystring;
        };

    }
    ;

    HomeApi.prototype.SetInfoWindow = function (content, marker, map)
    {
        var infowindow = new google.maps.InfoWindow({
            content: content,
            maxWidth: 350

        });
        marker.addListener('click', function () {
            infowindow.open(map, this);
        });
    };


    HomeApi.prototype.SetUpMobileEvents = function ()
    {
        var limitminprice = parseInt($("#input_minprice").val());
        var limitmaxprice = parseInt($("#input_maxprice").val());
        var minprice = limitminprice;
        var maxprice = limitmaxprice;

        $('#show-menu-filter').click(function () {
            $('body').scrollTop(0).toggleClass('no-scroll');
            $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
            $(".filter-menu").toggleClass("show-mobile-filter-menu");
        });

        $('.filter-menu-left-arrow, .filter-menu-header-list-item').click(function () {
            $('body').removeClass('no-scroll');
            $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
            $(".filter-menu").toggleClass("show-mobile-filter-menu");
        });

        $('#show-menu-mobile').click(function () {
            $('body').scrollTop(0).toggleClass('no-scroll');
            $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
            $(".mobile-menu").toggleClass("show");
            setTimeout(function () {
                $(".mobile-menu").toggleClass("show-mobile-menu");
            }, 100);
        });

        $('.mobile-menu-header-right-arrow, .mobile-menu-header-list-item').click(function () {
            $('body').removeClass('no-scroll');
            $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
            $(".mobile-menu").toggleClass("show-mobile-menu");
            setTimeout(function () {
                $(".mobile-menu").toggleClass("show");
            }, 500);
        });

        $(".close-mobile-menu").click(function () {
            $(".mobile-menu").toggleClass("show");
            $('.mobile-menu').toggleClass("show-mobile-menu");
            $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
        });

        $(".menu-nav-item-mobile").each(function (i, e) {
            $(this).bind("click", null, function (event) {
                $('.mobile-menu').toggleClass("show-mobile-menu");
                $(".wrapper-back-black").toggleClass("wrapper-back-black-init");
            });
        });

        $("#filterclean_mob").bind("click", null, function (event) {
            home_api.DeleteParamFilters();
        });

        $("#type-property-mob").multiselect({classes: "my-multiselect"});

        $("#type-property-mob").on("multiselectcheckall", function (event, ui) {
            home_api.FinalParameters().type_property.length = 0;
            $($(this).multiselect("getChecked")).each(function (i, e) {
                home_api.FinalParameters().type_property.push(e.defaultValue);
            });
            home_api.ApplyFilters("type_property", "");

            $("#type-property-mob").multiselect("getChecked").each(function (i, e) {
                $("#type-property").multiselect("widget").find(":checkbox").each(function (i, e) {

                    $(this)[0].checked = true;

                });
            });
            $("#type-property").siblings("button").first().children("span").eq(1).text($("#type-property").multiselect("widget").find(":checkbox").length + " selected");

        });

        $("#type-property-mob").on("multiselectuncheckall", function (event, ui) {
            home_api.FinalParameters().type_property.length = 0;
            home_api.ApplyFilters("type_property", "");
            $("#type-property").multiselect("uncheckAll");
        });

        $("#type-property-mob").on("multiselectclick", function (event, ui) {
            var index = jQuery.inArray(ui.value, home_api.FinalParameters().type_property, 0);
            var total_properties_selected = 0;
            if (index === -1) {
                home_api.FinalParameters().type_property.push(ui.value);
            } else {
                home_api.FinalParameters().type_property.splice(index, 1);
            }
            home_api.ApplyFilters("type_property", "");
            $("#type-property").multiselect("widget").find(":checkbox[value='" + ui.value + "']").first()[0].checked = ui.checked;

            $("#type-property").multiselect("getChecked").each(function (i, e) {
                total_properties_selected++;
            });
            $("#type-property").siblings("button").first().children("span").eq(1).text(total_properties_selected + " selected");
        });

        $("#location-mob").selectmenu({
            change: function (event, data) {
                if (data.item.index === home_api.FinalParameters().location) {
                    home_api.ParametersFilter().area = null;
                } else {
                    if (data.item.label !== "--Any Area--") {
                        home_api.ParametersFilter().area = data.item.value;
                    } else
                        home_api.ParametersFilter().area = null;
                }
            }
        });

        $("#numbeds-mob").children().each(function (index, el) {

            $(this).bind("click", null, function (event) {
                if ($(this).text().toLowerCase() === home_api.FinalParameters().numbeds) {
                    home_api.ParametersFilter().numbeds = null;
                } else {
                    home_api.ParametersFilter().numbeds = $(this).text().toLowerCase();
                }
                $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
                $(this).toggleClass("filter-prop-selected");
            });
        });

        $("#furnished-mob").children().each(function (index, el) {

            $(this).bind("click", null, function (event) {
                if ($(this).text().toLowerCase() === home_api.FinalParameters().furnished) {
                    home_api.ParametersFilter().furnished = null;
                } else {
                    home_api.ParametersFilter().furnished = $(this).text().toLowerCase();
                }
                $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
                $(this).toggleClass("filter-prop-selected");
            });
        });

        var conf_slider_mobile = {
            range: true,
            min: limitminprice,
            max: limitmaxprice,
            values: [minprice, maxprice],
            slide: function (event, ui) {
                $("#mobile-min-price").text(String.fromCharCode('163') + " " + ui.values[0]);
                $("#mobile-max-price").text(String.fromCharCode('163') + " " + ui.values[1]);
                home_api.ParametersFilter().minprice = ui.values[0];
                home_api.ParametersFilter().maxprice = ui.values[1];
            }
        };

        $("#filter-mobile-slider-range").slider(conf_slider_mobile);

        var queryfilter = $("#queryfilter").attr("value");
        if (queryfilter !== "") {
            var params = this.GetParameterFilters();
            var v = queryfilter.split("&");
            var total_properties_selected = 0;
            $(v).each(function (i, e) {
                var t = e.split("=");
                switch (t[0])
                {
                    case "type_property[]":
                        $("#type-property-mob").multiselect("widget").find(":checkbox").each(function (i, e) {
                            if ($(this).attr("value") === t[1]) {
                                $(this).attr('checked', true);
                                total_properties_selected++;
                            }
                        });
                        $("#type-property-mob").siblings("button").first().children("span").eq(1).text(total_properties_selected + " selected");
                        break;
                    case "minprice":
                        params.minprice = t[1];
                        minprice = parseInt(t[1]);
                        break;
                    case "maxprice":
                        params.maxprice = t[1];
                        maxprice = parseInt(t[1]);
                        break;
                    case "sortby":
                        params.sortby = t[1];
                        var order = $("#select-order-by");
                        order[0].selectedIndex = $("#select-order-by > option[value='" + t[1] + "']")[0].index;
                        $("#select-order-by").selectmenu("refresh");
                        break;
                    case "numbeds":
                        params.numbeds = t[1];
                        $("#numbeds-mob > div:contains(" + t[1] + ")").toggleClass("filter-prop-selected");
                        break;
                    case "furnished":
                        params.furnished = t[1];
                        $("#furnished-mob > div[data-value='" + t[1] + "']").toggleClass("filter-prop-selected");
                        break;
                    case "area":
                        params.area = t[1];
                        $("#location-mob > option[value='" + t[1] + "']").attr("selected", "");
                        $("#location-mob").selectmenu("refresh");
                        break;
                }
            });
        }
    };

    HomeApi.prototype.SetUp = function () {

        var limitminprice = parseInt($("#input_minprice").val());
        var limitmaxprice = parseInt($("#input_maxprice").val());
        var minprice = limitminprice;
        var maxprice = limitmaxprice;

        $("#show-sprite").click(function (event) {
            var ladverts = $("#l-adverts");
            if (!ladverts.hasClass("l-adverts"))
            {
                ladverts.children().not(".l-pagination").toggleClass("l-advert-landscape").toggleClass("l-advert");
                ladverts.toggleClass("l-adverts-landscape").toggleClass("l-adverts");
            }
            $('#show-landscape a').removeClass('active');
            $('#show-sprite a').addClass('active');
        });

        $("#show-landscape").click(function (event) {
            var ladverts = $("#l-adverts");
            if (!ladverts.hasClass("l-adverts-landscape"))
            {
                $("#l-adverts").children().not(".l-pagination").toggleClass("l-advert").toggleClass("l-advert-landscape");
                $("#l-adverts").toggleClass("l-adverts").toggleClass("l-adverts-landscape");
            }
            $('#show-sprite a').removeClass('active');
            $('#show-landscape a').addClass('active');
        });


        $("#filterclean").bind("click", null, function (event) {
            home_api.DeleteParamFilters();
        });

        $("#type-property").multiselect({classes: "my-multiselect"});

        $("#type-property").on("multiselectcheckall", function (event, ui) {

            home_api.FinalParameters().type_property.length = 0;
            $($(this).multiselect("getChecked")).each(function (i, e) {
                home_api.FinalParameters().type_property.push(e.defaultValue);
            });
            home_api.ApplyFilters("type_property", "");
            $("#type-property").multiselect("getChecked").each(function (i, e) {
                $("#type-property-mob").multiselect("widget").find(":checkbox").each(function (i, e) {

                    $(this)[0].checked = true;

                });
            });
            $("#type-property-mob").siblings("button").first().children("span").eq(1).text($("#type-property-mob").multiselect("widget").find(":checkbox").length + " selected");

        });

        $("#type-property").on("multiselectuncheckall", function (event, ui) {
            home_api.FinalParameters().type_property.length = 0;
            home_api.ApplyFilters("type_property", "");
            $("#type-property-mob").multiselect("uncheckAll");
        });

        $("#type-property").on("multiselectclick", function (event, ui) {
            var index = jQuery.inArray(ui.value, home_api.FinalParameters().type_property, 0);
            var total_properties_selected = 0;
            if (index === -1) {
                home_api.FinalParameters().type_property.push(ui.value);
            } else {
                home_api.FinalParameters().type_property.splice(index, 1);
            }
            home_api.ApplyFilters("type_property", "");
            $("#type-property-mob").multiselect("widget").find(":checkbox[value='" + ui.value + "']").first()[0].checked = ui.checked;

            $("#type-property").multiselect("getChecked").each(function (i, e) {
                total_properties_selected++;
            });
            $("#type-property-mob").siblings("button").first().children("span").eq(1).text(total_properties_selected + " selected");
        });

        $("#location").selectmenu({
            change: function (event, data) {
                if (data.item.label !== "--Any Area--") {
                    home_api.ParametersFilter().area = data.item.value;
                } else
                    home_api.ParametersFilter().area = null;
            }
        });

        $("div[data-area-id]").each(function (i, e) {
            $(this).click(function () {
                home_api.ParametersFilter().area = $("#tab-area-name").attr("data-area-id");
                $("#apply_filter_link")[0].click();
            });
        });

        $("#select-order-by").selectmenu({
            change: function (event, data) {
                home_api.ParametersFilter().sortby = data.item.label.toLowerCase().replace(/ /g, '').trim();
                $("#apply_filter_link")[0].click();
            }
        });

        $("#numbeds").children().each(function (index, el) {

            $(this).bind("click", null, function (event) {
                if ($(this).text().toLowerCase() === home_api.FinalParameters().numbeds) {
                    home_api.ParametersFilter().numbeds = null;
                } else {
                    home_api.ParametersFilter().numbeds = $(this).text().toLowerCase();
                }
                $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
                $(this).toggleClass("filter-prop-selected");
            });
        });

        $("#furnished").children().each(function (index, el) {

            $(this).bind("click", null, function (event) {
                if ($(this).text().toLowerCase() === home_api.FinalParameters().furnished) {
                    home_api.ParametersFilter().furnished = null;
                } else {
                    home_api.ParametersFilter().furnished = $(this).text().toLowerCase();
                }
                $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
                $(this).toggleClass("filter-prop-selected");
            });
        });

        var queryfilter = $("#queryfilter").attr("value");
        if (queryfilter !== "") {
            var params = this.GetParameterFilters();
            var v = queryfilter.split("&");
            var total_properties_selected = 0;
            $(v).each(function (i, e) {
                var t = e.split("=");
                switch (t[0])
                {
                    case "type_property[]":
                        $("#type-property").multiselect("widget").find(":checkbox").each(function (i, e) {
                            if ($(this).attr("value") === t[1]) {
                                $(this).attr('checked', true);
                                total_properties_selected++;
                            }
                        });
                        $("#type-property").siblings("button").first().children("span").eq(1).text(total_properties_selected + " selected");
                        var index = jQuery.inArray(t[1], home_api.FinalParameters().type_property, 0);
                        if (index === -1) {
                            home_api.FinalParameters().type_property.push(t[1]);
                        } else {
                            home_api.FinalParameters().type_property.splice(index, 1);
                        }
                        home_api.ApplyFilters("type_property", "");
                        break;
                    case "minprice":
                        params.minprice = t[1];
                        minprice = parseInt(t[1]);
                        break;
                    case "maxprice":
                        params.maxprice = t[1];
                        maxprice = parseInt(t[1]);
                        break;
                    case "sortby":
                        params.sortby = t[1];
                        var order = $("#select-order-by");
                        order[0].selectedIndex = $("#select-order-by > option[value='" + t[1] + "']")[0].index;
                        $("#select-order-by").selectmenu("refresh");
                        break;
                    case "numbeds":
                        params.numbeds = t[1];
                        $("#numbeds > div:contains(" + t[1] + ")").toggleClass("filter-prop-selected");
                        break;
                    case "furnished":
                        params.furnished = t[1];
                        $("#furnished > div[data-value='" + t[1] + "']").toggleClass("filter-prop-selected");
                        break;
                    case "area":
                        params.area = t[1];
                        $("#location > option[value='" + t[1] + "']").attr("selected", "");
                        $("#location").selectmenu("refresh");
                        break;
                }
            });
        }

        var conf_slider = {
            range: true,
            min: limitminprice,
            max: limitmaxprice,
            values: [minprice, maxprice],
            slide: function (event, ui) {
                $("#min-price").text(String.fromCharCode('163') + " " + ui.values[0]);
                $("#max-price").text(String.fromCharCode('163') + " " + ui.values[1]);
                home_api.ParametersFilter().minprice = ui.values[0];
                home_api.ParametersFilter().maxprice = ui.values[1];
            }
        };

        $("#slider-range").slider(conf_slider);

        $("#close-modal-map").bind("click", function (e) {
            $('#modal-map').modal('hide');
        });

        $('#modal-map').on('shown.bs.modal', function (e) {
            $(this).css("padding-right", "0");

            var map = new google.maps.Map($("#home-map")[0], {
                center: {lat: 53.45342, lng: -0.3991473},
                zoom: 5
            });

            $.ajax({
                url: conf.endpoint + "getmapinformation",
                success: function (data, status, xhr) {
                    for (var postcode in data.content) {
                        var marker = new google.maps.Marker({
                            map: map,
                            position: {lat: data.content[postcode].latitude, lng: data.content[postcode].longitude},
                            icon: '/img/icons/mapico.png'

                        });
                        var infowindow = new google.maps.InfoWindow({
                            content: data.content[postcode].html
                        });
                        home_api.SetInfoWindow(data.content[postcode].html, marker, map);
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                },
                dataType: "json"
            });
        });

        $("#show-sprite").bind("click", function (event) {

            var ladverts = $("#l-adverts");
            if (!ladverts.hasClass("l-adverts"))
            {
                ladverts.children().not(".l-pagination").toggleClass("l-advert-landscape").toggleClass("l-advert");
                ladverts.toggleClass("l-adverts-landscape").toggleClass("l-adverts");
            }
        });

        $("#show-landscape").bind("click", function (event) {

            var ladverts = $("#l-adverts");
            if (!ladverts.hasClass("l-adverts-landscape"))
            {
                $("#l-adverts").children().not(".l-pagination").toggleClass("l-advert").toggleClass("l-advert-landscape");
                $("#l-adverts").toggleClass("l-adverts").toggleClass("l-adverts-landscape");
            }
        });
    };

    HomeApi.prototype.ParametersFilter = function () {

        return this.GetParameterFilters();
    };

    HomeApi.prototype.FinalParameters = function () {

        return this.GetFinalParameters();
    };

    HomeApi.prototype.DeleteParamFilters = function () {

        if ($("#apply_filter_link").length) {
            $("#apply_filter_link").attr("href", $("#apply_filter_link").attr("href").split("?")[0] + "?");
            $("#apply_filter_link")[0].click();
        }
        if ($("#apply_filter_link_mob").length) {
            $("#apply_filter_link_mob").attr("href", $("#apply_filter_link_mob").attr("href").split("?")[0] + "?");
            $("#apply_filter_link_mob")[0].click();
        }
    };

    HomeApi.prototype.ApplyFilters = function (prop, newval) {

        var final_parameters = this.FinalParameters();
        if (prop !== "type_property")
        {
            final_parameters[prop] = newval;
        }
        var querystring = "";
        for (var p in final_parameters) {

            if (Array.isArray(final_parameters[p])) {
                $(final_parameters[p]).each(function (i, e) {
                    querystring += p + "[]=" + e + "&";
                });
            } else {
                if (final_parameters[p] !== null) {
                    querystring += p + "=" + final_parameters[p].toString().toLowerCase().replace(/ /g, '').trim() + "&";
                }
            }
        }
        querystring = querystring.substring(0, querystring.length - 1);
        if ($("#apply_filter_link").length) {
            $("#apply_filter_link").attr("href", $("#apply_filter_link").attr("href").split("?")[0] + "?" + querystring);
        }
        if ($("#apply_filter_link_mob").length) {
            $("#apply_filter_link_mob").attr("href", $("#apply_filter_link_mob").attr("href").split("?")[0] + "?" + querystring);
        }
        $(".page-link").each(function (index, el) {

            $(this).attr("href", $(this).attr("href").split("?")[0] + "?" + querystring + "&page=" + $(this).attr("data-page"));
        });
    };

    return new HomeApi();
})();




