<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "car_color".
 *
 * @property integer $id
 * @property string $color
 * @property string $color_code
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color', 'color_code'], 'required'],
            [['color'], 'string', 'max' => 45],
            [['color_code'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'color_code' => 'Color Code',
        ];
    }
}
