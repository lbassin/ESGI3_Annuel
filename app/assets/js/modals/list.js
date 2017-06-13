var sizeSelector = document.querySelector('select[name="currentSize"]');
sizeSelector.addEventListener('change', function () {
    window.location.href = window.location.origin +
        window.location.pathname +
        addParamToUrl(window.location.search, 'size', this.value);
});

var pageSelector = document.getElementsByClassName('change-page');
for (var i = 0; i < pageSelector.length; i++) {
    pageSelector[i].addEventListener('click', function (e) {
        var targetPage = parseInt(document.getElementById("input-page").value);

        if(this.classList.contains('next') && targetPage < parseInt(document.getElementById("input-page").getAttribute('data-max'))){
            targetPage += 1;
        }else if(this.classList.contains('previous') && targetPage > 1){
            targetPage -= 1;
        }else{
            return false;
        }

        window.location.href = window.location.origin +
            window.location.pathname +
            addParamToUrl(window.location.search, 'page', targetPage);
    });
}

var inputPageSelector = document.getElementById("input-page");
inputPageSelector.addEventListener('focusout', function(){
    redirectToPage();
});

inputPageSelector.addEventListener('keydown', function(event){
    if(event.keyCode === 13){
        redirectToPage();
    }
});

function redirectToPage(){
    var targetPage = parseInt(document.getElementById("input-page").value);

    if(targetPage < 1 || targetPage > parseInt(document.getElementById("input-page").getAttribute('data-max'))){
        return false;
    }

    window.location.href = window.location.origin +
        window.location.pathname +
        addParamToUrl(window.location.search, 'page', targetPage);
}

function addParamToUrl(query, name, value) {
    var i = 0;
    var param = null;
    var params = [];

    query = query.substr(1, query.length);
    query = query.split("&");

    for (i = 0; i < query.length; i++) {
        param = query[i].split('=');
        if (param.length === 2) {
            params[param[0]] = param[1];
        }
    }

    if (name && value) {
        params[name] = value;
    }

    var currentParam = 0;
    var queryString = '?';
    for (param in params) {
        currentParam += 1;

        queryString += param + '=' + params[param];
        if (currentParam < Object.keys(params).length) {
            queryString += '&';
        }
    }

    return queryString;
}
