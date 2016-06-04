<?php

namespace backend\modules\car\models;

use Yii;

/**
 * This is the model class for table "cust_border_point".
 *
 * @property integer $ID
 * @property integer $BORDER_POINT_CODE
 * @property string $BORDER_POINT_NAME
 * @property integer $PROVINCE_ID
 * @property string $PROVINCE_NAME
 * @property string $STATUS
 *
 * @property PermitRequest[] $permitRequests
 */
class CustBorderPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cust_border_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BORDER_POINT_CODE'], 'required'],
            [['BORDER_POINT_CODE', 'PROVINCE_ID'], 'integer'],
            [['BORDER_POINT_NAME'], 'string', 'max' => 300],
            [['PROVINCE_NAME'], 'string', 'max' => 100],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'BORDER_POINT_CODE' => 'Border  Point  Code',
            'BORDER_POINT_NAME' => 'Border  Point  Name',
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_NAME' => 'Province  Name',
            'STATUS' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitRequests()
    {
        return $this->hasMany(PermitRequest::className(), ['ROUTE_BODER_POINT' => 'ID']);
    }
}
