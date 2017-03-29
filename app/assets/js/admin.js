var navToggle = document.querySelector(".nav-toggle");
var navSettingsToggle = document.querySelector(".nav-settings-toogle");
var slideNav = document.querySelector(".slide-nav");
var settingsNav = document.querySelector(".settings-nav");
var container = document.querySelector(".container");

navToggle.addEventListener("click", function()
{
    navToggle.classList.toggle('open');
    container.classList.toggle("slide-out-container");
    slideNav.classList.toggle("slide-out");
    slideNav.classList.toggle("is-visible");
});

navSettingsToggle.addEventListener("click", function () {
     settingsNav.classList.toggle("settings-visible");
     console.log('test');
});