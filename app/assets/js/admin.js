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
}

navSettingsToggle.addEventListener("click", function () {
    settingsNav.classList.toggle("is-visible");
});

setTimeout(function () {
    var flashMessages = document.querySelector('.flash-messages');
    if(flashMessages){
        flashMessages.className += ' is-not-visible';
    }
}, 2500);