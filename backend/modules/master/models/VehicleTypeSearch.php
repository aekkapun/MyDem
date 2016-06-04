<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\VehicleType;

/**
 * VehicleTypeSearch represents the model behind the search form about `backend\modules\master\models\VehicleType`.
 */
class VehicleTypeSearch extends VehicleType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VHCTYP'], 'integer'],
            [['TYPNME', 'TSPMDE'], 'safe'],
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
        $query = VehicleType::find();

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
            'VHCTYP' => $this->VHCTYP,
        ]);

        $query->andFilterWhere(['like', 'TYPNME', $this->TYPNME])
            ->andFilterWhere(['like', 'TSPMDE', $this->TSPMDE]);

        return $dataProvider;
    }
}
