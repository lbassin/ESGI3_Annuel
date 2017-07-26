var dropdowns = document.querySelectorAll('.nav-dropdown');
for (var i = 0; i < dropdowns.length; i++) {
    dropdowns[i].querySelector('a').addEventListener('mouseenter', function () {
        this.parentNode.parentNode.querySelector('.nav-dropdown-content').classList.add('show');
    });
    dropdowns[i].addEventListener('mouseleave', function () {
        this.querySelector('.nav-dropdown-content').classList.remove('show');
    });
}