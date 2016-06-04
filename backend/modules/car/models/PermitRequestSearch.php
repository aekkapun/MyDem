<?php

namespace backend\modules\car\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\car\models\PermitRequest;

/**
 * PermitRequestSearch represents the model behind the search form about `backend\modules\car\models\PermitRequest`.
 */
class PermitRequestSearch extends PermitRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'OPERATE_TYPE', 'ROUTE_PROVINCE', 'ROUTE_BODER_POINT', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['REQ_REF', 'ROUTE_DETAIL', 'DLT_OFFICE', 'DLT_BRANCH', 'STATUS', 'CREATE_DTE', 'UPDATE_DTE'], 'safe'],
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
        $query = PermitRequest::find();

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
            'OPERATE_TYPE' => $this->OPERATE_TYPE,
            'ROUTE_PROVINCE' => $this->ROUTE_PROVINCE,
            'ROUTE_BODER_POINT' => $this->ROUTE_BODER_POINT,
            'CREATE_DTE' => $this->CREATE_DTE,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_DTE' => $this->UPDATE_DTE,
            'UPDATE_BY' => $this->UPDATE_BY,
        ]);

        $query->andFilterWhere(['like', 'REQ_REF', $this->REQ_REF])
            ->andFilterWhere(['like', 'ROUTE_DETAIL', $this->ROUTE_DETAIL])
            ->andFilterWhere(['like', 'DLT_OFFICE', $this->DLT_OFFICE])
            ->andFilterWhere(['like', 'DLT_BRANCH', $this->DLT_BRANCH])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
