var loginButton = document.querySelector(".login-submit");
var stroke1 = document.querySelector("#logo-circle-1");
var stroke2 = document.querySelector("#logo-circle-2");

if (loginButton != null) {
    loginButton.addEventListener("click", function(){
        stroke1.style.stroke = "red";
        stroke2.style.stroke = "red";
        setTimeout(function(){
            stroke1.style.stroke = "black";
            stroke2.style.stroke = "black";
        }, 3000);
    });
}

var navToggle = document.querySelector(".nav-toggle");
var navSettingsToggle = document.querySelector(".nav-settings-toogle");
var slideNavLarge = document.querySelector(".slide-nav-large");
var slideNavSmall = document.querySelector(".slide-nav-small");
var settingsNav = document.querySelector(".settings-nav");
var container = document.querySelector(".container");


if (navToggle != null) {
    navToggle.addEventListener("click", function()
    {
        navToggle.classList.toggle('open');
        container.classList.toggle("slide-out-container");
        slideNavLarge.classList.toggle("slide-out");
        slideNavLarge.classList.toggle("is-visible");
        slideNavSmall.classList.toggle("is-not-visible");
        //slideNavMini.style.display = 'none';
    });

    navSettingsToggle.addEventListener("click", function () {
        settingsNav.classList.toggle("settings-visible");
        console.log('test');
    });
}


var passwordForgetButton = document.querySelector("#forget-password-button");
var backLoginButton = document.querySelector("#back-login-button");
var loginForm = document.querySelector("#container-login-form");
var passwordForgetForm = document.querySelector("#container-password-forget");

passwordForgetButton.addEventListener("click", function(){
    fadeOut(loginForm);
    setTimeout(function(){
        fadeIn(passwordForgetForm);
    }, 250);
});

backLoginButton.addEventListener("click", function(){
    fadeOut(passwordForgetForm);
    setTimeout(function(){
        fadeIn(loginForm);
    }, 250);
});






function fadeOut(el){
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

function fadeIn(el, display){
    if (el.classList.contains('is-hidden')){
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




