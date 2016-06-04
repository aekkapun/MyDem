<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\CarApperance;

/**
 * CarApperanceSeach represents the model behind the search form about `backend\modules\master\models\CarApperance`.
 */
class CarApperanceSeach extends CarApperance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'TYP'], 'integer'],
            [['CAR_APPEAR_ID', 'CAR_APPEAR', 'CAR_APPEAR_EN'], 'safe'],
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
        $query = CarApperance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'STATUS' => $this->STATUS,
            'TYP' => $this->TYP,
        ]);

        $query->andFilterWhere(['like', 'CAR_APPEAR_ID', $this->CAR_APPEAR_ID])
            ->andFilterWhere(['like', 'CAR_APPEAR', $this->CAR_APPEAR])
            ->andFilterWhere(['like', 'CAR_APPEAR_EN', $this->CAR_APPEAR_EN]);

        return $dataProvider;
    }
}
