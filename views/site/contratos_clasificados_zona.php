<?php
/**
 * Created by PhpStorm.
 * User: LisiyTito
 * Date: 3/7/2019
 * Time: 17:25
 */
?>

<div id="containerr" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
<div id="containerm" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
<div id="containerp" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

<?php
//REPARTO
$repartos = app\models\Reparto::find()->all();
$ARREGLOGENERALR = array();
$arregloTipoContrato = array();
foreach ($repartos as $r) {
$arregloTipoContratoReseteado = array();
    foreach ($r->direccions as $d) {
        foreach ($d->personas as $p) {
            if($p->fotografiado == 1) {
                foreach ($p->contratos as $C) {
                    if($C->anulado == 0) {
                        array_push($arregloTipoContrato, $C->tipoContrato->nombre);
                        array_push($arregloTipoContratoReseteado, $C->tipoContrato->nombre);
                    }
                }
            }
        }
    }

    $arregloCantidadTipoContrato = array_count_values($arregloTipoContrato);
    $arregloTipoContartosKeys = array_keys($arregloCantidadTipoContrato);
    $arregloTipoContratoValues = array_values($arregloCantidadTipoContrato);

    $arregloCantidadTipoContratoR = array_count_values($arregloTipoContratoReseteado);
    $arregloTipoContartosKeysR = array_keys($arregloCantidadTipoContratoR);
    $arregloTipoContratoValuesR = array_values($arregloCantidadTipoContratoR);

    $arregloParaReparto = array(0,0,0,0,0,0);
    for($i = 0; $i < count($arregloTipoContartosKeysR); $i++){
        if($arregloTipoContartosKeysR[$i] == 'Niño'){
            $arregloParaReparto[0] = $arregloTipoContratoValuesR[$i];
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañera'){
            $arregloParaReparto[1]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Boda'){
            $arregloParaReparto[2]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañeros'){
            $arregloParaReparto[3]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Niño de meses'){
            $arregloParaReparto[4]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Eventual'){
            $arregloParaReparto[5]= $arregloTipoContratoValuesR[$i];          
        }
    }

    $arreglitoTC = array('name'=>$r->nombre,'data'=>$arregloParaReparto);
    array_push($ARREGLOGENERALR,$arreglitoTC);

}

$arregloParaRepartoKO = array('Niño','Quinceañera','Boda','Quinceañeros','Niño de meses', 'Eventual');
$paraMostrarJsr = json_encode($arregloParaRepartoKO);

$arregloParaJSR = json_encode($ARREGLOGENERALR);

//MUNICIPIOS
$municipios = app\models\Municipio::find()->all();
$ARREGLOGENERALM = array();
$arregloTipoContrato = array();
foreach($municipios as $m){
    $arregloTipoContratoReseteado = array();    
    foreach ($m->repartos as $r) {
        foreach ($r->direccions as $d) {
            foreach ($d->personas as $p) {
                if($p->fotografiado == 1) {
                    foreach ($p->contratos as $C) {
                        if($C->anulado == 0) {
                            array_push($arregloTipoContrato, $C->tipoContrato->nombre);
                            array_push($arregloTipoContratoReseteado, $C->tipoContrato->nombre);
                        }
                    }
                }
            }
        }
    }
    $arregloCantidadTipoContrato = array_count_values($arregloTipoContrato);
    $arregloTipoContartosKeys = array_keys($arregloCantidadTipoContrato);
    $arregloTipoContratoValues = array_values($arregloCantidadTipoContrato);

    $arregloCantidadTipoContratoR = array_count_values($arregloTipoContratoReseteado);
    $arregloTipoContartosKeysR = array_keys($arregloCantidadTipoContratoR);
    $arregloTipoContratoValuesR = array_values($arregloCantidadTipoContratoR);

    $arregloParaReparto = array(0,0,0,0,0,0);
    for($i = 0; $i < count($arregloTipoContartosKeysR); $i++){
        if($arregloTipoContartosKeysR[$i] == 'Niño'){
            $arregloParaReparto[0] = $arregloTipoContratoValuesR[$i];
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañera'){
            $arregloParaReparto[1]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Boda'){
            $arregloParaReparto[2]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañeros'){
            $arregloParaReparto[3]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Niño de meses'){
            $arregloParaReparto[4]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Eventual'){
            $arregloParaReparto[5]= $arregloTipoContratoValuesR[$i];          
        }
    }

    $arreglitoTC = array('name'=>$m->nombre,'data'=>$arregloParaReparto);
    array_push($ARREGLOGENERALM,$arreglitoTC);
}

