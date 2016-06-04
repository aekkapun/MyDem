<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "passport_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_en
 * @property integer $status
 */
class PassportType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passport_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name', 'name_en'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'name_en' => 'Name En',
            'status' => 'Status',
        ];
    }
}
