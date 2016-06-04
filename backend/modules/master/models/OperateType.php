<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "operate_type".
 *
 * @property integer $ID
 * @property string $OPERATE_TYPE
 * @property integer $FLAG
 */
class OperateType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operate_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPERATE_TYPE'], 'required'],
            [['FLAG'], 'integer'],
            [['OPERATE_TYPE'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'INDEX',
            'OPERATE_TYPE' => 'การดำเนินการ',
            'FLAG' => 'Flag',
        ];
    }
}
