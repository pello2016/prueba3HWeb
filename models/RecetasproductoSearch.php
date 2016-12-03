<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recetasproducto;

/**
 * RecetasproductoSearch represents the model behind the search form about `app\models\Recetasproducto`.
 */
class RecetasproductoSearch extends Recetasproducto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'recetastbl_id', 'productostbl_id', 'cantidad'], 'integer'],
            [['unidad'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Recetasproducto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'recetastbl_id' => $this->recetastbl_id,
            'productostbl_id' => $this->productostbl_id,
            'cantidad' => $this->cantidad,
        ]);

        $query->andFilterWhere(['like', 'unidad', $this->unidad]);

        return $dataProvider;
    }
}
