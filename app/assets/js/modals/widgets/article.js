getTemplates();

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

function selectTemplate() {
    var ajax = new Ajax();

    ajax.get(formTemplate + this.getAttribute('data-template-id'), function (data) {
        console.log(data);
    //     displayFormConfig(data, 'add', "#popin-addComponent .popin-content .template-config .ajax-content");
    })
}