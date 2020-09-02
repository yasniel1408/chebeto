<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tipo_contrato]].
 *
 * @see Tipo_contrato
 */
class Tipo_contratoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tipo_contrato[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tipo_contrato|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
