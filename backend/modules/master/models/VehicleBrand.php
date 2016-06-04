<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "vehicle_brand".
 *
 * @property integer $VHCBANCDE
 * @property string $VHCBANNME
 * @property string $STATUS
 */
class VehicleBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VHCBANCDE', 'VHCBANNME'], 'required'],
            [['VHCBANCDE'], 'integer'],
            [['VHCBANNME'], 'string', 'max' => 60],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VHCBANCDE' => 'เลข index ไว้อ้างอิง',
            'VHCBANNME' => 'ยี่ห้อรถ',
            'STATUS' => 'บอกว่ายังใช้งานได้ไหม E = ใช้งาน , D = ไม่ใช้งาน',
        ];
    }
}
