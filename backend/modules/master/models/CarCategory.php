<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "car_category".
 *
 * @property integer $CAR_CATE_ID
 * @property string $CAR_CATE_NAME
 * @property string $CAR_CATE_NAME_EN
 * @property string $STATUS
 */
class CarCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CAR_CATE_NAME'], 'string', 'max' => 150],
            [['CAR_CATE_NAME_EN'], 'string', 'max' => 50],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CAR_CATE_ID' => 'Car  Cate  ID',
            'CAR_CATE_NAME' => 'Car  Cate  Name',
            'CAR_CATE_NAME_EN' => 'Car  Cate  Name  En',
            'STATUS' => 'Status',
        ];
    }
}
