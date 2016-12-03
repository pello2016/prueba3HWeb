<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recetasproducto".
 *
 * @property integer $id
 * @property integer $recetastbl_id
 * @property integer $productostbl_id
 * @property integer $cantidad
 * @property string $unidad
 *
 * @property Productostbl $productostbl
 * @property Recetastbl $recetastbl
 */
class Recetasproducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recetasproducto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recetastbl_id', 'productostbl_id'], 'required'],
            [['recetastbl_id', 'productostbl_id', 'cantidad'], 'integer'],
            [['unidad'], 'string', 'max' => 45],
            [['productostbl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productostbl::className(), 'targetAttribute' => ['productostbl_id' => 'id']],
            [['recetastbl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recetastbl::className(), 'targetAttribute' => ['recetastbl_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recetastbl_id' => 'Recetastbl ID',
            'productostbl_id' => 'Productostbl ID',
            'cantidad' => 'Cantidad',
            'unidad' => 'Unidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductostbl()
    {
        return $this->hasOne(Productostbl::className(), ['id' => 'productostbl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecetastbl()
    {
        return $this->hasOne(Recetastbl::className(), ['id' => 'recetastbl_id']);
    }
}
