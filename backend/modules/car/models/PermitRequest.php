<?php

namespace backend\modules\car\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "permit_request".
 *
 * @property integer $ID
 * @property integer $OPERATE_TYPE
 * @property string $REQ_REF
 * @property integer $ROUTE_PROVINCE
 * @property integer $ROUTE_BODER_POINT
 * @property string $ROUTE_DETAIL
 * @property string $DLT_OFFICE
 * @property string $DLT_BRANCH
 * @property string $STATUS
 * @property string $CREATE_DTE
 * @property integer $CREATE_BY
 * @property string $UPDATE_DTE
 * @property integer $UPDATE_BY
 *
 * @property PermitRegister[] $permitRegisters
 * @property CustBorderPoint $rOUTEBODERPOINT
 * @property Province $rOUTEPROVINCE
 */
class PermitRequest extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_request';
    }

    const UPLOAD_FOLDER = 'documents';

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CREATE_DTE',
                'updatedAtAttribute' => 'UPDATE_DTE',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'CREATE_BY',
                'updatedByAttribute' => 'UPDATE_BY'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['OPERATE_TYPE', 'COUNTRY','OWNER_ID','CAR_ID', 'ROUTE_PROVINCE', 'ROUTE_BODER_POINT', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['ROUTE_PROVINCE', 'COUNTRY', 'ROUTE_BODER_POINT', 'ROUTE_DETAIL'], 'required'],
            [['CREATE_DTE', 'UPDATE_DTE'], 'safe'],
            //[['REQ_REF'], 'string', 'max' => 10],
            [['ROUTE_DETAIL'], 'string', 'max' => 200],
            [['DLT_OFFICE', 'DLT_BRANCH'], 'string', 'max' => 5],
            [['STATUS','AMPHUR_ID','DISTRICT_ID'], 'string', 'max' => 3],
            //[['ROUTE_BODER_POINT'], 'exist', 'skipOnError' => true, 'targetClass' => CustBorderPoint::className(), 'targetAttribute' => ['ROUTE_BODER_POINT' => 'ID']],
            //[['ROUTE_PROVINCE'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['ROUTE_PROVINCE' => 'PROVINCE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'OPERATE_TYPE' => 'Operate  Type',
            'REQ_REF' => 'Req  Ref',
            'COUNTRY' => 'ประเทศที่ติดต่อ',
            'ROUTE_PROVINCE' => 'Route  Province',
            'ROUTE_BODER_POINT' => 'Route  Boder  Point',
            'ROUTE_DETAIL' => 'Route  Detail',
            'AMPHUR_ID'=>'อำเภอ',
            'DISTRICT_ID'=>'ตำบล',
            'DLT_OFFICE' => 'Dlt  Office',
            'DLT_BRANCH' => 'Dlt  Branch',
            'OWNER_ID'=>'ID OWNER',
            'CAR_ID'=>'FK_PERMIT',
            'STATUS' => 'Status',
            'CREATE_DTE' => 'Create  Dte',
            'CREATE_BY' => 'Create  By',
            'UPDATE_DTE' => 'Update  Dte',
            'UPDATE_BY' => 'Update  By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitRegisters() {
        return $this->hasMany(PermitRegister::className(), ['REF_REQ' => 'REQ_REF']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getROUTEBODERPOINT() {
        return $this->hasOne(CustBorderPoint::className(), ['ID' => 'ROUTE_BODER_POINT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getROUTEPROVINCE() {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'ROUTE_PROVINCE']);
    }

    

}
