var answerCount = 0;

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

        var answer = data[id].answer;
        addNewSublink(answer, id);
    }
}
initRemoveBtns();


function addNewSublink(answer, id) {
    var input = document.querySelector('#field-line-example').querySelector('div').cloneNode(true);

    var inputAnswer = input.querySelector('.input-answer');
    var labelAnswer = input.querySelector('label[for=' + inputAnswer.getAttribute('id') + ']');
    inputAnswer.setAttribute('name', 'answer[' + answerCount + '][answer]');
    inputAnswer.setAttribute('id', inputAnswer.getAttribute('id') + answerCount);
    labelAnswer.setAttribute('for', labelAnswer.getAttribute('for') + answerCount);

    if (answer) {
        inputAnswer.setAttribute('value', answer);
    }

    var inputId = input.querySelector('.input-id');
    inputId.setAttribute('name', 'answer[' + answerCount + '][id]');
    if (id) {
        inputId.setAttribute('value', id);
    }

    answerCount += 1;
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