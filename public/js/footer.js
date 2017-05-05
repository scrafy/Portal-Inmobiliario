var footer = (function () {

    function FooterApi() {

    }

    FooterApi.prototype.SetUp = function () {

        var that = this;
        $("#sendcontactmessage").bind("click", function (event) {
            that.SubmitContactForm();
        });

    };

    FooterApi.prototype.SubmitContactForm = function ()
    {
        var form = $("#form_message").serializeFormJSON();
        $.ajax({
            url: conf.endpoint + "sendmessagecontact",
            success: function (data, status, xhr) {
                if (data.error !== null) {
                    if (data.error === "validation_errors") {
                        var errors = "";
                        for (var error in data.validation_errors) {
                            errors += data.validation_errors[error] + "\n";
                        }
                        alert(errors);
                    } else
                    {
                        alert(data.error);
                    }
                } else {
                    alert("Your message has been sent correctly...");
                    $("#form_message input, #form_message textarea").val("");
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

    return new FooterApi();

})();

footer.SetUp();