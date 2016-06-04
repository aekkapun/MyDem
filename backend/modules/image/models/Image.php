<?php

namespace backend\modules\image\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property string $sort_order
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
            [['path', 'type', 'name', 'sort_order'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'sort_order' => 'Sort Order',
        ];
    }
}
