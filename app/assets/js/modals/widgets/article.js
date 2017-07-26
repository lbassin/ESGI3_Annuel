getTemplates();

// Get preview of availables template
function getTemplates() {
    var ajax = new Ajax();
    ajax.get(urlTemplates, function (data) {
        var templates = JSON.parse(data);

        var templatePreview = null;
        var gridTemplates = document.querySelector('.widget.article_new #template-grid');
        for (var e = 0; e < templates.length; e++) {
            templatePreview = document.createElement('img');
            templatePreview.classList.add('template');
            templatePreview.setAttribute('src', templates[e].preview);
            templatePreview.setAttribute('data-template-id', templates[e].id);
            templatePreview.addEventListener('click', function () {
                selectTemplate(this.getAttribute('data-template-id'))
            });

            gridTemplates.appendChild(templatePreview);
        }
    })
}

// Click on a template preview
function selectTemplate(templateId) {
    var ajax = new Ajax();

    var articleId = null;
    var idInput = document.querySelector('input[name="id"]');
    if (idInput) {
        articleId = idInput.getAttribute('value');
    }

    ajax.get(formTemplate + templateId + '/' + articleId, function (data) {
        var formConfig = document.createElement('div');
        formConfig.setAttribute('id', 'template-config');
        formConfig.innerHTML = data;

        var formTag = formConfig.querySelector('form');
        if (formTag) {
            formConfig.innerHTML = formTag.innerHTML;
        }

        var templateIdInput = document.createElement('input');
        templateIdInput.setAttribute('type', 'hidden');
        templateIdInput.setAttribute('name', 'template_id');
        templateIdInput.setAttribute('value', this);
        formConfig.appendChild(templateIdInput);

        var templateConfig = document.forms['model-form'].querySelector('#template-config');
        if (templateConfig) {
            if (confirm('Etes vous sur de vouloir changer de template ?\nCette action supprimare définitivement les données non sauvegardées')) {
                document.forms['model-form'].removeChild(templateConfig);
                document.forms['model-form'].appendChild(formConfig);
                savedContent = null;

                initWysiwygInput();
                fillContent();
                refreshFormElements(formConfig);
            }
        } else {
            document.forms['model-form'].appendChild(formConfig);
            initWysiwygInput();
            fillContent();
            refreshFormElements(formConfig);
        }
    }.bind(templateId))
}

if (savedTemplateId) {
    selectTemplate(savedTemplateId);
}

function fillContent() {
    if (savedContent) {
        savedContent = JSON.parse(savedContent);
        for (var inputName in savedContent) {
            if (!savedContent.hasOwnProperty(inputName)) {
                continue;
            }

            var input = document.querySelector('[name="' + inputName + '"]');
            if (input) {
                input.setAttribute('value', savedContent[inputName]);
                if (input.getAttribute('type') === 'hidden') {
                    input.previousElementSibling.setAttribute('data-old-value', savedContent[inputName]);
                }
            }
        }
    }
}