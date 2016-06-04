<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\Country;

/**
 * CountrySearch represents the model behind the search form about `backend\modules\master\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUNTRY_ID', 'COUNTRY_CODE'], 'integer'],
            [['COUNTRY_DESC', 'COUNTRY_DESC_EN', 'COUNTRY_INGENEVA', 'CUSTOMS_CODE', 'COUNTRY_ ABB', 'STATUS'], 'safe'],
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
        $query = Country::find();

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
            'COUNTRY_ID' => $this->COUNTRY_ID,
            'COUNTRY_CODE' => $this->COUNTRY_CODE,
        ]);

        $query->andFilterWhere(['like', 'COUNTRY_DESC', $this->COUNTRY_DESC])
            ->andFilterWhere(['like', 'COUNTRY_DESC_EN', $this->COUNTRY_DESC_EN])
            ->andFilterWhere(['like', 'COUNTRY_INGENEVA', $this->COUNTRY_INGENEVA])
            ->andFilterWhere(['like', 'CUSTOMS_CODE', $this->CUSTOMS_CODE])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
