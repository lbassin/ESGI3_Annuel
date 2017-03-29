var navToggle = document.querySelector(".nav-toggle");
var slideNav = document.querySelector(".slide-nav");
var container = document.querySelector(".container");

navToggle.addEventListener("click", function()
{
    navToggle.classList.toggle('open');
    container.classList.toggle("slide-out-container");
    slideNav.classList.toggle("slide-out");
    slideNav.classList.toggle("is-visible");
});