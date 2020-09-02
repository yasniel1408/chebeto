<?php
/**
 * Created by PhpStorm.
 * User: LisiyTito
 * Date: 3/7/2019
 * Time: 17:25
 */
?>

<div id="containers" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="containerm" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="containera" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<?php

//SEMANA
$contratos = \app\models\Contrato::find()->where(['anulado'=>0])->all();
$tipos_contratos = \app\models\Tipo_contrato::find()->all();
$arregloContratosConCantidad = array();
$cantidadDeDiasMEs = date('t');

foreach ($tipos_contratos as $tc){
    $numeroDeSemana1 = 0;
    $numeroDeSemana2 = 0;
    $numeroDeSemana3 = 0;
    $numeroDeSemana4 = 0;
    $numeroDeSemana5 = 0;
    $arregloCantidades = array();
    for ($i = 1; $i <= $cantidadDeDiasMEs; $i++){
        if ($i<=7){
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-0".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
            $numeroDeSemana1 += count($cantidad);
        }elseif ($i>7 && $i<=14){
            if($i<10){
                $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-0".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
                $numeroDeSemana2 += count($cantidad);
            } else{
                $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
                $numeroDeSemana2 += count($cantidad);
            }
        }elseif ($i>14 && $i<=21){
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
            $numeroDeSemana3 += count($cantidad);
        }elseif ($i>21 && $i<=28){
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
            $numeroDeSemana4 += count($cantidad);
        }elseif ($i>28){
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y-m')."-".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
            $numeroDeSemana5 += count($cantidad);
        }

    }
    array_push($arregloCantidades,$numeroDeSemana1);
    array_push($arregloCantidades,$numeroDeSemana2);
    array_push($arregloCantidades,$numeroDeSemana3);
    array_push($arregloCantidades,$numeroDeSemana4);
    array_push($arregloCantidades,$numeroDeSemana5);

    $arreglitoTC = array('name'=>$tc->nombre,'data'=>$arregloCantidades);
    array_push($arregloContratosConCantidad,$arreglitoTC);

    $totalS += $numeroDeSemana1+$numeroDeSemana2+$numeroDeSemana3+$numeroDeSemana4+$numeroDeSemana5;

}
$arregloParaJSs = json_encode($arregloContratosConCantidad);



//MESES
$contratos = \app\models\Contrato::find()->where(['anulado'=>0])->all();
$tipos_contratos = \app\models\Tipo_contrato::find()->all();
$arregloContratosConCantidad = array();
$totalM = 0;
foreach ($tipos_contratos as $tc){
    $arregloCantidades = array();
    for ($i = 1; $i <= 12; $i++){
        if ($i<10){
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y')."-0".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
        }else{
            $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', date('Y')."-".$i])->andWhere(['tipo_contrato_id' => $tc->id])->all();
        }
        array_push($arregloCantidades, count($cantidad));
        $totalM += count($cantidad);
    }
    $arreglitoTC = array('name'=>$tc->nombre,'data'=>$arregloCantidades);
    array_push($arregloContratosConCantidad,$arreglitoTC);

}
$arregloParaJSm = json_encode($arregloContratosConCantidad);



//AÑOS
$contratos = \app\models\Contrato::find()->where(['anulado'=>0])->all();
$tipos_contratos = \app\models\Tipo_contrato::find()->all();
$arregloContratosConCantidad = array();

$arreglodeAños = array();
foreach ($contratos as $c){
   $fechapicada = explode('-',$c->fecha_evento);
   $anyyo = $fechapicada[0];
   array_push($arreglodeAños,$anyyo);
}
$arregloConKeysYLaCantidad = array_count_values($arreglodeAños);
$cantidadDeAños = count($arregloConKeysYLaCantidad);

$añosParaJS = json_encode(array_keys($arregloConKeysYLaCantidad));

$totalA = 0;

$arregloConKeys = array_keys($arregloConKeysYLaCantidad);
foreach ($tipos_contratos as $tc){
    $arregloCantidades = array();
    for ($i = 0; $i < count($arregloConKeysYLaCantidad); $i++){
        $cantidad = \app\models\Contrato::find()->where(['anulado'=>0])->andFilterWhere(['like', 'fecha_evento', $arregloConKeys[$i] ])->andWhere(['tipo_contrato_id' => $tc->id])->all();
        array_push($arregloCantidades, count($cantidad));
        $totalA += count($cantidad);
    }
    $arreglitoTC = array('name'=>$tc->nombre,'data'=>$arregloCantidades);
    array_push($arregloContratosConCantidad,$arreglitoTC);
}
$arregloParaJSa = json_encode($arregloContratosConCantidad);

$anyo = json_encode(date('Y'));
$mes = json_encode(date('m'));
$script = <<< JS

Highcharts.chart('containers', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tipos de Contratos clasificados por Semana del mes '+$mes+' del año '+$anyo+'    -Total: '+$totalS
    },
    xAxis: {
        categories: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Semana 5']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total(%)'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: $arregloParaJSs
});

Highcharts.chart('containerm', {
    chart: {
        type: 'column'
    },
    title: {
                text: 'Tipos de Contratos clasificados por Mes del año '+$anyo+'    -Total: '+$totalM
    },
    xAxis: {
        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total(%)'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: $arregloParaJSm
});

Highcharts.chart('containera', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tipos de Contratos clasificados por Año'+'    -Total: '+$totalA
    },
    xAxis: {
        categories: $añosParaJS
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total(%)'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: $arregloParaJSa
});

JS;
$this->registerJs($script);
?>
