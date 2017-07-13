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
            templatePreview.addEventListener('click', selectTemplate);

            gridTemplates.appendChild(templatePreview);
        }
    })
}

// Click on a template preview
function selectTemplate() {
    var ajax = new Ajax();

    ajax.get(formTemplate + this.getAttribute('data-template-id'), function (data) {
        var formConfig = document.createElement('div');
        formConfig.setAttribute('id', 'template-config');
        formConfig.innerHTML = data;

        var formTag = formConfig.querySelector('form');
        if (formTag) {
            formConfig.innerHTML = formTag.innerHTML;
        }

        var templateIdInput = document.createElement('input');
        templateIdInput.setAttribute('type', 'hidden');
        templateIdInput.setAttribute('name', 'templateId');
        templateIdInput.setAttribute('value', this.getAttribute('data-template-id'));
        formConfig.appendChild(templateIdInput);

        var templateConfig = document.forms['model-form'].querySelector('#template-config');
        if (templateConfig) {
            if (confirm('Etes vous sur de vouloir changer de template ?\nCette action supprimare définitivement les données non sauvegardées')) {
                document.forms['model-form'].removeChild(templateConfig);
                document.forms['model-form'].appendChild(formConfig);
                refreshFormElements(formConfig);
            }
        } else {
            document.forms['model-form'].appendChild(formConfig);
            refreshFormElements(formConfig);
        }
    }.bind(this))
}