var footer = (function () {

    function FooterApi() {

    }

    FooterApi.prototype.SetUp = function () {

        var that = this;
        $("#sendcontactmessage").bind("click", function (event) {
            that.SubmitContactForm();
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

    };

    FooterApi.prototype.SubmitContactForm = function ()
    {
        var form = $("#form_message").serializeFormJSON();
        $.ajax({
            url: conf.endpoint + "sendmessagecontact",
            beforeSend: function () {
                $("#header").css("z-index", "-1");
                $('#ajax-loader').modal("show");
            },
            success: function (data, status, xhr) {
                $("#header").css("z-index", "6000");
                $('#ajax-loader').modal("hide");
                if (data.error !== null) {
                    if (data.error === "validation_errors") {
                        var errors = "";
                        for (var error in data.validation_errors) {
                            errors += data.validation_errors[error] + "\n";
                        }
                        setTimeout(function () {
                            alert(errors);
                        }, 500);
                    } else {
                        setTimeout(function () {
                            alert(data.error);
                        }, 500);
                    }
                } else {
                    $("#header").css("z-index", "6000");
                    $('#ajax-loader').modal("hide");
                    setTimeout(function () {
                        alert("Your message has been sent correctly...");
                    }, 500);
                    $("#form_message input, #form_message textarea").val("");
                }
            },
            error: function (xhr, status, error) {
                $("#header").css("z-index", "6000");
                $('#ajax-loader').modal("hide");
                setTimeout(function () {
                    alert(error);
                }, 500);
            },
            dataType: "json",
            data: JSON.stringify(form),
            method: "POST",
            contentType: "application/json"
        });
    };

    return new FooterApi();

})();
