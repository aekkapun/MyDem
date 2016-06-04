<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "vehicle_model".
 *
 * @property integer $VHCBANCDE
 * @property integer $VHCTYP
 * @property integer $VHCMDLCDE
 * @property string $MDLNME
 * @property string $STATUS
 */
class VehicleModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VHCBANCDE'], 'required'],
            [['VHCBANCDE', 'VHCTYP', 'VHCMDLCDE'], 'integer'],
            [['MDLNME'], 'string', 'max' => 50],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VHCBANCDE' => 'Vhcbancde',
            'VHCTYP' => 'Vhctyp',
            'VHCMDLCDE' => 'Vhcmdlcde',
            'MDLNME' => 'Mdlnme',
            'STATUS' => 'Status',
        ];
    }
}
