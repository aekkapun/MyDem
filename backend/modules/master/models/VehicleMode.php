<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "vehicle_mode".
 *
 * @property integer $id
 * @property string $TSPMDE
 * @property string $TSPMDE_EN
 * @property string $STATUS
 */
class VehicleMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TSPMDE'], 'required'],
            [['TSPMDE', 'TSPMDE_EN', 'STATUS'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TSPMDE' => 'Tspmde',
            'TSPMDE_EN' => 'Tspmde  En',
            'STATUS' => 'Status',
        ];
    }
}
