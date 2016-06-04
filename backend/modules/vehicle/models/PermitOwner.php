<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\helpers\Html;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "permit_owner".
 *
 * @property integer $ID
 * @property integer $OWNER_TITLE
 * @property string $OWNER_FNME
 * @property string $OWNER_MNME
 * @property string $OWNER_LNME
 * @property string $OWNER_AGE
 * @property string $PSLNUM
 * @property integer $PASPOTTYP
 * @property string $PASPOTNUM
 * @property string $PASPOT_ISSUE
 * @property string $PASPOT_EXP
 * @property string $EMAIL
 * @property string $TELEPHONE
 * @property string $ADDR
 * @property integer $TUMBON_ID
 * @property integer $AMPHUR_ID
 * @property integer $PROVINCE_ID
 * @property string $POSCDE
 * @property integer $ICC
 * @property string $ATTRACT_FILE
 * @property integer $CAR_ID
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property integer $CREATE_BY
 * @property integer $UPDATE_BY
 * @property string $REQ_REF
 * @property integer $REQ_ID
 */
class PermitOwner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_owner';
    }

    const UPLOAD_FOLDER = 'owner';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['OWNER_TITLE', 'OWNER_FNME', 'OWNER_LNME', 'OWNER_AGE'], 'required'],
            [['OWNER_TITLE', 'PASPOTTYP', 'TUMBON_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'ICC', 'CAR_ID', 'CREATE_BY', 'UPDATE_BY', 'REQ_ID'], 'integer'],
            [['PASPOT_ISSUE', 'PASPOT_EXP', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ATTRACT_FILE'], 'string'],
            [['OWNER_FNME', 'OWNER_MNME', 'OWNER_LNME'], 'string', 'max' => 50],
            [['OWNER_AGE'], 'string', 'max' => 3],
            [['PSLNUM', 'PASPOTNUM', 'TELEPHONE'], 'string', 'max' => 20],
            [['EMAIL', 'ADDR'], 'string', 'max' => 120],
            [['POSCDE'], 'string', 'max' => 10],
            [['REQ_REF'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ลำดับรถที่ขออนุญาต',
            'OWNER_TITLE' => 'คำนำหน้าชื่อเจ้าของรถ',
            'OWNER_FNME' => 'ชื่อเจ้าของรถ',
            'OWNER_MNME' => 'ชื่อกลางเจ้าของรถ',
            'OWNER_LNME' => 'นามสกุลเจ้าของรถ',
            'OWNER_AGE' => 'อายุเจ้าของรถ',
            'PSLNUM' => 'เลขประจำตัวประชาชน',
            'PASPOTTYP' => 'ชนิดของ Passport',
            'PASPOTNUM' => 'เลขที่ Passport',
            'PASPOT_ISSUE' => 'วันที่ทำ Passport',
            'PASPOT_EXP' => 'วันหมดอายุ Passport',
            'EMAIL' => 'Email',
            'TELEPHONE' => 'Telephone',
            'ADDR' => 'ที่อยู่',
            'TUMBON_ID' => 'จาก Table TUMBON',
            'AMPHUR_ID' => 'จาก Table AMPHUR',
            'PROVINCE_ID' => 'จาก TABLE PROVICE',
            'POSCDE' => 'รหัสไปรษณีย์',
            'ICC' => 'ประเทศที่เจ้าของรถอยู่',
            'ATTRACT_FILE' => 'เอกสารแนบ',
            'CAR_ID' => 'FK_CAR',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'REQ_REF' => 'เลขอ้างอิงคำขอ',
            'REQ_ID' => 'อ้างอิง ID Permit_Request',
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
                        'url' => Url::to(['/vehicle/permit-owner/deletefile', 'id' => $this->ID, 'fileName' => $key, 'field' => $field]),
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
