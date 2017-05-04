var Ajax = function () {
    this.request = new XMLHttpRequest();
};

Ajax.prototype.successEvent = function (event) {
};

Ajax.prototype.errorEvent = function (data, status, url) {
    console.error('Ajax error', url, status);
};

Ajax.prototype.progressEvent = function (event) {
};

Ajax.prototype.setCallback = function (success, error, progress) {
    if (!success) success = this.successEvent;
    if (!error) error = this.errorEvent;
    if (!progress) progress = this.progressEvent;

    var self = this;
    this.request.onreadystatechange = function () {
        if (self.request.readyState === XMLHttpRequest.DONE) {
            if (self.request.status === 200) {
                success(self.request.response, self.request.status);
            } else {
                console.log(self.request);
                error(self.request, self.request.status, self.request.responseURL);
            }
        } else if (self.request.readyState === XMLHttpRequest.LOADING) {
            progress(self.request);
        }
    }
};

Ajax.prototype.get = function (url, success, error, progress) {
    this.setCallback(success, error, progress);

    this.request.open('GET', url);
    this.request.send();
};

Ajax.prototype.post = function (url, data, success, error, progress) {
    this.setCallback(success, error, progress);

    if (typeof data === "object") {
        data = JSON.stringify(data)
    }

    this.request.open('POST', url);
    this.request.setRequestHeader("Content-Type", "application/json");
    this.request.send(data);
};