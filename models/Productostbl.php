<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productostbl".
 *
 * @property integer $id
 * @property string $producto
 * @property string $descripcion
 *
 * @property Recetasproducto[] $recetasproductos
 */
class Productostbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productostbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto'], 'required'],
            [['producto'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producto' => 'Producto',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecetasproductos()
    {
        return $this->hasMany(Recetasproducto::className(), ['productostbl_id' => 'id']);
    }
}
