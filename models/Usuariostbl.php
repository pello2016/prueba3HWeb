<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuariostbl".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property integer $rolestbl_id
 *
 * @property Puntuaciontbl[] $puntuaciontbls
 * @property Recetastbl[] $recetastbls
 * @property Rolestbl $rolestbl
 */
class Usuariostbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuariostbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nombre', 'apellido', 'rolestbl_id'], 'required'],
            [['rolestbl_id'], 'integer'],
            [['username', 'nombre', 'apellido', 'email'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 70],
            [['rolestbl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rolestbl::className(), 'targetAttribute' => ['rolestbl_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Clave',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Correo Electrónico',
            'rolestbl_id' => 'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntuaciontbls()
    {
        return $this->hasMany(Puntuaciontbl::className(), ['usuariostbl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecetastbls()
    {
        return $this->hasMany(Recetastbl::className(), ['usuariostbl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolestbl()
    {
        return $this->hasOne(Rolestbl::className(), ['id' => 'rolestbl_id']);
    }
}
