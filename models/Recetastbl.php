<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recetastbl".
 *
 * @property integer $id
 * @property string $receta
 * @property string $descripcion
 * @property string $preparacion
 * @property integer $usuariostbl_id
 *
 * @property Puntuaciontbl[] $puntuaciontbls
 * @property Recetasproducto[] $recetasproductos
 * @property Usuariostbl $usuariostbl
 */
class Recetastbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recetastbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receta', 'usuariostbl_id'], 'required'],
            [['usuariostbl_id'], 'integer'],
            [['receta'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['preparacion'], 'string', 'max' => 1000],
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
            'receta' => 'Receta',
            'descripcion' => 'Descripcion',
            'preparacion' => 'Preparacion',
            'usuariostbl_id' => 'Usuariostbl ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntuaciontbls()
    {
        return $this->hasMany(Puntuaciontbl::className(), ['recetastbl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecetasproductos()
    {
        return $this->hasMany(Recetasproducto::className(), ['recetastbl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariostbl()
    {
        return $this->hasOne(Usuariostbl::className(), ['id' => 'usuariostbl_id']);
    }
}
