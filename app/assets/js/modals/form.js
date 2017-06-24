var actionPopin = document.getElementsByClassName('action-popin');
for (var i = 0; i < actionPopin.length; i++) {
    actionPopin[i].addEventListener('click', function () {
        displayPopin(this);
    })
}

var overlayPopin = document.getElementsByClassName("popin-overlay");
if (overlayPopin[0]) {
    overlayPopin[0].addEventListener('click', hidePopin);
}

function displayPopin(trigger) {
    var popin = document.getElementById("popin");
    if(!popin){
        return false;
    }

    popin.style.visibility = 'visible';
    popin.style.opacity = 1;
}

function hidePopin(){
    var popin = document.getElementById("popin");
    if(!popin){
        return false;
    }
    popin.style.opacity = 0;

    setTimeout(function(){
        popin.style.visibility = 'hidden';
    }, 750);
}