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
        hidePopin(this.parentElement);
    })
}

function displayPopin(trigger) {
    var popin = document.getElementById(trigger.getAttribute("data-target"));
    if (popin) {
        fadeIn(popin);
    }
}

function hidePopin(popin) {
    if (popin) {
        fadeOut(popin);

        setTimeout(function () {
            var popinContent = document.querySelector('#' + popin.getAttribute('id') + ' .popin-content');
            for (i = 0; i < popinContent.children.length; i++) {
                if (i === 0) {
                    fadeIn(popinContent.children[i]);
                } else {
                    fadeOut(popinContent.children[i]);
                }
            }
        }, 650);
    }
}

function fadeOut(element) {
    element.classList.remove('fadeIn');
    element.classList.add('fadeOut');
    setTimeout(function () {
        element.classList.add('hidden');
        element.classList.remove('fadeOut');
    }, 700);
}

function fadeIn(element) {
    element.classList.add('fadeIn');
    element.classList.remove('hidden');
}

function displayErrors(parentDiv, errors) {
    var ul = document.createElement('ul');
    var li = null;

    for (var i = 0; i < errors.length; i++) {
        li = document.createElement('li');
        li.innerText = errors[i];
        ul.appendChild(li);
    }

    parentDiv.innerHTML = '';
    parentDiv.appendChild(ul);
    fadeIn(parentDiv);
}
