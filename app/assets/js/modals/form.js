var i;
var componentsCount = 0;

getTemplates();

var divPreview = document.querySelector('.widget.page_new .preview');

var actionPopin = document.getElementsByClassName('action-popin');
for (i = 0; i < actionPopin.length; i++) {
    actionPopin[i].addEventListener('click', function () {
        displayPopin(this);
    })
}

var validateButton = document.querySelector('#popin-addComponent .validate-component');
if (validateButton) {
    validateButton.addEventListener('click', validateComponent);
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

function addEventOnTemplateGrid() {
    var templates = document.getElementsByClassName('template');
    for (i = 0; i < templates.length; i++) {
        templates[i].addEventListener('click', function () {
            selectTemplate(this);
        });
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

var form = document.getElementsByTagName('form');
if (form[0]) {
    form[0].addEventListener('submit', function (evt) {
        console.log(document.activeElement.getAttribute('data-template-id'));
        if (document.activeElement.getAttribute('data-template-id') !== null) {
            evt.preventDefault();
        }
    });
}

function getTemplates() {
    var ajax = new Ajax();
    ajax.get(urlComponent, function (data) {
        var templates = JSON.parse(data);

        var templatePreview = null;
        var gridTemplates = document.querySelector('#popin-addComponent .grid-templates > div');
        for (var e = 0; e < templates.length; e++) {
            templatePreview = document.createElement('img');
            templatePreview.classList.add('template');
            templatePreview.setAttribute('src', templates[e].preview);
            templatePreview.setAttribute('data-template-id', templates[e].id);

            gridTemplates.appendChild(templatePreview);
        }

        addEventOnTemplateGrid();
    })
}

function selectTemplate(template) {
    var configTemplate = document.querySelector("#popin-addComponent .popin-content .template-config");
    var ajaxContent = document.querySelector("#popin-addComponent .popin-content .template-config .ajax-content");
    var gridTemplates = document.querySelector('#popin-addComponent .popin-content .grid-templates');

    var ajax = new Ajax();
    ajax.get(urlComponent + template.getAttribute('data-template-id'), function (data) {
        var formConfig = document.createElement('form');
        formConfig.setAttribute('name', 'form-config-component');
        formConfig.innerHTML = data;

        formConfig.addEventListener('submit', function (evt) {
            evt.preventDefault();
            validateComponent();
        });

        ajaxContent.innerHTML = "";
        ajaxContent.appendChild(formConfig);
    });

    validateButton.setAttribute('data-template-id', template.getAttribute('data-template-id'));

    fadeOut(gridTemplates);
    setTimeout(function () {
        fadeIn(configTemplate);
    }, 750);
}

function validateComponent() {
    var form = document.forms['form-config-component'];

    var data = {};
    for (i = 0; i < form.elements.length; i++) {
        data[form.elements[i].name] = form.elements[i].value;
    }
    data['template_id'] = validateButton.getAttribute('data-template-id');

    var ajax = new Ajax();
    ajax.post(urlValidate, data, function (response) {
        response = JSON.parse(response);

        var errorDiv = document.getElementById("addComponent-errors");
        if (!response['errors']) {
            addPreview(response);
            fadeOut(errorDiv);
            hidePopin(document.querySelector("#popin-addComponent"));
        } else {
            displayErrors(errorDiv, response['errors']);
        }
    });
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

function moveAddComponentButton() {
    var btnAddComponent = document.querySelector('.widget.page_new #btnAddComponent');
    btnAddComponent.style.top = (divPreview.clientHeight + 8) + 'px';
}

function addEditComponentButton(height) {
    var btnDiv = document.querySelector('.widget.page_new .right');
    var button = document.createElement('div');

    height += 8;
    button.innerText = 'Edit component';
    button.style.top = height + 'px';

    btnDiv.appendChild(button);
}

function addComponentInput(data) {
    var input = document.createElement('input');
    componentsCount++;

    input.setAttribute('type', 'hidden');
    input.setAttribute('value', JSON.stringify(data));
    input.setAttribute('name', 'components[' + componentsCount + ']');

    document.forms[0].appendChild(input);
}

function addPreview(data) {
    var oldHeight = divPreview.clientHeight;
    setTimeout(function () {
        addEditComponentButton(oldHeight, -1);
    }, 450);

    var preview = document.createElement('img');
    preview.setAttribute('src', data['preview']);
    divPreview.appendChild(preview);
    setTimeout(moveAddComponentButton, 350);

    addComponentInput(data['data']);
}

if (data !== undefined) {
    data = JSON.parse(data);
    var previews = [];

    for (i = 0; i < data.length; i++) {
        var ajax = new Ajax();
        ajax.post(urlValidate, data[i], function (response) {
            response = JSON.parse(response);
            previews[this] = response;

            if (previews.length === data.length) {
                for (var e = 0; e < previews.length; e++) {
                    setTimeout(function(){
                        addPreview(previews[this]);
                    }.bind(e), 100) // TODO ...
                }
            }
        }.bind(i));
    }
}