<?php

namespace backend\modules\car\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "permit_insurance".
 *
 * @property integer $ID
 * @property string $INSURANCE_CMPNME
 * @property string $INSURANCE_NO
 * @property string $INSURANCE_EXP
 * @property string $INSURANCE_FILE
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property integer $CREATE_BY
 * @property integer $UPDATE_BY
 * @property integer $CAR_ID
 *
 * @property PermitCar $cAR
 */
class PermitInsulance extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_insurance';
    }

    const UPLOAD_FOLDER = 'insulance';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['INSURANCE_EXP', 'INSURANCE_CMPNME', 'INSURANCE_NO'], 'required'],
            [['INSURANCE_EXP', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['INSURANCE_FILE'], 'string'],
            [['CREATE_BY', 'UPDATE_BY', 'CAR_ID'], 'integer'],
            [['INSURANCE_CMPNME', 'INSURANCE_NO'], 'string', 'max' => 255],
                // [['CAR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PermitCar::className(), 'targetAttribute' => ['CAR_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'INSURANCE_CMPNME' => 'Insurance  Cmpnme',
            'INSURANCE_NO' => 'Insurance  No',
            'INSURANCE_EXP' => 'Insurance  Exp',
            'INSURANCE_FILE' => 'Insurance  File',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'CAR_ID' => 'Car  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCAR() {
        return $this->hasOne(PermitCar::className(), ['ID' => 'CAR_ID']);
    }

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getLink($id) {
        $url = Url::to(['/vehicle/permit-insulance/json', 'id' => $id]);
        $link = Html::a('<i class="fa fa-paperclip" aria-hidden="true"></i> attachment', $url, ['title' => 'Go', 'target' => '_blank']);
        return $link;
        }

    public function listDownloadFiles($type) {
        $docs_file = '';
        if (in_array($type, ['INSURANCE_FILE', 'covenant'])) {
            $data = $type === 'INSURANCE_FILE' ? $this->INSURANCE_FILE : $this->covenant;
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>' . Html::a('เอกสารแบบ', ['/vehicle/car-master/download', 'id' => $this->ID, 'file' => $key, 'file_name' => $value]) . '</li>';
                }
                $docs_file .='</ul>';
            }
        }

        return $docs_file;
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
                        'url' => Url::to(['/vehicle/permit-insulance/deletefile', 'id' => $this->ID, 'fileName' => $key, 'field' => $field]),
                        'key' => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . '/' . $this->CAR_ID . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                }
            }
        }
        return $initial;
    }

}
