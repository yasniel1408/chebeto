<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 * @property string $timezone
 * @property string $foto
 *
 * @property User $user
 */
class ProfileFoto extends Model
{
    public $foto;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foto'], 'image', 'extensions'=>'png,jpg,jpeg','maxSize' => 1024*1024*2,'tooBig' => 'El tamaño máximo permitido es 2MB',],
        ];
    }

    public function actualizarfoto($id){

        $user = Profile::findOne($id);

        $this->foto = UploadedFile::getInstance($this,'foto');

        $user->foto = $user->user_id. '.png';
        $user->update();
        $this->foto->saveAs('fotoperfil/' . $user->foto);

    }

}
