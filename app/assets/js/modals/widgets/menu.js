var addButton = document.querySelector('#add-sublink');
if (addButton) {
    addButton.addEventListener('click', function () {
        var input = document.querySelector('#field-line-example').querySelector('div').cloneNode(true);
        document.querySelector('#dropdown-config').appendChild(input);
    });
}