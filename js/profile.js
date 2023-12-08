
var userLoggedIn = localStorage.getItem("userLoggedIn");

if (userLoggedIn) {
    var userFirstName = localStorage.getItem("userFirstName");
    var userLastName = localStorage.getItem("userLastName");
    var userEmail = localStorage.getItem("userEmail");
    var userDateOfBirth = localStorage.getItem("userDateOfBirth");
    var userphone = localStorage.getItem("userphone");
    var userGender = localStorage.getItem("userGender");
    var userBio = localStorage.getItem("userBio");

    var userDetailsHtml = `
                 <li class="list-group-item"><strong>Name:</strong> ${userFirstName} ${userLastName}</li>
                 <li class="list-group-item"><strong>Email:</strong> ${userEmail}</li>
                 <li class="list-group-item"><strong>Date of Birth:</strong> ${userDateOfBirth}</li>
                 <li class="list-group-item"><strong>Gender:</strong> ${userGender}</li>
                 <li class="list-group-item"><strong>Phone:</strong> ${userphone}</li>
                 <li class="list-group-item"><strong>Bio:</strong> ${userBio}</li>
            `;

    document.getElementById("user-details").innerHTML = userDetailsHtml;
} else {
    window.location.href = "./login.html";
}