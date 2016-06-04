<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "car_apperance".
 *
 * @property integer $ID
 * @property string $CAR_APPEAR_ID
 * @property string $CAR_APPEAR
 * @property string $CAR_APPEAR_EN
 * @property integer $STATUS
 * @property integer $TYP
 */
class CarApperance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_apperance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CAR_APPEAR_ID'], 'required'],
            [['STATUS', 'TYP'], 'integer'],
            [['CAR_APPEAR_ID'], 'string', 'max' => 2],
            [['CAR_APPEAR'], 'string', 'max' => 50],
            [['CAR_APPEAR_EN'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CAR_APPEAR_ID' => 'Car  Appear  ID',
            'CAR_APPEAR' => 'Car  Appear',
            'CAR_APPEAR_EN' => 'Car  Appear  En',
            'STATUS' => 'Status',
            'TYP' => 'Typ',
        ];
    }
}
