<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\modules\car\models\Uploads;
use backend\modules\master\models\Color;
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
 * @property PermitDriver[] $permitDrivers
 * @property PermitInsurance[] $permitInsurances
 * @property PermitRegister[] $permitRegisters
 */
class CarMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_car';
    }

    const UPLOAD_FOLDER = 'photolibrarys';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['VHCLCN1', 'VHCLCN2','VHCCTY', 'VHCVERNUM', 'VHCBANCDE', 'CARCATE', 'VHCTYP', 'CARAPPR', 'VHCMDLCDE', 'CORCDE', 'CHSNUM', 'ENENUM', 'WGT', 'TOTAL_WGT','ATTACH_FILE'], 'required'],
            [['VHCLCN1', 'VHCLCN2', 'CHSNUM', 'ENENUM', 'WGT', 'TOTAL_WGT', 'TOTPSG', 'CARAPPR', 'VHCTYP', 'CORCDE', 'TSPMDE', 'VHCCTY', 'VHCBANCDE'], 'required'],
            [['VHCCTY','CARAPPR', 'TSPMDE', 'VHCBANCDE', 'CARCATE', 'CREATE_BY', 'UPDATE_BY'], 'integer'],
            [['VHCLCN1'], 'string', 'max' => 2],
            [['VHCLCN2'], 'string', 'max' => 4],
            [['CORCDE'], 'safe'],
            [['VHCPRV', 'REQ_REF'], 'string', 'max' => 120],
            [['VHCVERNUM', 'VHCYER'], 'string', 'max' => 20],
            [['VHCMDLCDE', 'CHSNUM', 'ENENUM', 'IMAGE_REF'], 'string', 'max' => 50],
            [['ENG_TYP', 'FUEL_TYP', 'GPS', 'VHCVAL'], 'string', 'max' => 20],
            [['CC', 'HP', 'KW'], 'integer'],
            [['WGT', 'TOTAL_WGT', 'TOTPSG', 'CARAPPR', 'VHCTYP'], 'integer'],
            [['REGIS_STATUS'], 'string', 'max' => 3],
            [['REF_SUCCESS', 'GPS'], 'string', 'max' => 15],
            [['ATTACH_FILE'], 'file', 'maxFiles' => 10, 'skipOnEmpty' => true]
        ];
    }

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

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ลำดับรถที่ขออนุญาต',
            'TSPMDE' => 'ประเภทยานพาหนะ (default=3)',
            'VHCLCN1' => '',
            'VHCLCN2' => '',
            'VHCPRV' => 'รัฐ/มณฑล',
            'VHCCTY' => 'ประเทศที่จดทะเบียน',
            'VHCVERNUM' => 'ใช้เก็บ Version รถ เช่น รถคันเดิมไปแต่งเพิ่ม',
            'VHCBANCDE' => 'รหัสยี่ห้อ จาก Table VEHICLE_BRAND',
            'CARCATE' => 'รหัสประเภทรถ จาก Table CAR_CATEGORY',
            'VHCTYP' => 'รหัสประเภทยานพาหนะ จาก Table VEHICLE_TYPE',
            'CARAPPR' => 'รหัสลักษณะรถ จาก Table CAR_APPEARANCE',
            'VHCMDLCDE' => 'รหัสรุ่นยานพาหนะ',
            'CORCDE' => 'รหัสสีใช้จาก table Color',
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
    public function getPlate(){
        return $this->VHCLCN1 .'-'.$this->VHCLCN2;
    }
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

    public function getProvince() {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'province_id']);
    }

    public function getItemColor() {
        return self::itemAlias('color');
    }

    public function getColorName(){
        //$skills = $this->getItemSkill();
        $skills = ArrayHelper::map(Color::find()->all(),'color_code','color');
        $skillSelected = explode(',', $this->CORCDE);
        $skillSelectedName = [];
        foreach ($skills as $key => $skillName) {
          foreach ($skillSelected as $skillKey) {
            if($key === (int)$skillKey){
              $skillSelectedName[] = $skillName;
            }
          }
        }
        return implode(', ', $skillSelectedName);
    }

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function listDownloadFiles($type) {
        $docs_file = '';
        if (in_array($type, ['ATTACH_FILE', 'covenant'])) {
            $data = $type === 'ATTACH_FILE' ? $this->ATTACH_FILE : $this->covenant;
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>' . Html::a($value, ['/vehicle/car-master/download', 'id' => $this->ID, 'file' => $key, 'file_name' => $value]) . '</li>';
                }
                $docs_file .='</ul>';
            }
        }

        return $docs_file;
    }

    public function initialPreview($data, $field, $type = 'file') {
        $initial = [];
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                if ($type == 'file') {
                    $img = self::getUploadUrl() . $this->IMAGE_REF . '/' . $key;
                    $initial[] = '<img src="' . $img . '" height="100" />';
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width' => '120px',
                        'url' => Url::to([''
                            . '/vehicle/car-master/deletefile', 'id' => $this->ID, 'fileName' => $key, 'field' => $field]),
                        'key' => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . $this->IMAGE_REF . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                }
            }
        }
        return $initial;
    }

    // Set Array To Db

    public function getArray($value) {
        return explode(',', $value);
    }

    public function setToArray($value) {
        return is_array($value) ? implode(',', $value) : NULL;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (!empty($this->CORCDE)) {
                // $this->social = $this->setToArray($this->social);
                $this->CORCDE = $this->setToArray($this->CORCDE);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'color' => ArrayHelper::map(Color::find()->all(), 'color_code', 'color'),
            'sex' => array(
                '1' => 'ชาย',
                '2' => 'หญิง',
            ),
            'marital' => array(
                '1' => 'โสด',
                '2' => 'สมรส',
                '3' => 'อย่างร้าง',
                '4' => 'แยกกันอยู่',
                '5' => 'หมา้ย',
            ),
            'skill' => [
                'Objective C' => 'Objective C',
                'Python' => 'Python',
                'Java' => 'Java',
                'JavaScript' => 'JavaScript',
                'PHP' => 'PHP',
                'SQL' => 'SQL',
                'Ruby' => 'Ruby',
                'FoxPro' => 'FoxPro',
                'C++' => 'C++',
                'C' => 'C',
                'ASP' => 'ASP',
                'Assembly' => 'Assembly',
                'Visual Basic' => 'Visual Basic'
            ],
            'social' => [
                'facebook' => 'Facebook',
                'twiter' => 'Twiter',
                'google+' => 'Google+',
                'tumblr' => 'Tumblr'
            ],
        );


        if (isset($code)) {
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        } else {
            return isset($_items[$type]) ? $_items[$type] : false;
        }
    }

}
