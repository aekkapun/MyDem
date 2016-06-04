<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\CustBorderPoint;

/**
 * CustBorderPointSearch represents the model behind the search form about `backend\modules\master\models\CustBorderPoint`.
 */
class CustBorderPointSearch extends CustBorderPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'BORDER_POINT_CODE', 'PROVINCE_ID'], 'integer'],
            [['BORDER_POINT_NAME', 'PROVINCE_NAME', 'STATUS'], 'safe'],
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
        $query = CustBorderPoint::find();

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
            'BORDER_POINT_CODE' => $this->BORDER_POINT_CODE,
            'PROVINCE_ID' => $this->PROVINCE_ID,
        ]);

        $query->andFilterWhere(['like', 'BORDER_POINT_NAME', $this->BORDER_POINT_NAME])
            ->andFilterWhere(['like', 'PROVINCE_NAME', $this->PROVINCE_NAME])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
