<?php

namespace backend\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\Title;

/**
 * TitleSearch represents the model behind the search form about `backend\modules\master\models\Title`.
 */
class TitleSearch extends Title
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TITLE_ID'], 'integer'],
            [['TITLE_TH', 'TITLE_EN', 'STATUS'], 'safe'],
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
        $query = Title::find();

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
            'TITLE_ID' => $this->TITLE_ID,
        ]);

        $query->andFilterWhere(['like', 'TITLE_TH', $this->TITLE_TH])
            ->andFilterWhere(['like', 'TITLE_EN', $this->TITLE_EN])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
