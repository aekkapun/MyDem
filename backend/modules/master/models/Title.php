<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "title".
 *
 * @property integer $TITLE_ID
 * @property string $TITLE_TH
 * @property string $TITLE_EN
 * @property string $STATUS
 */
class Title extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TITLE_ID', 'TITLE_TH'], 'required'],
            [['TITLE_ID'], 'integer'],
            [['TITLE_TH'], 'string', 'max' => 30],
            [['TITLE_EN'], 'string', 'max' => 10],
            [['STATUS'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TITLE_ID' => 'Title  ID',
            'TITLE_TH' => 'Title  Th',
            'TITLE_EN' => 'Title  En',
            'STATUS' => 'Status',
        ];
    }
    
    public function getFulltitle(){
        return $this->TITLE_TH .'-'. $this->TITLE_EN;
    }
}
