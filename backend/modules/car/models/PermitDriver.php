<?php

namespace backend\modules\car\models;

use Yii;

/**
 * This is the model class for table "permit_driver".
 *
 * @property integer $ID
 * @property integer $CAR_ID
 * @property string $REF_NUMBER
 * @property integer $DRIVER_TITLE
 * @property string $DRIVER_FNME
 * @property string $DRIVER_MNME
 * @property string $DRIVER_LNME
 * @property string $PSLNUM
 * @property integer $PASPOTTYP
 * @property string $PASPOTNUM
 * @property string $PASPOT_ISSUE
 * @property string $PASPOT_EXP
 * @property integer $DRIVER_LICENSE_TYPE
 * @property string $DRIVER_LICENSE_NO
 * @property string $LICENSE_ISSUE
 * @property string $LICENSE_EXP
 * @property string $LICENSE_DLT_OfFICE
 * @property string $LICENSE_BR_CODE
 * @property string $ADDR
 * @property integer $TUMBON_ID
 * @property integer $AMPHUR_ID
 * @property integer $PROVINCE_ID
 * @property string $POSCDE
 * @property integer $ICC
 * @property integer $DLT_APR_ID
 * @property string $DLT_APR_DTE
 * @property string $DLT_APR_STS
 * @property string $DLT_APR_DSC
 * @property string $ATTACHFILE_PASSPORT
 * @property string $ATTACHFILE_DRIVERLC
 *
 * @property PermitCar $cAR
 */
class PermitDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permit_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CAR_ID', 'REF_NUMBER', 'DRIVER_TITLE', 'DRIVER_FNME', 'DRIVER_MNME', 'DRIVER_LNME', 'PSLNUM', 'PASPOTNUM', 'DRIVER_LICENSE_NO', 'LICENSE_ISSUE', 'LICENSE_EXP', 'ATTACHFILE_PASSPORT', 'ATTACHFILE_DRIVERLC'], 'required'],
            [['CAR_ID', 'DRIVER_TITLE', 'PASPOTTYP', 'DRIVER_LICENSE_TYPE', 'TUMBON_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'ICC', 'DLT_APR_ID'], 'integer'],
            [['PASPOT_ISSUE', 'PASPOT_EXP', 'LICENSE_ISSUE', 'LICENSE_EXP', 'DLT_APR_DTE'], 'safe'],
            [['REF_NUMBER', 'DRIVER_LICENSE_NO'], 'string', 'max' => 8],
            [['DRIVER_FNME', 'DRIVER_LNME', 'DLT_APR_DSC'], 'string', 'max' => 100],
            [['DRIVER_MNME'], 'string', 'max' => 50],
            [['PSLNUM', 'PASPOTNUM'], 'string', 'max' => 20],
            [['LICENSE_DLT_OfFICE', 'LICENSE_BR_CODE'], 'string', 'max' => 3],
            [['ADDR'], 'string', 'max' => 255],
            [['POSCDE'], 'string', 'max' => 6],
            [['DLT_APR_STS'], 'string', 'max' => 1],
            [['ATTACHFILE_PASSPORT', 'ATTACHFILE_DRIVERLC'], 'string', 'max' => 45],
            [['CAR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PermitCar::className(), 'targetAttribute' => ['CAR_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CAR_ID' => 'Car  ID',
            'REF_NUMBER' => 'Ref  Number',
            'DRIVER_TITLE' => 'Driver  Title',
            'DRIVER_FNME' => 'Driver  Fnme',
            'DRIVER_MNME' => 'Driver  Mnme',
            'DRIVER_LNME' => 'Driver  Lnme',
            'PSLNUM' => 'Pslnum',
            'PASPOTTYP' => 'Paspottyp',
            'PASPOTNUM' => 'Paspotnum',
            'PASPOT_ISSUE' => 'Paspot  Issue',
            'PASPOT_EXP' => 'Paspot  Exp',
            'DRIVER_LICENSE_TYPE' => 'Driver  License  Type',
            'DRIVER_LICENSE_NO' => 'Driver  License  No',
            'LICENSE_ISSUE' => 'License  Issue',
            'LICENSE_EXP' => 'License  Exp',
            'LICENSE_DLT_OfFICE' => 'License  Dlt  Of Fice',
            'LICENSE_BR_CODE' => 'License  Br  Code',
            'ADDR' => 'Addr',
            'TUMBON_ID' => 'Tumbon  ID',
            'AMPHUR_ID' => 'Amphur  ID',
            'PROVINCE_ID' => 'Province  ID',
            'POSCDE' => 'Poscde',
            'ICC' => 'Icc',
            'DLT_APR_ID' => 'Dlt  Apr  ID',
            'DLT_APR_DTE' => 'Dlt  Apr  Dte',
            'DLT_APR_STS' => 'Dlt  Apr  Sts',
            'DLT_APR_DSC' => 'Dlt  Apr  Dsc',
            'ATTACHFILE_PASSPORT' => 'Attachfile  Passport',
            'ATTACHFILE_DRIVERLC' => 'Attachfile  Driverlc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCAR()
    {
        return $this->hasOne(PermitCar::className(), ['ID' => 'CAR_ID']);
    }
}
