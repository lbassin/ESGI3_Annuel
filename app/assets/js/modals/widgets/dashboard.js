nbArticleDate = JSON.parse(nbArticleDate);

var resultNbArticleDate = [];

for(var i in nbArticleDate)
    resultNbArticleDate.push([i,nbArticleDate[i]]);


var chart1 = new Highcharts.chart('container-data-1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Nombre d\'article publié par date'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nombre'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Nombre article',
        data: resultNbArticleDate,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

var rawResultArticlePublie = JSON.parse(nbArticlePublie);

var resultNbArticlePublie = [
    {
        name: 'Publié(s)',
        y: rawResultArticlePublie['publie']
    },
    {
        name: 'Non publié(s)',
        y: rawResultArticlePublie['non-publie'],
    }
];

var chart2 = new Highcharts.chart('container-data-2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Nombre d\'article publié et non publié'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Article',
        colorByPoint: true,
        data: resultNbArticlePublie
    }]
});

window.onresize = resize;

function resize() {
    chart1.setSize(document.querySelector("#container-data-1").offsetWidth, chart1.chartHeight, true);
    chart2.setSize(document.querySelector("#container-data-2").offsetWidth, chart2.chartHeight, true);
}