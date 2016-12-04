<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntuaciontbl".
 *
 * @property integer $id
 * @property integer $valoracion
 * @property integer $usuariostbl_id
 * @property integer $recetastbl_id
 *
 * @property Recetastbl $recetastbl
 * @property Usuariostbl $usuariostbl
 */
class Puntuaciontbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puntuaciontbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valoracion', 'usuariostbl_id', 'recetastbl_id'], 'required'],
            [['valoracion', 'usuariostbl_id', 'recetastbl_id'], 'integer'],
            [['recetastbl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recetastbl::className(), 'targetAttribute' => ['recetastbl_id' => 'id']],
            [['usuariostbl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuariostbl::className(), 'targetAttribute' => ['usuariostbl_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valoracion' => 'Valoración',
            'usuariostbl_id' => 'Usuario',
            'recetastbl_id' => 'Receta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecetastbl()
    {
        return $this->hasOne(Recetastbl::className(), ['id' => 'recetastbl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariostbl()
    {
        return $this->hasOne(Usuariostbl::className(), ['id' => 'usuariostbl_id']);
    }
}
