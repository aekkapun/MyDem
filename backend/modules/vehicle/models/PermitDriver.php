<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
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
 */
class PermitDriver extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_driver';
    }

    const UPLOAD_FOLDER = 'driver_doc';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['CAR_ID', 'DRIVER_TITLE', 'DRIVER_FNME', 'DRIVER_LNME', 'PSLNUM', 'PASPOTNUM', 'DRIVER_LICENSE_NO', 'LICENSE_ISSUE', 'LICENSE_EXP'], 'required'],
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
            [['ATTACHFILE_PASSPORT', 'ATTACHFILE_DRIVERLC'], 'file', 'maxFiles' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'เลขอ้างอิงผู้ขับขี่',
            'CAR_ID' => 'เลขอ้างอิงรถที่ขออนุญาต',
            'REF_NUMBER' => 'เลขอ้างอิงใบอนุญาต',
            'DRIVER_TITLE' => 'คำนำหน้าชื่อผู้ขับขี่',
            'DRIVER_FNME' => 'ชื่อผู้ขับขี่',
            'DRIVER_MNME' => 'ชื่อกลางผู้ขับขี่',
            'DRIVER_LNME' => 'นามสกุลผู้ขับขี่',
            'PSLNUM' => 'เลขประจำตัวประชาชน',
            'PASPOTTYP' => 'ชนิด Passport',
            'PASPOTNUM' => 'เลขที่ Passport',
            'PASPOT_ISSUE' => 'วันที่ทำ Passport',
            'PASPOT_EXP' => 'วันหมดอายุ Passport',
            'DRIVER_LICENSE_TYPE' => 'ชนิดใบขับขี่',
            'DRIVER_LICENSE_NO' => 'เลขที่ใบขับขี่',
            'LICENSE_ISSUE' => 'วันที่ทำใบขับขี่',
            'LICENSE_EXP' => 'วันที่หมดอายุ',
            'LICENSE_DLT_OfFICE' => 'สำนักงานขนส่งที่ทำใบขับขี่',
            'LICENSE_BR_CODE' => 'สาขา สำนักงานขนส่งที่ทำใบขับขี่',
            'ADDR' => 'ที่อยู่',
            'TUMBON_ID' => 'จาก Table TUMBON',
            'AMPHUR_ID' => 'จาก Table AMHUR',
            'PROVINCE_ID' => 'จาก Table Province',
            'POSCDE' => 'รหัสไปรษณีย์',
            'ICC' => 'ประเทศที่ผู้ขับอยู่',
            'DLT_APR_ID' => 'รหัสผู้อนุมัติ (จนท.ขนส่ง)',
            'DLT_APR_DTE' => 'วันที่อนุมัติ',
            'DLT_APR_STS' => 'สถานะการอนุมัติ',
            'DLT_APR_DSC' => 'รายละเอียดการอนุมัติ (Ex. ไม่อนุมัติ เนื่องจาก..)',
            'ATTACHFILE_PASSPORT' => 'แนบ PASSPORT',
            'ATTACHFILE_DRIVERLC' => 'แนบเกสาร ใบขับขี่',
        ];
    }

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function initialPreview($data, $field, $type = 'file') {
        $initial = [
        ];
        //$files = Json::encode($data);
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                if ($type == 'file') {
                    $img = self::getUploadUrl() . $this->CAR_ID . '/' . $key;
                    $initial[] = '<img src="' . $img . '" width="200" />';
                    //$initial[] = Html::img(self::getUploadUrl() . $this->REQ_REF . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width' => '120px',
                        'url' => Url::to(['/vehicle/permit-driver/deletefile', 'id' => $this->ID, 'fileName' => $key, 'field' => $field]),
                        'key' => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . '/' . $this->REQ_REF . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                }
            }
        }
        return $initial;
    }

}
