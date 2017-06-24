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
    if (!popin) {
        return false;
    }

    popin.style.visibility = 'visible';
    popin.style.opacity = 1;
}

function hidePopin(trigger) {
    var popin = trigger.parentElement;
    if (!popin) {
        return false;
    }
    popin.style.opacity = 0;

    setTimeout(function () {
        popin.style.visibility = 'hidden';
    }, 750);
}