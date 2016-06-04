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
 * @property string $TELEPHONE
 * @property string $ADDR
 * @property integer $TUMBON_ID
 * @property integer $AMPHUR_ID
 * @property integer $PROVINCE_ID
 * @property string $POSCDE
 * @property integer $ICC
 * @property string $ATTRACT_FILE
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property integer $CREATE_BY
 * @property integer $UPDATE_BY
 * @property string $REQ_REF
 * @property integer $REQ_ID
 *
 * @property PermitCar[] $permitCars
 */
class PermitOwner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'permit_owner';
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
    public function rules() {
        return [
            [['OWNER_TITLE', 'OWNER_FNME', 'OWNER_LNME', 'OWNER_AGE'], 'required'],
            [['OWNER_TITLE', 'PASPOTTYP','CAR_ID', 'TUMBON_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'ICC', 'CREATE_BY', 'UPDATE_BY', 'REQ_ID'], 'integer'],
            [['PASPOT_ISSUE', 'PASPOT_EXP', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            //[['ATTRACT_FILE'], 'string'],
            [['OWNER_FNME', 'OWNER_MNME', 'EMAIL', 'OWNER_LNME'], 'string', 'max' => 50],
            [['OWNER_AGE'], 'string', 'max' => 3],
            [['PSLNUM', 'PASPOTNUM', 'TELEPHONE'], 'string', 'max' => 20],
            [['ADDR'], 'string', 'max' => 120],
            [['POSCDE'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'OWNER_TITLE' => 'Owner  Title',
            'OWNER_FNME' => 'Owner  Fnme',
            'OWNER_MNME' => 'Owner  Mnme',
            'OWNER_LNME' => 'Owner  Lnme',
            'OWNER_AGE' => 'Owner  Age',
            'PSLNUM' => 'Pslnum',
            'PASPOTTYP' => 'Paspottyp',
            'PASPOTNUM' => 'Paspotnum',
            'PASPOT_ISSUE' => 'Paspot  Issue',
            'PASPOT_EXP' => 'Paspot  Exp',
            'TELEPHONE' => 'Telephone',
            'ADDR' => 'Addr',
            'TUMBON_ID' => 'Tumbon  ID',
            'AMPHUR_ID' => 'Amphur  ID',
            'PROVINCE_ID' => 'Province  ID',
            'POSCDE' => 'Poscde',
            'ICC' => 'Icc',
            'ATTRACT_FILE' => 'Attract  File',
            'EMAIL' => 'e-Mail',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'REQ_REF' => 'Req  Ref',
            'REQ_ID' => 'Req  ID',
            'CAR_ID' => 'Req  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermitCars() {
        return $this->hasMany(PermitCar::className(), ['CAR_ID' => 'ID']);
    }

    //File Upload Function

    public function listDownloadFiles($type) {
        $docs_file = '';
        if (in_array($type, ['ATTRACT_FILE', 'DOCS'])) {
            $data = $type === 'ATTRACT_FILE' ? $this->ATTRACT_FILE : $this->DOCS;
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>' . Html::a($value, ['/freelance/download', 'id' => $this->id, 'file' => $key, 'file_name' => $value]) . '</li>';
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

}
