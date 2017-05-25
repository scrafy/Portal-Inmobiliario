var letting = (function () {


    function LettingApi() {

    }

    LettingApi.prototype.SetUp = function () {

        var that = this;

        var postcode = $("#advert-address").text();
        postcode = postcode.split(",")[1].trim();

        $.get(conf.endpoint + "getlatlngfrompostcode/" + postcode, null, function (data, status, xhr) {

            if (data.content !== null) {
                var map = new google.maps.Map($(".l-aside-property-view-map")[0], {
                    center: {lat: data.content.lat, lng: data.content.lng},
                    zoom: 16
                });
                var marker = new google.maps.Marker({
                    map: map,
                    position: {lat: data.content.lat, lng: data.content.lng},
                    icon: '/img/icons/mapico.png'

                });
            }
        });

        $("#epc-report").bind("click", function (event) {

            if ($(this).attr("data-value") !== "") {
                that.GetEpcReport($(this).attr("data-value"));
            }

        });

        $('#arrangeview-modal').on('hidden.bs.modal', function (e) {
            $("#form-arrange .form-group > span").text("");
            $("#form-arrange .form-group > input, #form-arrange .form-group > textarea").val("");
            $(".buttons").children("div.filter-prop-selected").toggleClass("filter-prop-selected");
        });

        $("#contact-by-phone,#contact-by-email,#no-contact").bind("click", function (event) {

            if ($(this).hasClass("filter-prop-selected")) {
                $("#form-arrange").children("input[name=ContactBy]").remove();
            } else {
                var input = $('<input/>');
                input.attr("name", "ContactBy");
                input.attr("value", $(this).text().toLowerCase());
                input.attr("type", "hidden");
                $("#form-arrange").children("input[name=ContactBy]").remove();
                $("#form-arrange").append(input);
            }
            $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
            $(this).toggleClass("filter-prop-selected");


        });
        $("#submit-arrange-form").bind("click", function (event) {
            that.SubmitArrangeForm();
        });
    };

    LettingApi.prototype.GetEpcReport = function (id)
    {
        $.ajax({
            url: conf.endpoint + "getepcreport/" + id,
            success: function (data, status, xhr) {
                if (data.error !== null) {
                    $("#epc-report-img").attr("src", "/img/no_epc_report.png");
                    $("#epc-report-img").css("width", "250px");
                } else {
                    $("#epc-report-img").attr("src", "/img/Properties/EpcReports/" + data.content.file);
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            },
            dataType: "json"
        });
    };

    LettingApi.prototype.SubmitArrangeForm = function ()
    {
        var form = $("#form-arrange").serializeFormJSON();
        $("#form-arrange .form-group > span").text("");
        $.ajax({
            url: conf.endpoint + "appointment",
            success: function (data, status, xhr) {
                if (data.error !== null) {
                    if (data.error === "validation_errors") {
                        for (var error in data.validation_errors) {
                            $("#error-" + error).text(data.validation_errors[error]);
                        }
                    } else
                    {
                        alert(data.error);
                    }
                } else {
                    alert("Your appointment has been registered...");
                    $("#form-arrange .form-group > span").text("");
                    $("#form-arrange .form-group > input, #form-arrange .form-group > textarea").val("");
                    $(".buttons").children("div.filter-prop-selected").toggleClass("filter-prop-selected");
                    $('#arrangeview-modal').modal('hide');
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            },
            dataType: "json",
            data: JSON.stringify(form),
            method: "POST",
            contentType: "application/json"
        });
    };

    return new LettingApi();

})();


