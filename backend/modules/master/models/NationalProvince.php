<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "national_province".
 *
 * @property integer $id
 * @property string $prv_name_th
 * @property string $prv_name_en
 * @property string $prv_name_en_abb
 * @property integer $country_code
 */
class NationalProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'national_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prv_name_th', 'prv_name_en'], 'required'],
            [['country_code'], 'integer'],
            [['prv_name_th', 'prv_name_en'], 'string', 'max' => 100],
            [['prv_name_en_abb'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prv_name_th' => 'Prv Name Th',
            'prv_name_en' => 'Prv Name En',
            'prv_name_en_abb' => 'Prv Name En Abb',
            'country_code' => 'Country Code',
        ];
    }
    
    public function getFullprv(){
        return $this->prv_name_en .' '. $this->prv_name_th;
    }
}
