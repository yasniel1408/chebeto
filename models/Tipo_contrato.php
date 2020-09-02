<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tipo_contrato}}".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $color
 *
 * @property Contrato[] $contratos
 * @property TipoContratoPromocion[] $tipoContratoPromocions
 * @property Promocion[] $promocions
 */
class Tipo_contrato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tipo_contrato}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'color'], 'required'],
            [['nombre', 'color'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
            [['color'], 'unique'],
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
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['tipo_contrato_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoContratoPromocions()
    {
        return $this->hasMany(TipoContratoPromocion::className(), ['tipo_contrato_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocions()
    {
        return $this->hasMany(Promocion::className(), ['id' => 'promocion_id'])->viaTable('{{%tipo_contrato_promocion}}', ['tipo_contrato_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return Tipo_contratoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new Tipo_contratoQuery(get_called_class());
    }
}
