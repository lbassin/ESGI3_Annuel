<h1>Dashboard</h1>

<?php echo $pseudo; ?>

<div id="container-data-1" style="width: 100%; height: 400px; margin: 0 auto"></div>
<div id="container-data-2" style="width: 50%; height: 400px; margin: 0 auto; float: left;"></div>
<div id="container-data-3" style="width: 50%; height: 400px; margin: 0 auto; float: left;"></div>


<script>
    var data = '<?php echo $pseudo; ?>';
</script>

<script type="text/javascript" src="<?php echo Helpers::getAsset('js/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Helpers::getAsset('js/modals/widgets/dashboard.js'); ?>"></script>