<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

use yii\helpers\Html;
use dektrium\user\models\User;
use dektrium\user\widgets\UserMenu;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$tipos_contratos = \app\models\Tipo_contrato::find()->all();
$perfil = \app\models\Profile::find()->where(['user_id' => Yii::$app->user->id])->one();
date_default_timezone_set($perfil->timezone);
?>

<?php
\yii\bootstrap\Modal::begin([
    'header' =>'EVENTOS',
    'id'     =>'modal',
    'size'   =>'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
    'options' => ['tabindex' => false]
]);
echo  "<div id='modalContent'>".
    "<div class='text-center'>".
    Html::img('@web/img/ajax.gif',['id' => 'loader','width' => '60']).
    "</div>".
    "</div>";
\yii\bootstrap\Modal::end();
?>

<div class="site-index">
<div class="row">
    <div class="col-lg-9 col-xs-12">
        <div id='calendar'></div>
    </div>

    <div class="col-lg-3 col-xs-12">

        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">Leyenda</h4>
            </div>
            <div class="box-body">
                <?php foreach ($tipos_contratos as $tc){?>
                    <div class="external-event" style="color:white; position: relative; background:<?= $tc->color?>"><?= $tc->nombre?></div>
                <?php }?>
        </div>


    </div>
</div>
</div>

    <form action="" hidden id="formularioID">
        <input type="number" name="id" id="inputFormularioID">
    </form>

    <form action="" hidden id="formularioMover">
        <input type="number" name="inputFormularioIDMover" id="inputFormularioIDMover">
        <input type="datetime" name="inputFormularioFechaInicio" id="inputFormularioFechaInicio">
        <input type="datetime" name="inputFormularioFechaFin" id="inputFormularioFechaFin">
    </form>

<?php
////////////////////////////////EVENTOS//////////////////////////////////////////////////////
$contratos = \app\models\Evento::find()->all();
$modelosCalendario = array();

foreach ($contratos as $c){
    $modelCalendar = new \app\models\ModelCalendar();
    $tipo_contrato = \app\models\Tipo_contrato::findOne(['id'=>$c->tipo_contrato_id]);

    if($c->equipo){
        $modelCalendar->title =  $c->nombre.'-'.$c->estado.' / EQUIPO: '.$c->equipo;
    }else{
        $modelCalendar->title =  $c->nombre.'-'.$c->estado;
    }

    $modelCalendar->id = $c->id;
    $modelCalendar->start = $c->fecha_evento;
    $modelCalendar->end =  $c->fecha_fin;
    $modelCalendar->color = $tipo_contrato->color;
    if($c->allday=='SI')
    $modelCalendar->allDay = true;

    array_push($modelosCalendario,$modelCalendar);

}

$arregloParaJS = json_encode($modelosCalendario);

$script = "
                setInterval(function(){
                  $.ajax({
                        url: '/chebeto/web/site/verificareventos',
                        type: 'post'
                    }) 
                },3000)
                
                

				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: false,
					eventLimit: true, // allow \"more\" link when too many events
					selectable: true,
                    events:$arregloParaJS,
                    droppable : false,
					select: function(start, end, allDay) {
                        $('#modal').modal('show')
                               .find('#modalContent')
                               .load('/chebeto/web/evento/createevento');

                        setTimeout(function(){
                            if(start.format('Y h:m')==end.format('Y h:m')){
                                 $('#allday').val('SI')
                                 $('#fecha_evento_formulario_crear').addClass('hidden')
                                 $('#fecha_fin_formulario_crear').addClass('hidden')
                            }else{
                                $('#allday').val('NO')
                            }
                                $('#fecha_evento_formulario_crear_input').val(start.format('Y-M-D H:m'))
                                $('#fecha_fin_formulario_crear_input').val(end.format('Y-M-D H  :m'))
                        },2000)
                    },
					
					eventClick: function(e) {
					    $('#inputFormularioID').val(e.id);
					    $.ajax({
                            url: '/chebeto/web/site/formupdate',
                            data: $('#formularioID').serialize(),
                            type: 'post'
                        }).done(function(data) {
                           $('#modal').modal('show')
                                  .find('#modalContent')
                                  .load('/chebeto/web/evento/updateajax/?id='+e.id);
                           

                        });
                         setTimeout(function(){
                           if($('#evento-estado').val() == 'Terminado')      
                                $('#estadoEditar').addClass('hidden')
                        },2000)
					},
					
					//Arrastrar el evento
					eventDragStop: function(e){
                          $('#inputFormularioIDMover').val(e.id);
                          $('#inputFormularioFechaInicio').val(e.start.format('Y-M-D h:m'));
                          $('#inputFormularioFechaFin').val(e.end.format('Y-M-D h:m'));
                            $.ajax({
                                url: '/chebeto/web/site/mover',
                                data: $('#formularioMover').serialize(),
                                type: 'post'
                            }).done(function(data) {
                               alert('El evento '+data+' ha sido movido de fecha correctamente')
                            });
					},
					
				
					
					//Cambiar de tamaño el evento
					eventResizeStart: function(e) {
					  alert(e.start.format('Y-M-D h:m'))
					},
					
					eventResizeStop: function(e) {
					  alert(e.start.format('Y-M-D h:m'))
					},
					
				});

";
$this->registerJs($script);
?>
