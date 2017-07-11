/*document.querySelector(tonbouton).addEventListener('click', function() {document.querySelector(tazone).append(tonmachin);});*/

let sublink = document.querySelector('#json-sublink').value;
let nbSublink = document.querySelector('#nb-sublink').value;

if (sublink != '') {
    initSubmenu(sublink);
}

function initSubmenu(sublink) {
    let data;
    try {
        data = JSON.parse(sublink);
    } catch (exc) {
        console.error("Parsing error:", exc);
    }
    for (let key in data) {
        let inputAttr = {
            'id': 'submenu-' + key,
            'label': data[key].link,
            'url': data[key].slug,
        };
        let form = getFormElement(inputAttr);
    }
}

function getFormElement(inputAttr) {
    let input;
    let secondForm = document.querySelector('.menu_sublink');
    for (let key in inputAttr) {
        input = document.querySelector('#input-' + key);
        var newInput = input.getAttribute().innerHTML();

        console.log(newInput);
        if (input != null) {
            input.setAttribute("value", inputAttr[key]);
        }
    }
    return '1';
}

function addInputs() {
    let inputAttr = {
        'id': 'submenu-' + nbSublink++,
        'label': '',
        'url': '',
    };
    getFormElement(inputAttr);
}

document.querySelector('#add-sublink').addEventListener('click', () => {

    addInputs();
});

/*
getLinks();

function getLinks() {
    var ajax = new Ajax();
    ajax.get(urlMenu, (data) => {
       var menus = JSON.parse(data);
    });
}*/



/*
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


*/

