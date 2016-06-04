<?php

namespace backend\modules\car\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\car\models\PermitOwner;

/**
 * PermitOwnerSearch represents the model behind the search form about `backend\modules\car\models\PermitOwner`.
 */
class PermitOwnerSearch extends PermitOwner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'OWNER_TITLE', 'PASPOTTYP', 'TUMBON_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'ICC', 'CREATE_BY', 'UPDATE_BY', 'REQ_ID'], 'integer'],
            [['OWNER_FNME', 'OWNER_MNME', 'OWNER_LNME', 'OWNER_AGE', 'PSLNUM', 'PASPOTNUM', 'PASPOT_ISSUE', 'PASPOT_EXP', 'EMAIL', 'TELEPHONE', 'ADDR', 'POSCDE', 'ATTRACT_FILE', 'CREATE_AT', 'UPDATE_AT', 'REQ_REF'], 'safe'],
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
        $query = PermitOwner::find();

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
            'OWNER_TITLE' => $this->OWNER_TITLE,
            'PASPOTTYP' => $this->PASPOTTYP,
            'PASPOT_ISSUE' => $this->PASPOT_ISSUE,
            'PASPOT_EXP' => $this->PASPOT_EXP,
            'TUMBON_ID' => $this->TUMBON_ID,
            'AMPHUR_ID' => $this->AMPHUR_ID,
            'PROVINCE_ID' => $this->PROVINCE_ID,
            'ICC' => $this->ICC,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_BY' => $this->UPDATE_BY,
            'REQ_ID' => $this->REQ_ID,
        ]);

        $query->andFilterWhere(['like', 'OWNER_FNME', $this->OWNER_FNME])
            ->andFilterWhere(['like', 'OWNER_MNME', $this->OWNER_MNME])
            ->andFilterWhere(['like', 'OWNER_LNME', $this->OWNER_LNME])
            ->andFilterWhere(['like', 'OWNER_AGE', $this->OWNER_AGE])
            ->andFilterWhere(['like', 'PSLNUM', $this->PSLNUM])
            ->andFilterWhere(['like', 'PASPOTNUM', $this->PASPOTNUM])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'TELEPHONE', $this->TELEPHONE])
            ->andFilterWhere(['like', 'ADDR', $this->ADDR])
            ->andFilterWhere(['like', 'POSCDE', $this->POSCDE])
            ->andFilterWhere(['like', 'ATTRACT_FILE', $this->ATTRACT_FILE])
            ->andFilterWhere(['like', 'REQ_REF', $this->REQ_REF]);

        return $dataProvider;
    }
}
