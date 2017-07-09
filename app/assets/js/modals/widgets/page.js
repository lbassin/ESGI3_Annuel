var i;
var componentsCount = 0;
var components = [];

getTemplates();

var divPreview = document.querySelector('.widget.page_new .preview');

var validateButton = document.querySelector('#popin-addComponent .validate-component');
if (validateButton) {
    validateButton.addEventListener('click', validateComponent);
}

function addEventOnTemplateGrid() {
    var templates = document.getElementsByClassName('template');
    for (i = 0; i < templates.length; i++) {
        templates[i].addEventListener('click', function () {
            selectTemplate(this);
        });
    }
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

    button.addEventListener('click', function(){
        editComponent(this.getAttribute('data-component-id'));
    });

    btnDiv.appendChild(button);
}

function editComponent(componentId){
    if(componentId === undefined){
        return false;
    }

    var currentComponent = components[componentId];
    if(!currentComponent){
        return false;
    }
    var ajaxContent = document.querySelector('#popin-editComponent .ajax-content');
    var ajax = new Ajax();
    ajax.post(urlEditComponent + currentComponent.template_id, currentComponent, function (data) {
        var formConfig = document.createElement('form');
        formConfig.setAttribute('name', 'form-config-component');
        formConfig.innerHTML = data;

        formConfig.addEventListener('submit', function(evt){
            evt.preventDefault();
            validateComponent();
        });

        ajaxContent.innerHTML = "";
        ajaxContent.appendChild(formConfig);
    });

    fadeIn(document.querySelector('#popin-editComponent'));
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
        addEditComponentButton(oldHeight, this);
        console.log(this);
    }.bind(components.length), 450);

    components.push(data['data']);

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