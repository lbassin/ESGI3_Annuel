var i;

var saveBtn = document.querySelector('#saveBtn');
if (saveBtn) {
    saveBtn.addEventListener('click', function () {
        document.forms['model-form'].submit();
    })
}

var saveEditBtn = document.querySelector('#saveEditBtn');
if (saveEditBtn) {
    saveEditBtn.addEventListener('click', function () {
        document.forms['model-form'].action += '?redirectToEdit=1';
        document.forms['model-form'].submit();
    })
}

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

            var errors = document.querySelector('#' + popin.getAttribute('id') + ' .popin-errors');
            var errorsList = errors.querySelector('ul');
            if (errorsList) {
                errors.removeChild(errorsList)
            }
            fadeOut(errors);
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

function getParentByTagName(node, tagname) {
    var parent;
    if (node === null || tagname === '') return;
    parent = node.parentNode;
    tagname = tagname.toUpperCase();

    while (parent.tagName !== "HTML") {
        if (parent.tagName === tagname) {
            return parent;
        }
        parent = parent.parentNode;
    }

    return parent;
}

function refreshFormElements(form) {
    var scripts = form.querySelectorAll('[data-call-script]');
    var called = [];
    for (var e = 0; e < scripts.length; e++) {
        var toCall = scripts[e].getAttribute('data-call-script');
        if(!window[toCall]){
            console.log(toCall);
            console.log(window)
        }

        if (called.indexOf(toCall) === -1 && window[toCall]) {
            window[toCall]();
            called.push(toCall);
        }
    }
}

function initWysiwygInput(){
    var editors = document.querySelectorAll('input[name=editor]');
    for (var i = 0; i < editors.length; i++) {
        editors[i].setAttribute('name', editors[i].getAttribute('name') + i.toString());
    }
}