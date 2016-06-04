<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "vehicle_type".
 *
 * @property integer $VHCTYP
 * @property string $TYPNME
 * @property string $TSPMDE
 */
class VehicleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TYPNME'], 'string', 'max' => 100],
            [['TSPMDE'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VHCTYP' => 'เลข index ไว้อ้างอิง',
            'TYPNME' => 'ชนิดของรถยนต์ เช่น BUS,WAN,JEEP',
            'TSPMDE' => 'บอกประเภทของยานยนต์ เช่น 1=รถยนต์,2=มอเตอร์ไซด์,3=เรือ',
        ];
    }
}
