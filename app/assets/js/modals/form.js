var i;

var actionPopin = document.getElementsByClassName('action-popin');
for (i = 0; i < actionPopin.length; i++) {
    actionPopin[i].addEventListener('click', function () {
        displayPopin(this);
    })
}

var overlayPopin = document.getElementsByClassName("popin-overlay");
for (i = 0; i < overlayPopin.length; i++) {
    overlayPopin[i].addEventListener('click', function () {
        hidePopin(this);
    })
}

function displayPopin(trigger) {
    var popin = document.getElementById(trigger.getAttribute("data-target"));
    if (popin) {
        fadeIn(popin);
    }
}

function hidePopin(trigger) {
    var popin = trigger.parentElement;
    if (popin) {
        fadeOut(popin);
    }
}

var templates = document.getElementsByClassName('template');
for (i = 0; i < templates.length; i++) {
    templates[i].addEventListener('click', function () {
        var gridTemplates = document.querySelector('#popin-addComponent .popin-content .grid-templates');
        fadeOut(gridTemplates);

        var configTemplate = document.querySelector("#popin-addComponent .popin-content .template-config");
        configTemplate.classList.add('fadeIn');
    });
}

function fadeOut(element) {
    element.classList.remove('fadeIn');
    element.classList.add('fadeOut');
    setTimeout(function(){
        element.classList.add('hidden');
        element.classList.remove('fadeOut');
    }, 700);
}

function fadeIn(element) {
    element.classList.add('fadeIn');
    element.classList.remove('hidden');
}

var form = document.getElementsByTagName('form');
if(form[0]){
    form[0].addEventListener('submit', function(evt){
        evt.preventDefault();
    })
}

var validePopin = document.getElementById('validate-component');
if(validePopin){
    validePopin.addEventListener('click', function(){
        fadeOut(document.getElementById('popin-addComponent'));
    })
}