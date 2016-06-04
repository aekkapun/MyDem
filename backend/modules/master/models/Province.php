<?php

namespace backend\modules\master\models;


use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $PROVINCE_ID
 * @property string $PROVINCE_CODE
 * @property string $PROVINCE_DLT_CODE
 * @property string $PROVINCE_NAME
 * @property string $PROVINCE_SHORT_NAME
 * @property string $COUNTRY_ID
 * @property string $STATUS
 * @property string $BORDER_FLAG
 *
 * @property PermitRequest[] $permitRequests
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVINCE_CODE', 'PROVINCE_NAME'], 'required'],
            [['PROVINCE_CODE', 'PROVINCE_DLT_CODE'], 'string', 'max' => 5],
            [['PROVINCE_NAME'], 'string', 'max' => 200],
            [['PROVINCE_SHORT_NAME'], 'string', 'max' => 20],
            [['COUNTRY_ID'], 'string', 'max' => 10],
            [['STATUS', 'BORDER_FLAG'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_CODE' => 'Province  Code',
            'PROVINCE_DLT_CODE' => 'Province  Dlt  Code',
            'PROVINCE_NAME' => 'Province  Name',
            'PROVINCE_SHORT_NAME' => 'Province  Short  Name',
            'COUNTRY_ID' => 'Country  ID',
            'STATUS' => 'Status',
            'BORDER_FLAG' => 'Border  Flag',
            'BORDER_COUNTRY'=>'รหัสประเทศที่ติดชายแดน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitRequests()
    {
        return $this->hasMany(PermitRequest::className(), ['ROUTE_PROVINCE' => 'PROVINCE_ID']);
    }
}