$arregloParaRepartoKO = array('Niño','Quinceañera','Boda','Quinceañeros','Niño de meses', 'Eventual');
$paraMostrarJsM = json_encode($arregloParaRepartoKO);

$arregloParaJSM = json_encode($ARREGLOGENERALM);



//PROVINCIAS
$provincias = app\models\Provincia::find()->all();
$ARREGLOGENERALP = array();
$arregloTipoContrato = array();
foreach($provincias as $pr){
    $arregloTipoContratoReseteado = array();        
    foreach($pr->municipios as $m){
        foreach ($m->repartos as $r) {
            foreach ($r->direccions as $d) {
                foreach ($d->personas as $p) {
                    if($p->fotografiado == 1) {
                        foreach ($p->contratos as $C) {
                            if($C->anulado == 0) {
                                array_push($arregloTipoContrato, $C->tipoContrato->nombre);
                                array_push($arregloTipoContratoReseteado, $C->tipoContrato->nombre);
                            }
                        }
                    }
                }
            }
        }
    }
    $arregloCantidadTipoContrato = array_count_values($arregloTipoContrato);
    $arregloTipoContartosKeys = array_keys($arregloCantidadTipoContrato);
    $arregloTipoContratoValues = array_values($arregloCantidadTipoContrato);

    $arregloCantidadTipoContratoR = array_count_values($arregloTipoContratoReseteado);
    $arregloTipoContartosKeysR = array_keys($arregloCantidadTipoContratoR);
    $arregloTipoContratoValuesR = array_values($arregloCantidadTipoContratoR);

    $arregloParaReparto = array(0,0,0,0,0,0);
    for($i = 0; $i < count($arregloTipoContartosKeysR); $i++){
        if($arregloTipoContartosKeysR[$i] == 'Niño'){
            $arregloParaReparto[0] = $arregloTipoContratoValuesR[$i];
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañera'){
            $arregloParaReparto[1]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Boda'){
            $arregloParaReparto[2]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Quinceañeros'){
            $arregloParaReparto[3]= $arregloTipoContratoValuesR[$i];            
        }elseif($arregloTipoContartosKeysR[$i] == 'Niño de meses'){
            $arregloParaReparto[4]= $arregloTipoContratoValuesR[$i];           
        }elseif($arregloTipoContartosKeysR[$i] == 'Eventual'){
            $arregloParaReparto[5]= $arregloTipoContratoValuesR[$i];          
        }
    }

    $arreglitoTC = array('name'=>$pr->nombre,'data'=>$arregloParaReparto);
    array_push($ARREGLOGENERALP,$arreglitoTC);
}

$arregloParaRepartoKO = array('Niño','Quinceañera','Boda','Quinceañeros','Niño de meses', 'Eventual');
$paraMostrarJsP = json_encode($arregloParaRepartoKO);

$arregloParaJSP = json_encode($ARREGLOGENERALP);




$script = <<< JS

Highcharts.chart('containerr', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tipos de Contratos clasificados por Reparto'
    },
    xAxis: {
        categories: $paraMostrarJsr
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
    series: $arregloParaJSR
});


Highcharts.chart('containerm', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tipos de Contratos clasificados por Municipios'
    },
    xAxis: {
        categories: $paraMostrarJsM
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
    series: $arregloParaJSM
});


Highcharts.chart('containerp', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tipos de Contratos clasificados por Provincias'
    },
    xAxis: {
        categories: $paraMostrarJsP
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
    series: $arregloParaJSP
});


JS;
$this->registerJs($script);
?>
