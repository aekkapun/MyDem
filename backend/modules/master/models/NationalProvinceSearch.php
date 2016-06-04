<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\NationalProvince;

/**
 * NationalProvinceSearch represents the model behind the search form about `backend\modules\master\models\NationalProvince`.
 */
class NationalProvinceSearch extends NationalProvince
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_code'], 'integer'],
            [['prv_name_th', 'prv_name_en', 'prv_name_en_abb'], 'safe'],
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
        $query = NationalProvince::find();

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
            'id' => $this->id,
            'country_code' => $this->country_code,
        ]);

        $query->andFilterWhere(['like', 'prv_name_th', $this->prv_name_th])
            ->andFilterWhere(['like', 'prv_name_en', $this->prv_name_en])
            ->andFilterWhere(['like', 'prv_name_en_abb', $this->prv_name_en_abb]);

        return $dataProvider;
    }
}
