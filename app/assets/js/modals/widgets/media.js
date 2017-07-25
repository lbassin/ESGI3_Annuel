function initMediaUploader() {
    document.querySelector("#input-image").addEventListener('change', function () {

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
                        var elem = document.createElement("img");
                        elem.setAttribute("src", data['base_path'] + "app/assets/media/tmp/" + data['image']);
                        elem.setAttribute("width", '500px');
                        document.querySelector("#image-preview-final").innerHTML = '';
                        document.querySelector("#image-preview-final").appendChild(elem);
                        var elemHidden = document.createElement("input");
                        elemHidden.setAttribute("type", "hidden");
                        elemHidden.setAttribute("name", "path");
                        elemHidden.setAttribute("value", "app/assets/media/tmp/" + data['image']);
                        document.querySelector("#image-preview-final").appendChild(elemHidden);
                    } else {
                        console.log("fail");
                    }
                });
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
}
initMediaUploader();
