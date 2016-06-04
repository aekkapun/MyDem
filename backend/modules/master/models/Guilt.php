<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "guilt".
 *
 * @property integer $ID
 * @property string $GUILT_DSC
 *
 * @property OffenderHasGuilt[] $offenderHasGuilts
 */
class Guilt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guilt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GUILT_DSC'], 'required'],
            [['ID'], 'integer'],
            [['GUILT_DSC'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'GUILT_DSC' => 'Guilt  Dsc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffenderHasGuilts()
    {
        return $this->hasMany(OffenderHasGuilt::className(), ['GUILT_ID' => 'ID']);
    }
}
