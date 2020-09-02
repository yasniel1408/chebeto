<?php
/**
 * Created by PhpStorm.
 * User: LisiyTito
 * Date: 3/7/2019
 * Time: 17:25
 */

?>

<div id="container" style="min-width: 100%; height: 400px; max-width: 600px; margin: 0 auto"></div>

<?php
$pesronas = \app\models\Persona::find()->all();
$arregloViasStudio = array();
$aregloParaMostrar = array();
$arregloParaJs = array();
foreach ($pesronas as $p){
    $viaStudio = \app\models\Via_conocido_estudio::findOne($p->id_via_conocio_estudio);
    if($viaStudio)
    array_push($arregloViasStudio, $viaStudio->nombre);
}


$arregloIntermedio = array_count_values($arregloViasStudio);

$arregloDeKeys = array_keys($arregloIntermedio);
$arregloDeValores = array_values($arregloIntermedio);

for($i = 0; $i<count($arregloDeKeys); $i++){
    $arreglitoTC = array('name'=>$arregloDeKeys[$i],'y'=>$arregloDeValores[$i]);
    array_push($aregloParaMostrar,$arreglitoTC);
}

$arregloParaJs = json_encode($aregloParaMostrar);

$script = <<< JS

$(document).ready(function () {
    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Vias por donde se conoce el estudio'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b><br> ' +
             '{point.percentage:.1f} %'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
        name: 'Cantidad',
        colorByPoint: true,
        data: $arregloParaJs,
        }]
    });
});


JS;
$this->registerJs($script);
?>
