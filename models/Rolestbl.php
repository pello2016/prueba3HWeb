<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rolestbl".
 *
 * @property integer $id
 * @property string $rol
 *
 * @property Usuariostbl[] $usuariostbls
 */
class Rolestbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rolestbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol'], 'required'],
            [['rol'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rol' => 'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariostbls()
    {
        return $this->hasMany(Usuariostbl::className(), ['rolestbl_id' => 'id']);
    }
}
