<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "dlt_officebranch".
 *
 * @property string $CUST_CODE
 * @property string $BR_CODE
 * @property string $OFFICE_DESC
 * @property string $OFF_REG_ABREV
 * @property string $STATUS
 * @property integer $ID
 */
class DltOfficebranch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dlt_officebranch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CUST_CODE', 'BR_CODE', 'OFFICE_DESC'], 'required'],
            [['CUST_CODE'], 'string', 'max' => 3],
            [['BR_CODE'], 'string', 'max' => 2],
            [['OFFICE_DESC'], 'string', 'max' => 200],
            [['OFF_REG_ABREV'], 'string', 'max' => 10],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CUST_CODE' => 'Cust  Code',
            'BR_CODE' => 'Br  Code',
            'OFFICE_DESC' => 'Office  Desc',
            'OFF_REG_ABREV' => 'Off  Reg  Abrev',
            'STATUS' => 'Status',
            'ID' => 'ID',
        ];
    }
}
