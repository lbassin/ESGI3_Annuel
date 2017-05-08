var loginButton = document.querySelector(".login-submit");
var stroke1 = document.querySelector("#logo-circle-1");
var stroke2 = document.querySelector("#logo-circle-2");
var emailInput = document.querySelector("input[name='email']");
var passwordInput = document.querySelector("input[name='password']");
var ajax = new Ajax();

var showLoginError = function () {
    stroke1.style.stroke = "red";
    stroke2.style.stroke = "red";
    setTimeout(function () {
        stroke1.style.stroke = "black";
        stroke2.style.stroke = "black";
    }, 3000);
};

if (loginButton !== null) {
    loginButton.addEventListener("click", function (event) {
        event.preventDefault();

        var data = {
            'email': emailInput.value,
            'password': passwordInput.value,
            'token': csrfToken
        };

        ajax.post(loginUrlPost, data, function (data) {
            data = JSON.parse(data);
            if (data['success']) {
                window.location = data['redirectTo'];
            }
        }, showLoginError);
    });
}