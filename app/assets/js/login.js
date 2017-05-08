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

    alert('todo'); // route : login/forget
});


function fadeOut(el) {
    el.style.opacity = 1;

    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = 'none';
            el.classList.add('is-hidden');
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

function fadeIn(el, display) {
    if (el.classList.contains('is-hidden')) {
        el.classList.remove('is-hidden');
    }
    el.style.opacity = 0;
    el.style.display = display || "block";

    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .1) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}