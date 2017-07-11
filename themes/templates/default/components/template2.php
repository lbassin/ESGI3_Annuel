<div style="width: 33.33%;display: inline-block;vertical-align: top" class="quill-editor"
     data-value='<?php echo $data['editor0']; ?>'></div><!--
--><div style="width: 33.33%;display: inline-block;vertical-align: top" class="quill-editor"
     data-value='<?php echo $data['editor1']; ?>'>
</div><!--
--><div style="width: 33.33%;display: inline-block;vertical-align: top" class="quill-editor"
     data-value='<?php echo $data['editor2']; ?>'>
</div>

<script>
    var editors = document.querySelectorAll('.quill-editor');
    for (var i = 0; i < editors.length; i++) {
        var quill = new Quill(editors[i], {
            bounds: editors[i],
            modules: {
                toolbar: false,
                formula: true,
                syntax: true
            },
            readOnly: true,
            theme: 'bubble'
        });

        var editorData = editors[i].getAttribute('data-value');
        if (editorData) {
            quill.setContents(JSON.parse(editorData));
        }
    }
</script>