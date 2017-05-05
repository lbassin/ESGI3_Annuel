<script>
    var setup = [
        <?php foreach($sqlSetup as $setup): ?>
        '<?php echo $setup; ?>',
        <?php endforeach; ?>
    ];

    //    var ajax = new Ajax();
    setup.forEach(function () {
//        ajax.post('http://127.0.0.1:8080/setup/install', {}, function(data){
//            console.log(data);
//        })
    });
</script>