function initWysiwygEditor() {
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}, {'align': []}],

        [{'size': ['small', false, 'large', 'huge']}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],

        [{'color': []}, {'background': []}],
        [{'font': ['Raleway']}],

        ['link', 'image', 'video', 'formula'],

        ['clean']
    ];

    hljs.configure({
        languages: ['javascript', 'ruby', 'python', 'php']
    });

    var editors = document.querySelectorAll('.wysiwyg-editor');
    for (var i = 0; i < editors.length; i++) {
        var quill = new Quill(editors[i], {
            modules: {
                toolbar: toolbarOptions,
                formula: true,
                syntax: true
            },
            theme: 'snow'
        });

        var input = editors[i].nextElementSibling;
        quill.on('text-change', function (data, old) {
            var input = this[0];
            var quill = this[1]; // I'm sorry ...

            input.setAttribute('value', JSON.stringify(quill.getContents()));
        }.bind([input, quill]));
    }
}
