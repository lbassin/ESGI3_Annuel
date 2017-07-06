var loginButton = document.querySelector("#login");
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
    }, 5000);
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
        }, function() {
            showLoginError();
            showPopUp("Identifiant et/ou mot de passe<br>invalides", "error");
        });
    });
}

var passwordForgetButton = document.querySelector("#forget-password-button");
var backLoginButton = document.querySelector("#back-login-button");
var loginForm = document.querySelector("#container-login-form");
var passwordForgetForm = document.querySelector("#container-password-forget");
var forgetButton = document.querySelector("#forget");

passwordForgetButton.addEventListener("click", function () {
    fadeOut(loginForm);
    setTimeout(function () {
        fadeIn(passwordForgetForm);
    }, 250);
});

backLoginButton.addEventListener("click", function () {
    fadeOut(passwordForgetForm);
    setTimeout(function () {
        fadeIn(loginForm);
    }, 250);
});

forgetButton.addEventListener("click", function (event) {
    event.preventDefault();

    console.log('test');

    if (validateEmail(document.querySelector("#forget-mail").value)) {

        var data = {
            'email': document.querySelector("input[name='email-forget']").value
        };

        ajax.post(loginResetPassword, data, function (data) {
            data = JSON.parse(data);
            if (data['success']) {
                fadeOut(passwordForgetForm);
                setTimeout(function () {
                    fadeIn(loginForm);
                }, 250);
                showPopUp(data['message'], "success");
            } else {
                showPopUp(data['message'], "error");
            }
        });
    } else {
        showPopUp("Votre mail n'est pas valide", "error");
    }
});

function fadeOut(element) {
    element.style.opacity = 1;

    (function fade() {
        if ((element.style.opacity -= .1) < 0) {
            element.style.display = 'none';
            element.classList.add('is-hidden');
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

function fadeIn(element, display) {
    if (element.classList.contains('is-hidden')) {
        element.classList.remove('is-hidden');
    }
    element.style.opacity = 0;
    element.style.display = display || "block";

    (function fade() {
        var val = parseFloat(element.style.opacity);
        if (!((val += .1) > 1)) {
            element.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}

function validateEmail(email) {
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
}

var timeOutPopUp;

function showPopUp(text, type) {
    clearTimeout(timeOutPopUp);
    var popup = document.querySelector("#popup-message");
    popup.style.backgroundColor = (type == "error" ? "rgba(255, 31, 8, 0.73)" : "rgba(39, 174, 96, 0.73)");
    popup.innerHTML = text;
    fadeIn(popup);
    timeOutPopUp = setTimeout(function () {
        fadeOut(popup);
    }, 5000);
}