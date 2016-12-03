<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recetastbl;

/**
 * RecetastblSearch represents the model behind the search form about `app\models\Recetastbl`.
 */
class RecetastblSearch extends Recetastbl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuariostbl_id'], 'integer'],
            [['receta', 'descripcion', 'preparacion'], 'safe'],
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
        $query = Recetastbl::find();

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
            'usuariostbl_id' => $this->usuariostbl_id,
        ]);

        $query->andFilterWhere(['like', 'receta', $this->receta])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'preparacion', $this->preparacion]);

        return $dataProvider;
    }
}
