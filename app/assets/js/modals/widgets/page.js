var i;
var components = [];
var componentIdEditing = 0;

getTemplates();

var divPreview = document.querySelector('.widget.page_new .preview');

var validateButtonAdd = document.querySelector('#popin-addComponent .validate-component');
if (validateButtonAdd) {
    validateButtonAdd.addEventListener('click', function (event) {
        validateComponent('add');
    });
}

var validateButtonEdit = document.querySelector('#popin-editComponent .validate-component');
if (validateButtonEdit) {
    validateButtonEdit.addEventListener('click', function (event) {
        validateComponent('edit');
    });
}

function addEventOnTemplateGrid() {
    var templates = document.getElementsByClassName('template');
    for (i = 0; i < templates.length; i++) {
        templates[i].addEventListener('click', function () {
            selectTemplate(this);
        });
    }
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
    var gridTemplates = document.querySelector('#popin-addComponent .popin-content .grid-templates');

    var ajax = new Ajax();
    ajax.get(urlComponent + template.getAttribute('data-template-id'), function (data) {
        displayFormConfig(data, 'add', "#popin-addComponent .popin-content .template-config .ajax-content");
    });

    validateButtonAdd.setAttribute('data-template-id', template.getAttribute('data-template-id'));

    fadeOut(gridTemplates);
    setTimeout(function () {
        fadeIn(configTemplate);
    }, 750);
}

function validateComponent(action, componentId) {
    var formName = 'form-' + action + '-component';
    var form = document.forms[formName];

    var data = {};
    for (i = 0; i < form.elements.length; i++) {
        data[form.elements[i].name] = form.elements[i].value;
    }

    var validateButton = validateButtonAdd;
    if (action === 'edit') {
        validateButton = validateButtonEdit;
    }

    data['template_id'] = validateButton.getAttribute('data-template-id');

    var ajax = new Ajax();
    ajax.post(urlValidate, data, function (response) {
        response = JSON.parse(response);

        var errorDiv = document.getElementById(action + "Component-errors");
        if (!response['errors']) {
            if (action === 'add') {
                addPreview(response);
            } else if (action === 'edit') {
                var componentId = components[componentIdEditing].id;
                var input = document.getElementsByName('components[' + componentIdEditing + ']')[0];

                response['data']['id'] = componentId;
                input.setAttribute('value', JSON.stringify(response['data']));
                components[componentIdEditing] = response['data'];
            }

            fadeOut(errorDiv);
            var errorsList = errorDiv.querySelector('ul');
            if (errorsList) {
                errorDiv.removeChild(errorsList);
            }

            hidePopin(document.querySelector('#popin-' + action + 'Component'));
        } else {
            displayErrors(errorDiv, response['errors']);
        }
    });
}

function moveAddComponentButton() {
    var btnAddComponent = document.querySelector('.widget.page_new #btnAddComponent');
    btnAddComponent.style.top = (divPreview.clientHeight + 8) + 'px';
}

function addEditComponentButton(height, componentId) {
    var btnDiv = document.querySelector('.widget.page_new .right');
    var button = document.createElement('div');

    height += 8;
    button.innerText = 'Edit component';
    button.style.top = height + 'px';
    button.setAttribute('data-component-id', componentId);

    button.addEventListener('click', function () {
        editComponent(this.getAttribute('data-component-id'));
        componentIdEditing = this.getAttribute('data-component-id');
    });

    btnDiv.appendChild(button);
}

function editComponent(componentId) {
    if (componentId === undefined) {
        return false;
    }

    var currentComponent = components[componentId];
    if (!currentComponent) {
        return false;
    }

    var ajax = new Ajax();
    ajax.post(urlEditComponent + currentComponent.template_id, currentComponent, function (data) {
        displayFormConfig(data, 'edit', '#popin-editComponent .ajax-content');

        validateButtonEdit.setAttribute('data-template-id', currentComponent.template_id);
    });

    fadeIn(document.querySelector('#popin-editComponent'));
}

function addComponentInput(data) {
    var input = document.createElement('input');

    input.setAttribute('type', 'hidden');
    input.setAttribute('value', JSON.stringify(data));
    input.setAttribute('name', 'components[' + components.length + ']');

    document.forms['model-form'].appendChild(input);
}

function addPreview(data) {
    var oldHeight = divPreview.clientHeight;
    setTimeout(function () {
        addEditComponentButton(oldHeight, this);
    }.bind(components.length), 450);
    addComponentInput(data['data']);

    components.push(data['data']);

    var preview = document.createElement('img');
    preview.setAttribute('src', data['preview']);
    divPreview.appendChild(preview);
    setTimeout(moveAddComponentButton, 350);
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
                // Fix asynchrone bug ... Object added in the array but undefined
                var ready = true;
                for (var j = 0; j < previews.length; j++) {
                    if (previews[j] === undefined) {
                        ready = false;
                        break;
                    }
                }

                if (ready) {
                    for (var e = 0; e < previews.length; e++) {
                        setTimeout(function () {
                            addPreview(previews[this]);
                        }.bind(e), 100) // TODO ...
                    }
                }
            }
        }.bind(i));
    }
}

function displayFormConfig(data, action, ajaxContentSelector) {
    var ajaxContent = document.querySelector(ajaxContentSelector);
    var formConfig = document.createElement('form');
    formConfig.setAttribute('name', 'form-' + action + '-component');
    formConfig.innerHTML = data;

    formConfig.addEventListener('submit', function (evt) {
        evt.preventDefault();
        validateComponent(action);
    });

    ajaxContent.innerHTML = "";
    ajaxContent.appendChild(formConfig);

    var scripts = formConfig.querySelectorAll('[data-call-script]');
    var called = [];
    for (var e = 0; e < scripts.length; e++) {
        var toCall = scripts[e].getAttribute('data-call-script');
        if (called.indexOf(toCall) === -1) {
            window[toCall]();
            called.push(toCall);
        }
    }

    var editors = document.querySelectorAll('input[name=editor]');
    for (var i = 0; i < editors.length; i++) {
        editors[i].setAttribute('name', editors[i].getAttribute('name') + i.toString());
    }
}