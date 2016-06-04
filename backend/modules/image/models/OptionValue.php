<?php

namespace backend\modules\image\models;

use Yii;

/**
 * This is the model class for table "option_value".
 *
 * @property integer $id
 * @property string $catalog_option
 * @property string $name
 * @property integer $sort_order
 * @property integer $image_id
 */
class OptionValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort_order', 'image_id'], 'integer'],
            [['catalog_option', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalog_option' => 'Catalog Option',
            'name' => 'Name',
            'sort_order' => 'Sort Order',
            'image_id' => 'Image ID',
        ];
    }
}
