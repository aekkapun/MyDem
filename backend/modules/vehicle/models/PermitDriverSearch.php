<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vehicle\models\PermitDriver;

/**
 * PermitDriverSearch represents the model behind the search form about `backend\modules\vehicle\models\PermitDriver`.
 */
class PermitDriverSearch extends PermitDriver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CAR_ID', 'DRIVER_TITLE', 'PASPOTTYP', 'DRIVER_LICENSE_TYPE', 'TUMBON_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'ICC', 'DLT_APR_ID'], 'integer'],
            [['REF_NUMBER', 'DRIVER_FNME', 'DRIVER_MNME', 'DRIVER_LNME', 'PSLNUM', 'PASPOTNUM', 'PASPOT_ISSUE', 'PASPOT_EXP', 'DRIVER_LICENSE_NO', 'LICENSE_ISSUE', 'LICENSE_EXP', 'LICENSE_DLT_OfFICE', 'LICENSE_BR_CODE', 'ADDR', 'POSCDE', 'DLT_APR_DTE', 'DLT_APR_STS', 'DLT_APR_DSC', 'ATTACHFILE_PASSPORT', 'ATTACHFILE_DRIVERLC'], 'safe'],
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
        $query = PermitDriver::find();

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
            'CAR_ID' => $this->CAR_ID,
            'DRIVER_TITLE' => $this->DRIVER_TITLE,
            'PASPOTTYP' => $this->PASPOTTYP,
            'PASPOT_ISSUE' => $this->PASPOT_ISSUE,
            'PASPOT_EXP' => $this->PASPOT_EXP,
            'DRIVER_LICENSE_TYPE' => $this->DRIVER_LICENSE_TYPE,
            'LICENSE_ISSUE' => $this->LICENSE_ISSUE,
            'LICENSE_EXP' => $this->LICENSE_EXP,
            'TUMBON_ID' => $this->TUMBON_ID,
            'AMPHUR_ID' => $this->AMPHUR_ID,
            'PROVINCE_ID' => $this->PROVINCE_ID,
            'ICC' => $this->ICC,
            'DLT_APR_ID' => $this->DLT_APR_ID,
            'DLT_APR_DTE' => $this->DLT_APR_DTE,
        ]);

        $query->andFilterWhere(['like', 'REF_NUMBER', $this->REF_NUMBER])
            ->andFilterWhere(['like', 'DRIVER_FNME', $this->DRIVER_FNME])
            ->andFilterWhere(['like', 'DRIVER_MNME', $this->DRIVER_MNME])
            ->andFilterWhere(['like', 'DRIVER_LNME', $this->DRIVER_LNME])
            ->andFilterWhere(['like', 'PSLNUM', $this->PSLNUM])
            ->andFilterWhere(['like', 'PASPOTNUM', $this->PASPOTNUM])
            ->andFilterWhere(['like', 'DRIVER_LICENSE_NO', $this->DRIVER_LICENSE_NO])
            ->andFilterWhere(['like', 'LICENSE_DLT_OfFICE', $this->LICENSE_DLT_OfFICE])
            ->andFilterWhere(['like', 'LICENSE_BR_CODE', $this->LICENSE_BR_CODE])
            ->andFilterWhere(['like', 'ADDR', $this->ADDR])
            ->andFilterWhere(['like', 'POSCDE', $this->POSCDE])
            ->andFilterWhere(['like', 'DLT_APR_STS', $this->DLT_APR_STS])
            ->andFilterWhere(['like', 'DLT_APR_DSC', $this->DLT_APR_DSC])
            ->andFilterWhere(['like', 'ATTACHFILE_PASSPORT', $this->ATTACHFILE_PASSPORT])
            ->andFilterWhere(['like', 'ATTACHFILE_DRIVERLC', $this->ATTACHFILE_DRIVERLC]);

        return $dataProvider;
    }
}
