<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%notificaciones}}".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $visto
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notificaciones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['visto'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'visto' => 'Visto',
        ];
    }

    /**
     * @inheritdoc
     * @return NotificacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificacionesQuery(get_called_class());
    }
}
