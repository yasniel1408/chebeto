<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Notificaciones]].
 *
 * @see Notificaciones
 */
class NotificacionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Notificaciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Notificaciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
