<?php

namespace backend\modules\car\models;

use Yii;

/**
 * This is the model class for table "permit_register".
 *
 * @property integer $ID
 * @property integer $OPERATE_TYPE
 * @property integer $CAR_ID
 * @property string $REF_REQ
 * @property string $REF_SUCCESS
 * @property string $LICENSE_NO
 * @property string $REGISTER_DATE
 * @property string $EXPIRE_DATE
 * @property string $ROUTE_DETAIL
 * @property string $DLT_OFFICE
 * @property string $DLT_BRANCH
 * @property integer $REGISTRAR_TITLE
 * @property string $REGISTRAR
 * @property string $PC_NO
 * @property string $RPC_NO
 * @property string $RPC_SERIAL_NO
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property integer $CREATE_BY
 * @property integer $UPDATE_BY
 *
 * @property PermitCar $cAR
 * @property PermitRequest $rEFREQ
 */
class PermitRegister extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permit_register';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPERATE_TYPE', 'CAR_ID', 'REGISTRAR_TITLE', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['REF_REQ', 'REGISTER_DATE', 'EXPIRE_DATE', 'ROUTE_DETAIL', 'REGISTRAR_TITLE', 'REGISTRAR', 'RPC_NO', 'RPC_SERIAL_NO'], 'required'],
            [['REGISTER_DATE', 'EXPIRE_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['REF_REQ', 'REF_SUCCESS'], 'string', 'max' => 10],
            [['LICENSE_NO'], 'string', 'max' => 60],
            [['ROUTE_DETAIL', 'REGISTRAR'], 'string', 'max' => 200],
            [['DLT_OFFICE', 'DLT_BRANCH'], 'string', 'max' => 5],
            [['PC_NO', 'RPC_NO', 'RPC_SERIAL_NO'], 'string', 'max' => 11],
            [['CAR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PermitCar::className(), 'targetAttribute' => ['CAR_ID' => 'ID']],
            [['REF_REQ'], 'exist', 'skipOnError' => true, 'targetClass' => PermitRequest::className(), 'targetAttribute' => ['REF_REQ' => 'REQ_REF']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'OPERATE_TYPE' => 'Operate  Type',
            'CAR_ID' => 'Car  ID',
            'REF_REQ' => 'Ref  Req',
            'REF_SUCCESS' => 'Ref  Success',
            'LICENSE_NO' => 'License  No',
            'REGISTER_DATE' => 'Register  Date',
            'EXPIRE_DATE' => 'Expire  Date',
            'ROUTE_DETAIL' => 'Route  Detail',
            'DLT_OFFICE' => 'Dlt  Office',
            'DLT_BRANCH' => 'Dlt  Branch',
            'REGISTRAR_TITLE' => 'Registrar  Title',
            'REGISTRAR' => 'Registrar',
            'PC_NO' => 'Pc  No',
            'RPC_NO' => 'Rpc  No',
            'RPC_SERIAL_NO' => 'Rpc  Serial  No',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCAR()
    {
        return $this->hasOne(PermitCar::className(), ['ID' => 'CAR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFREQ()
    {
        return $this->hasOne(PermitRequest::className(), ['REQ_REF' => 'REF_REQ']);
    }
}
