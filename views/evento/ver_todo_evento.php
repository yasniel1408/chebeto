<?php
/**
 * Created by PhpStorm.
 * User: LisiyTito
 * Date: 02/07/2019
 * Time: 11:38
 */

?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <h4>Evento</h4>
        <?php
            echo \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'descripcion',
                ],
            ]);
        ?>
    </div>
</div>
