<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $COUNTRY_ID
 * @property integer $COUNTRY_CODE
 * @property string $COUNTRY_DESC
 * @property string $COUNTRY_DESC_EN
 * @property string $COUNTRY_INGENEVA
 * @property string $CUSTOMS_CODE
 * @property string $STATUS
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUNTRY_CODE', 'COUNTRY_DESC', 'COUNTRY_DESC_EN'], 'required'],
            [['COUNTRY_CODE'], 'integer'],
            [['COUNTRY_DESC'], 'string', 'max' => 300],
            [['COUNTRY_DESC_EN'], 'string', 'max' => 100],
            [['COUNTRY_INGENEVA'], 'string', 'max' => 5],
            [['CUSTOMS_CODE'], 'string', 'max' => 10],
            [['STATUS'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUNTRY_ID' => 'Country  ID',
            'COUNTRY_CODE' => 'Country  Code',
            'COUNTRY_DESC' => 'Country  Desc',
            'COUNTRY_DESC_EN' => 'Country  Desc  En',
            'COUNTRY_INGENEVA' => 'Country  Ingeneva',
            'CUSTOMS_CODE' => 'Customs  Code',
            'STATUS' => 'Status',
        ];
    }
}
