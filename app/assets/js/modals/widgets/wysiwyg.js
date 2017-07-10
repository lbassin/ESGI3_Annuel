var editor = document.querySelector('#editor');
var form = getParentByTagName(editor, 'form');

form.addEventListener('submit', function () {
    var input = document.querySelector('#editor-input');
    input.setAttribute('value', JSON.stringify(quill.getContents()));
});

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

hljs.configure({   // optionally configure hljs
    languages: ['javascript', 'ruby', 'python', 'php']
});

var quill = new Quill('#editor', {
    modules: {
        toolbar: toolbarOptions,
        formula: true,
        syntax: true
    },
    theme: 'snow'
});


