var letting = (function () {

    function LettingApi() {

    }

    LettingApi.prototype.SetUp = function () {

        var that = this;
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

        $("#contact-by-phone").bind("click", function (event) {

            $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
            $(this).toggleClass("filter-prop-selected");
            var input = $('<input/>');
            input.attr("name", "ContactBy");
            input.attr("value", $(this).text().toLowerCase());
            input.attr("type", "hidden");
            $("#form-arrange").children("input[name=ContactBy]").remove();
            $("#form-arrange").append(input);

        });

        $("#contact-by-email").bind("click", function (event) {

            $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
            $(this).toggleClass("filter-prop-selected");
            var input = $('<input/>');
            input.attr("name", "ContactBy");
            input.attr("value", $(this).text().toLowerCase());
            input.attr("type", "hidden");
            $("#form-arrange").children("input[name=ContactBy]").remove();
            $("#form-arrange").append(input);

        });

        $("#no-contact").bind("click", function (event) {

            $(this).siblings("div.filter-prop-selected").toggleClass("filter-prop-selected");
            $(this).toggleClass("filter-prop-selected");
            var input = $('<input/>');
            input.attr("name", "ContactBy");
            input.attr("value", "N/A");
            input.attr("type", "hidden");
            $("#form-arrange").children("input[name=ContactBy]").remove();
            $("#form-arrange").append(input);

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
                    alert(data.error);
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

letting.SetUp();
