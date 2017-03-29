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
var slideNav = document.querySelector(".slide-nav");
var settingsNav = document.querySelector(".settings-nav");
var container = document.querySelector(".container");


if (navToggle != null) {
    navToggle.addEventListener("click", function()
    {
        navToggle.classList.toggle('open');
        container.classList.toggle("slide-out-container");
        slideNav.classList.toggle("slide-out");
        slideNav.classList.toggle("is-visible");
    });
}

navSettingsToggle.addEventListener("click", function () {
     settingsNav.classList.toggle("settings-visible");
     console.log('test');
});