<?php

namespace backend\modules\car\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\car\models\PermitRegister;

/**
 * PermitRegisterSearch represents the model behind the search form about `backend\modules\car\models\PermitRegister`.
 */
class PermitRegisterSearch extends PermitRegister
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'OPERATE_TYPE', 'CAR_ID', 'REGISTRAR_TITLE', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['REF_REQ', 'REF_SUCCESS', 'LICENSE_NO', 'REGISTER_DATE', 'EXPIRE_DATE', 'ROUTE_DETAIL', 'DLT_OFFICE', 'DLT_BRANCH', 'REGISTRAR', 'PC_NO', 'RPC_NO', 'RPC_SERIAL_NO', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
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
        $query = PermitRegister::find();

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
            'CAR_ID' => $this->CAR_ID,
            'REGISTER_DATE' => $this->REGISTER_DATE,
            'EXPIRE_DATE' => $this->EXPIRE_DATE,
            'REGISTRAR_TITLE' => $this->REGISTRAR_TITLE,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_BY' => $this->UPDATE_BY,
        ]);

        $query->andFilterWhere(['like', 'REF_REQ', $this->REF_REQ])
            ->andFilterWhere(['like', 'REF_SUCCESS', $this->REF_SUCCESS])
            ->andFilterWhere(['like', 'LICENSE_NO', $this->LICENSE_NO])
            ->andFilterWhere(['like', 'ROUTE_DETAIL', $this->ROUTE_DETAIL])
            ->andFilterWhere(['like', 'DLT_OFFICE', $this->DLT_OFFICE])
            ->andFilterWhere(['like', 'DLT_BRANCH', $this->DLT_BRANCH])
            ->andFilterWhere(['like', 'REGISTRAR', $this->REGISTRAR])
            ->andFilterWhere(['like', 'PC_NO', $this->PC_NO])
            ->andFilterWhere(['like', 'RPC_NO', $this->RPC_NO])
            ->andFilterWhere(['like', 'RPC_SERIAL_NO', $this->RPC_SERIAL_NO]);

        return $dataProvider;
    }
}
