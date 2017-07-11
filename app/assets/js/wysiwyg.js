var textArea = document.querySelectorAll('[data-wysiwyg]');
for (var i = 0; i < textArea.length; i++) {
    textArea[i].classList.add('ql-editor');
    textArea[i].innerHTML = getHtml(textArea[i].getAttribute('data-wysiwyg'));
}

function getHtml(json) {
    if (!json) {
        return '';
    }

    var editor = document.createElement('div');
    var quill = new Quill(editor, {
        modules: {
            toolbar: false,
            formula: true,
            syntax: true
        },
        readOnly: true,
        theme: 'snow'
    });

    quill.setContents(JSON.parse(json));

    return quill.root.innerHTML;
}
