<?php

namespace backend\modules\car\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\car\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form about `backend\modules\car\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'VHCCTY', 'VHCBANCDE', 'CARCATE', 'VHCTYP', 'CARAPPR', 'TOTPSG', 'OWNER_ID', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['TSPMDE', 'VHCLCN1', 'VHCLCN2', 'VHCPRV', 'VHCVERNUM', 'VHCMDLCDE', 'CORCDE', 'VHCYER', 'CHSNUM', 'ENENUM', 'CC', 'HP', 'KW', 'ENG_TYP', 'FUEL_TYP', 'GPS', 'VHCVAL', 'WGT', 'TOTAL_WGT', 'REGIS_STATUS', 'REF_SUCCESS', 'REQ_REF', 'ATTACH_FILE', 'IMAGE_REF', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
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
        $query = Vehicle::find();

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
            'VHCCTY' => $this->VHCCTY,
            'VHCBANCDE' => $this->VHCBANCDE,
            'CARCATE' => $this->CARCATE,
            'VHCTYP' => $this->VHCTYP,
            'CARAPPR' => $this->CARAPPR,
            'TOTPSG' => $this->TOTPSG,
            'OWNER_ID' => $this->OWNER_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_BY' => $this->UPDATE_BY,
        ]);

        $query->andFilterWhere(['like', 'TSPMDE', $this->TSPMDE])
            ->andFilterWhere(['like', 'VHCLCN1', $this->VHCLCN1])
            ->andFilterWhere(['like', 'VHCLCN2', $this->VHCLCN2])
            ->andFilterWhere(['like', 'VHCPRV', $this->VHCPRV])
            ->andFilterWhere(['like', 'VHCVERNUM', $this->VHCVERNUM])
            ->andFilterWhere(['like', 'VHCMDLCDE', $this->VHCMDLCDE])
            ->andFilterWhere(['like', 'CORCDE', $this->CORCDE])
            ->andFilterWhere(['like', 'VHCYER', $this->VHCYER])
            ->andFilterWhere(['like', 'CHSNUM', $this->CHSNUM])
            ->andFilterWhere(['like', 'ENENUM', $this->ENENUM])
            ->andFilterWhere(['like', 'CC', $this->CC])
            ->andFilterWhere(['like', 'HP', $this->HP])
            ->andFilterWhere(['like', 'KW', $this->KW])
            ->andFilterWhere(['like', 'ENG_TYP', $this->ENG_TYP])
            ->andFilterWhere(['like', 'FUEL_TYP', $this->FUEL_TYP])
            ->andFilterWhere(['like', 'GPS', $this->GPS])
            ->andFilterWhere(['like', 'VHCVAL', $this->VHCVAL])
            ->andFilterWhere(['like', 'WGT', $this->WGT])
            ->andFilterWhere(['like', 'TOTAL_WGT', $this->TOTAL_WGT])
            ->andFilterWhere(['like', 'REGIS_STATUS', $this->REGIS_STATUS])
            ->andFilterWhere(['like', 'REF_SUCCESS', $this->REF_SUCCESS])
            ->andFilterWhere(['like', 'REQ_REF', $this->REQ_REF])
            ->andFilterWhere(['like', 'ATTACH_FILE', $this->ATTACH_FILE])
            ->andFilterWhere(['like', 'IMAGE_REF', $this->IMAGE_REF]);

        return $dataProvider;
    }
}
