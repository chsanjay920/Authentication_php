$(document).ready(function () {
    $("#submit-btn").click(function () {
      var data = $("#login-form").serialize(); 
      $.ajax({
        type: "POST",
        url: "./php/login.php",
        data: data,
        dataType: "json", 
        success: function (response) {
          if (response.hasOwnProperty("id")) {
            localStorage.setItem("userLoggedIn", true);
            localStorage.setItem("userId", response.id);
            localStorage.setItem("userFirstName", response.firstName);
            localStorage.setItem("userLastName", response.lastName);
            localStorage.setItem("userEmail", response.email);
            localStorage.setItem("userphone",response.phone);
            localStorage.setItem("userDateOfBirth", response.dateOfBirth);
            localStorage.setItem("userGender", response.gender);
            localStorage.setItem("userBio", response.bio);
            window.location.href = "./profile.html";
          } else {
            $("#error-message").html(response).show();
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          $("#error-message")
            .html("Error occurred. Please try again.")
            .show();
        },
      });
    });
  });
