<div id="renderer">
</div>

<script>
    hljs.configure({   // optionally configure hljs
        languages: ['javascript', 'ruby', 'python', 'php']
    });

    var renderer = new Quill('#renderer', {
        modules: {
            toolbar: false,
            formula: true,
            syntax: true
        },
        theme: 'bubble'
    });
</script>