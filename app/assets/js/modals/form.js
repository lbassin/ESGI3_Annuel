var actionPopin = document.getElementsByClassName('action-popin');
for (var i = 0; i < actionPopin.length; i++) {
    actionPopin[i].addEventListener('click', function(){
        displayPopin(this);
    })
}

function displayPopin(trigger){

    console.log(trigger);
}