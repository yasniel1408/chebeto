<?php

namespace app\models;

use Yii;
use app\models\MstrUnidadOrganizativa;

/**
 * This is the model class for table "user_persona".
 *
 * @property integer $id_user
 * @property integer $id
 * @property integer $id_persona
 *
 * @property SigAsPersona $idPersona
 * @property User $idUser
 */
class UserPersona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_persona'], 'required'],
            [['id_user', 'id_persona'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_persona' => 'Id Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona()
    {
        return $this->hasOne(SigAsPersona::className(), ['id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * Funcion para retornar la unidad organizativa a la que pertenece el usuario
     */
    public function getIdUnidadorganizativa()
    {
        $sql = "SELECT PUBLIC.mstr_unidad_organizativa.* FROM mstr_unidad_organizativa WHERE mstr_unidad_organizativa.id_unidad_organizativa IN 
(SELECT id_unidad_organizativa from hist_trabajador_unidad_organizativa where id_persona = $this->id_persona)";
        $idUnidad = HistTrabajadorUnidadOrganizativa::findOne(['id_persona' => $this->id_persona]);
        $unidad = MstrUnidadOrganizativa::findOne(['id_unidad_organizativa' => $idUnidad->id_unidad_organizativa]);
        return $unidad;

//        return MstrUnidadOrganizativa::findBySql($sql);
//        return $this->hasOne(HistTrabajadorUnidadOrganizativa::className(), ['id_persona' => 'id_persona','activo'=>STATUS_ACTIVE]);
    }

    public function getIdFacultadByUser()
    {
        $sql = "SELECT *
                    FROM mstr_departamento_docente
                    WHERE id_unidad_organizativa = :uOrg
                    OR id_unidad_organizativa in (SELECT id_unidad_organizativa 
                                                  FROM mstr_departamento_docente
                                                  WHERE id_facultad = :uOrg)";
        $facultad = MstrDepartamentoDocente::findBySql($sql, [
                        'uOrg' => $this->getIdUnidadorganizativa()->id_unidad_organizativa,
                    ])->one();
        return MstrFacultad::findOne(['id_facultad'=>$facultad->id_facultad]);
    }

    /**
     * @param $id_user
     * @return \yii\db\ActiveQuery
     * Funcion para devolver una persona dado un id de Usuario
     */
    public function getIdPersonaByIdUser($id_user)
    {
        $sql = "SELECT * FROM sig_as_persona WHERE id_persona IN (SELECT id_persona from user_persona WHERE id_user = $id_user)";
        return SigAsPersona::findBySql($sql);
    }

    /**
     * @param $id
     * Funcion para buscar el rol por usuario
     */
}
