var sizeSelector = document.querySelector('select[name="currentSize"]');
sizeSelector.addEventListener('change', function () {
    var query = addParamToUrl(window.location.search, 'size', this.value);

    window.location.href = window.location.origin + window.location.pathname + query;
});

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
        if (currentParam < params.length) {
            queryString += '&';
        }
    }

    return queryString;
}

function getCurrentSize(){
    var query = window.location.search;
    query = query.substr(1, query.length);
    query = query.split("&");

    for (i = 0; i < query.length; i++) {
        param = query[i].split('=');
        if(param[0] === 'size'){
            return param[1];
        }
    }

    return null;
}