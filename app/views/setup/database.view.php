<div style="text-align: center;">
    <div>
        Progression : <span id="setupDone"></span> / <span id="setupCount"></span><br>
    </div>
    <div id="log">

    </div>
    <a href="index.php?step=4" id="nextButton" style="display: none;">
        <button>Next</button>
    </a>
</div>
<script>
    var schemaSetup = [
        <?php foreach($setupFiles as $setup): ?>
        '<?php echo $setup; ?>',
        <?php endforeach; ?>
    ];

    document.getElementById('setupCount').innerText = schemaSetup.length;

    var setupInstalled = 0;
    var currentSetup;
    var ajax = new Ajax();

    var install = function (setup) {
        document.getElementById('setupDone').innerText = setupInstalled;

        if (!setup) {
            document.getElementById('nextButton').style.display = 'block';
            return true;
        }

        document.getElementById('log').innerHTML += setup + ' : ';

        ajax.post('index.php?step=installDatabase', {'setup': setup}, function (data) {
            setupInstalled += 1;

            document.getElementById('log').innerHTML += ' Done<br>';

            setup = schemaSetup.shift();
            install(setup);
        }, function (error, statut) {
            document.getElementById('log').innerText += error.responseText;
        });
    };

    currentSetup = schemaSetup.shift();
    install(currentSetup);
</script>