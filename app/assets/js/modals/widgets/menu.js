var childCount = 0;

var addButton = document.querySelector('#add-sublink');
if (addButton) {
    addButton.addEventListener('click', function () {
        addNewSublink()
    });
}


if (data) {
    data = JSON.parse(data);
    for (var id in data) {
        if (!data.hasOwnProperty(id)) {
            continue;
        }

        var label = data[id].label;
        var url = data[id].url;
        addNewSublink(label, url, id);
    }
}
initRemoveBtns();


function addNewSublink(label, url, id) {
    var input = document.querySelector('#field-line-example').querySelector('div').cloneNode(true);

    var inputLabel = input.querySelector('.input-label');
    var labelLabel = input.querySelector('label[for=' + inputLabel.getAttribute('id') + ']');
    inputLabel.setAttribute('name', 'child[' + childCount + '][label]');
    inputLabel.setAttribute('id', inputLabel.getAttribute('id') + childCount);
    labelLabel.setAttribute('for', labelLabel.getAttribute('for') + childCount);

    if (label) {
        inputLabel.setAttribute('value', label);
    }

    var inputUrl = input.querySelector('.input-url');
    var labelUrl = input.querySelector('label[for=' + inputUrl.getAttribute('id') + ']');
    inputUrl.setAttribute('name', 'child[' + childCount + '][url]');
    inputUrl.setAttribute('id', inputUrl.getAttribute('id') + childCount);
    labelUrl.setAttribute('for', labelUrl.getAttribute('for') + childCount);

    if (url) {
        inputUrl.setAttribute('value', url);
    }

    var inputId = input.querySelector('.input-id');
    inputId.setAttribute('name', 'child[' + childCount + '][id]');
    if (id) {
        inputId.setAttribute('value', id);
    }

    childCount += 1;
    document.querySelector('#dropdown-config').appendChild(input);
}

function initRemoveBtns() {
    var removeButtons = document.querySelectorAll('.remove-sublink');
    if (removeButtons) {
        for (var i = 0; i < removeButtons.length; i++) {
            removeButtons[i].addEventListener('click', function () {
                this.parentNode.remove();
            })
        }
    }
}