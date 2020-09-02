<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%evento}}".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $tipo_contrato_id
 * @property string $equipo
 * @property string $descripcion
 * @property string $estado
 * @property string $fecha_contrato
 * @property string $fecha_evento
 * @property string $fecha_fin
 * @property string $allday
 *
 * @property TipoContrato $tipoContrato
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%evento}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'required'],
            [['tipo_contrato_id'], 'integer'],
            [['tipo_contrato_id'], 'required', 'message'=>'Debe seleccionar un tipo de evento'],
            [['equipo'], 'string'],
            [['descripcion'], 'string'],
            [['allday'], 'string'],
            [['estado'], 'string'],
            [['fecha_evento', 'fecha_fin'], 'required'],
            [['fecha_contrato', 'fecha_evento', 'fecha_fin'], 'safe'],
            [['tipo_contrato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo_contrato::className(), 'targetAttribute' => ['tipo_contrato_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'tipo_contrato_id' => 'Tipo de Evento',
            'equipo' => 'Equipo',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',

            'fecha_contrato' => 'Fecha Contrato',
            'fecha_evento' => 'Fecha Evento',
            'fecha_fin' => 'Fecha de Fin',
            'allday' => 'Todo el día',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoContrato()
    {
        return $this->hasOne(Tipo_contrato::className(), ['id' => 'tipo_contrato_id']);
    }

    /**
     * @inheritdoc
     * @return EventoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventoQuery(get_called_class());
    }

}
