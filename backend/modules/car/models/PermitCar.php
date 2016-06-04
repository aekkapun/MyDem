<?php

namespace backend\modules\car\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\helpers\Html;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "permit_car".
 *
 * @property integer $ID
 * @property string $TSPMDE
 * @property string $VHCLCN1
 * @property string $VHCLCN2
 * @property string $VHCPRV
 * @property integer $VHCCTY
 * @property string $VHCVERNUM
 * @property integer $VHCBANCDE
 * @property integer $CARCATE
 * @property integer $VHCTYP
 * @property integer $CARAPPR
 * @property string $VHCMDLCDE
 * @property string $CORCDE
 * @property string $VHCYER
 * @property string $CHSNUM
 * @property string $ENENUM
 * @property string $CC
 * @property string $HP
 * @property string $KW
 * @property string $ENG_TYP
 * @property string $FUEL_TYP
 * @property string $GPS
 * @property string $VHCVAL
 * @property string $WGT
 * @property string $TOTAL_WGT
 * @property integer $TOTPSG
 * @property string $REGIS_STATUS
 * @property string $REF_SUCCESS
 * @property string $REQ_REF
 * @property string $ATTACH_FILE
 * @property string $IMAGE_REF
 * @property integer $OWNER_ID
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property integer $CREATE_BY
 * @property integer $UPDATE_BY
 *
 * @property PermitOwner $oWNER
 * @property PermitDriver[] $permitDrivers
 * @property PermitInsurance[] $permitInsurances
 * @property PermitRegister[] $permitRegisters
 */
class PermitCar extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_car';
    }

    const UPLOAD_FOLDER = 'paperless';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CREATE_AT',
                'updatedAtAttribute' => 'UPDATE_AT',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'CREATE_BY',
                'updatedByAttribute' => 'UPDATE_BY'
            ],
        ];
    }

    public function rules() {
        return [
            //[['VHCLCN1', 'VHCLCN2', 'VHCPRV', 'VHCCTY', 'VHCVERNUM', 'VHCBANCDE', 'CARCATE', 'VHCTYP', 'CARAPPR', 'VHCMDLCDE', 'CORCDE', 'CHSNUM', 'ENENUM', 'WGT', 'TOTAL_WGT', 'ATTACH_FILE', 'IMAGE_REF'], 'required'],
            [['VHCLCN1', 'VHCLCN2'], 'required'],
            [['VHCCTY', 'VHCBANCDE', 'CARCATE', 'VHCTYP', 'CARAPPR', 'TOTPSG', 'OWNER_ID', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TSPMDE'], 'string', 'max' => 1],
            [['IMAGE_REF'], 'string', 'max' => 50],
            [['VHCLCN1'], 'string', 'max' => 2],
            [['VHCLCN2'], 'string', 'max' => 4],
            [['VHCPRV'], 'string', 'max' => 120],
            [['VHCVERNUM', 'VHCYER'], 'string', 'max' => 10],
            [['REQ_REF'], 'string', 'max' => 15],
            [['VHCMDLCDE', 'CHSNUM', 'ENENUM'], 'string', 'max' => 50],
            [['ENG_TYP', 'FUEL_TYP', 'GPS', 'VHCVAL'], 'string', 'max' => 20],
            [['CC', 'HP', 'KW'], 'string', 'max' => 6],
            [['WGT', 'TOTAL_WGT'], 'string', 'max' => 5],
            [['REGIS_STATUS'], 'string', 'max' => 3],
            [['REF_SUCCESS'], 'string', 'max' => 8],
                // [['OWNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PermitOwner::className(), 'targetAttribute' => ['OWNER_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ลำดับรถที่ขออนุญาต',
            'TSPMDE' => 'ประเภทยานพาหนะ (default=3)',
            'VHCLCN1' => 'หมวดเลขทะเบียนรถยนต์',
            'VHCLCN2' => 'เลขทะเบียนรถยนต์',
            'VHCPRV' => 'รัฐ/มณฑล',
            'VHCCTY' => 'ประเทศที่จดทะเบียน',
            'VHCVERNUM' => 'ใช้เก็บ Version รถ เช่น รถคันเดิมไปแต่งเพิ่ม',
            'VHCBANCDE' => 'รหัสยี่ห้อ ',
            'CARCATE' => 'รหัสประเภทรถ',
            'VHCTYP' => 'รหัสประเภทยานพาหนะ ',
            'CARAPPR' => 'รหัสลักษณะรถ ',
            'VHCMDLCDE' => 'รหัสรุ่นยานพาหนะ',
            'CORCDE' => 'รหัสสีใช้จาก ',
            'VHCYER' => 'รหัสปี',
            'CHSNUM' => 'หมายเลขตัวถัง',
            'ENENUM' => 'หมายเลขเครื่องยนต์',
            'CC' => 'ขนาดกระบอกสูบ',
            'HP' => 'แรงม้า',
            'KW' => 'กำลังไฟฟ้า',
            'ENG_TYP' => 'ประเภทพลังงาน',
            'FUEL_TYP' => 'ชนิดเชื้อเพลิงที่ใช้กับเครื่องยนต์',
            'GPS' => 'พิกัด GPS',
            'VHCVAL' => 'ราคา',
            'WGT' => 'น้ำหนักรถยนต์',
            'TOTAL_WGT' => 'น้ำหนักรวม',
            'TOTPSG' => 'จำนวนผู้โดยสาร',
            'REGIS_STATUS' => 'สถานะ  การลงทะเบียน',
            'REF_SUCCESS' => 'Ref  Success',
            'REQ_REF' => 'เลขอ้างอิง คำขอ',
            'ATTACH_FILE' => 'หลักฐานแสดงการจดทะเบียน File',
            'IMAGE_REF' => 'อ้างอิง โฟลเดอร์ที่เก็บรูป',
            'OWNER_ID' => 'อ้างอิง เจ้าของรถ',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOWNER() {
        return $this->hasOne(PermitOwner::className(), ['ID' => 'OWNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitDrivers() {
        return $this->hasMany(PermitDriver::className(), ['CAR_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitInsurances() {
        return $this->hasMany(PermitInsurance::className(), ['CAR_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitRegisters() {
        return $this->hasMany(PermitRegister::className(), ['CAR_ID' => 'ID']);
    }

    // Start of photo property

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getThumbnails($ref, $event_name) {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl(true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrl(true) . $ref . '/thumbnail/' . $file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }

    public function initialPreview($data, $field, $type = 'file') {
        $initial = [
        ];
        //$files = Json::encode($data);
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                if ($type == 'file') {
                    $img = self::getUploadUrl() . $this->REQ_REF . '/' . $key;
                    $initial[] = '<img src="' . $img . '" width="200" />';
                    //$initial[] = Html::img(self::getUploadUrl() . $this->REQ_REF . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width' => '120px',
                        'url' => Url::to(['/car/vehicle-registion/deletefile', 'id' => $this->ID, 'fileName' => $key, 'field' => $field]),
                        'key' => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . '/' . $this->REQ_REF . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                }
            }
        }
        return $initial;
    }

    // end of photo property
}
