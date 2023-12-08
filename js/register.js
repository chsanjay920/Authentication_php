$(document).ready(function () {
    $("#submit-btn").click(function () {
        var data = $("#register-form").serialize(); // Serialize form data

        $.ajax({
            type: "POST",
            url: "./php/register.php",
            data: data,
            success: function (response) {
                if (response === "Successfully Registered") {
                    // Redirect to login page or perform other actions upon successful registration
                    alert("Successfully Registered");
                    window.location.href = "./index.html";
                } else {
                    $("#error-message").html(response).show();
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $("#error-message").html("Error occurred. Please try again.").show();
            }
        });
    });
});