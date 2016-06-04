<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\CarCategory;

/**
 * CarCategorySearch represents the model behind the search form about `backend\modules\master\models\CarCategory`.
 */
class CarCategorySearch extends CarCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CAR_CATE_ID'], 'integer'],
            [['CAR_CATE_NAME', 'CAR_CATE_NAME_EN', 'STATUS'], 'safe'],
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
        $query = CarCategory::find();

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
            'CAR_CATE_ID' => $this->CAR_CATE_ID,
        ]);

        $query->andFilterWhere(['like', 'CAR_CATE_NAME', $this->CAR_CATE_NAME])
            ->andFilterWhere(['like', 'CAR_CATE_NAME_EN', $this->CAR_CATE_NAME_EN])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
