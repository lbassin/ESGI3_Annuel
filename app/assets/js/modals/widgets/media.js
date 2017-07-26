function initMediaUploader() {
    var input = document.querySelectorAll("input[type=file]");
    console.log(input);
    if (input.length === 0) {
        return false;
    }

    for (var i = 0; i < input.length; i++) {

        input[i].addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                var that = this.files[0];
                reader.onload = function (e) {

                    var data = {
                        "nom": that['name'],
                        "type": that['type'],
                        "image": e.target.result
                    };

                    (new Ajax).post(mediaPreview, data, function (data) {
                        data = JSON.parse(data);
                        if (data['success']) {
                            var inputName = this.getAttribute('name');

                            var elem = document.createElement("img");
                            elem.setAttribute("src", data['base_path'] + "app/assets/media/tmp/" + data['image']);
                            elem.setAttribute("width", '500px');
                            document.querySelector("#image-preview-" + inputName).innerHTML = '';
                            document.querySelector("#image-preview-" + inputName).appendChild(elem);
                            var elemHidden = document.createElement("input");
                            elemHidden.setAttribute("type", "hidden");
                            elemHidden.setAttribute("name", "path_" + inputName);
                            elemHidden.setAttribute("value", "app/assets/media/tmp/" + data['image']);
                            document.querySelector("#image-preview-" + inputName).appendChild(elemHidden);
                        } else {
                            console.log("fail");
                        }
                    }.bind(this));
                }.bind(this);

                reader.readAsDataURL(this.files[0]);
            }
        });
    }
}

initMediaUploader();
