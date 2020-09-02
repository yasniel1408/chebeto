<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%configuracion}}".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $valor
 * @property string $tipo_valor
 */
class Configuracion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%configuracion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'valor', 'tipo_valor'], 'required'],
            [['nombre', 'valor', 'tipo_valor'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
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
            'valor' => 'Valor',
            'tipo_valor' => 'Tipo Valor',
        ];
    }

    /**
     * @inheritdoc
     * @return ConfiguracionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfiguracionQuery(get_called_class());
    }
}
