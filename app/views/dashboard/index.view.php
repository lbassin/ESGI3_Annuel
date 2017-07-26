<h1>Dashboard</h1>

<div id="container-data-2" style="width: 40%; height: 400px; margin: 0 auto; float: left;margin-top: 7%;"></div>

<div id="container-data-1" style="width: 60%; height: 400px; margin: 0 auto; float: left;margin-top: 7%;"></div>


<script>
    var nbArticleDate = '<?php echo json_encode($nbArticleDate); ?>';
    var nbArticlePublie = '<?php echo json_encode($nbArticlePublie); ?>';
</script>

<script type="text/javascript" src="<?php echo Helpers::getAsset('js/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Helpers::getAsset('js/modals/widgets/dashboard.js'); ?>"></script>