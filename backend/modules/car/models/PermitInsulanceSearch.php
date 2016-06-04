<?php

namespace backend\modules\car\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\car\models\PermitInsulance;

/**
 * PermitInsulanceSearch represents the model behind the search form about `backend\modules\car\models\PermitInsulance`.
 */
class PermitInsulanceSearch extends PermitInsulance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CREATE_BY', 'UPDATE_BY', 'CAR_ID'], 'integer'],
            [['INSURANCE_CMPNME', 'INSURANCE_NO', 'INSURANCE_EXP', 'INSURANCE_FILE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
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
        $query = PermitInsulance::find();

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
            'ID' => $this->ID,
            'INSURANCE_EXP' => $this->INSURANCE_EXP,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_BY' => $this->UPDATE_BY,
            'CAR_ID' => $this->CAR_ID,
        ]);

        $query->andFilterWhere(['like', 'INSURANCE_CMPNME', $this->INSURANCE_CMPNME])
            ->andFilterWhere(['like', 'INSURANCE_NO', $this->INSURANCE_NO])
            ->andFilterWhere(['like', 'INSURANCE_FILE', $this->INSURANCE_FILE]);

        return $dataProvider;
    }
}
