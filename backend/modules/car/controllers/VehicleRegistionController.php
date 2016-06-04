<?php

namespace backend\modules\car\controllers;

use Yii;
use backend\modules\car\models\PermitOwner;
use backend\modules\car\models\PermitOwnerSearch;
use backend\modules\car\models\PermitRequest;
use backend\modules\car\models\PermitCar;
use backend\modules\car\models\PermitInsulance;
use backend\modules\car\models\PermitDriver;
use backend\modules\car\models\CarPhoto;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\NationalProvince;
use backend\modules\car\models\Model;
//use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use kartik\helpers\Html;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * VehicleRegistionController implements the CRUD actions for PermitOwner model.
 */
class VehicleRegistionController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PermitOwner models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PermitOwnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

// เพิ่มรายการคำขอ
    public function actionCreate() {
        $model = new PermitOwner();
        $modelRequest = new PermitRequest();
        $model->REQ_REF = $this->getOrderId();

        if ($model->load(Yii::$app->request->post()) && $modelRequest->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelRequest])) {
           $this->CreateDir($model->IMAGE_REF);
            $model->ATTRACT_FILE = $this->uploadMultipleFile($model);
            if ($model->save()) {
                $modelRequest->REQ_REF = $model->REQ_REF;
                $modelRequest->CAR_ID = $model->ID;
                $modelRequest->save();
            }
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelRequest' => $modelRequest
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelRequest = $this->findModelRequest($model->ID);
        $province_th = ArrayHelper::map($this->getProvince($modelRequest->COUNTRY), 'id', 'name');
        $border_th = ArrayHelper::map($this->getBorder($modelRequest->ROUTE_PROVINCE), 'id', 'name');
        $province_na = ArrayHelper::map($this->getProvinceNational($model->ICC), 'id', 'name');
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->REQ_REF);
        $tempCovenant = $model->ATTRACT_FILE;
        //$tempDocs = $model->DOCS;

        if (
                $model->load(Yii::$app->request->post()) &&
                $modelRequest->load(Yii::$app->request->post()) &&
                Model::validateMultiple([$model, $modelRequest])
        ) {
            $this->CreateDir($model->REQ_REF);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTRACT_FILE = $this->uploadMultipleFile($model, $tempCovenant);

            if ($modelRequest->save()) {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelRequest' => $modelRequest,
                        'province_th' => $province_th,
                        'province_na' => $province_na,
                        'border_th' => $border_th
            ]);
        }
    }

    public function actionVehicleInfo($id) {
        $modelOwner = $this->findModel($id);
        $modelRequest = $this->findModelRequest($modelOwner->ID);

        $model = new PermitCar();
        $model->OWNER_ID = $modelOwner->ID;
        $model->REQ_REF = $modelOwner->REQ_REF;
        $model->IMAGE_REF = $modelOwner->REQ_REF;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('vehicle-info', [
                        'model' => $model,
                        'modelOwner' => $modelOwner,
                        'modelRequest' => $modelRequest
            ]);
        }
    }

    public function actionVehicleMaster() {
        $model = new PermitCar();
        $modelsDriver = [new PermitDriver];
        $modelsInsulance = [new PermitInsulance];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsDriver = Model::createMultiple(PermitDriver::classname());
            Model::loadMultiple($modelsDriver, Yii::$app->request->post());

            $modelsInsulance = Model::createMultiple(PermitInsulance::classname());
            Model::loadMultiple($modelsInsulance, Yii::$app->request->post());

            // ajax validation
            // validate all models

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDriver) && $valid;

            $valid = Model::validateMultiple($modelsInsulance) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDriver as $modelDriver) {
                            $modelDriver->customer_id = $model->id;
                            if (!($flag = $modelDriver->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        foreach ($modelsInsulance as $modelInsulance) {
                            $modelInsulance->customer_id = $model->id;
                            if (!($flag = $modelInsulance->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('vehicle-master', [
                        'model' => $model,
                        'modelsDriver' => (empty($modelsDriver)) ? [new PermitDriver] : $modelsDriver,
                        'modelsInsulance' => (empty($modelsInsulance)) ? [new PermitInsulance] : $modelsInsulance,
            ]);
        }
    }

    public function actionVehicleMasterZ() {
        $model = new PermitCar();
        $modelsDrivers = [new PermitDriver];

        if ($model->load(Yii::$app->request->post())) {
            $modelsDrivers = Model::createMultiple(PermitDriver::classname());
            Model::loadMultiple($modelsDrivers, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDrivers) && $valid;
            //$this->Uploads(false);
            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {

                        foreach ($modelsDrivers as $drivers) {
                            $drivers->CAR_ID = $model->id;
                            if (!($flag = $drivers->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {

                        $transaction->commit();
                        Yii::$app->getSession()->setFlash('alert1', [
                            'type' => 'success',
                            'duration' => 10000,
                            'icon' => 'fa fa-bus',
                            'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย ผู้ขออนุญาต -  ' . $model->fullname,
                            'title' => 'การบันทึกข้อมูล',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);

                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    Yii::$app->getSession()->setFlash('alert2', [
                        'type' => 'danger',
                        'duration' => 10000,
                        'icon' => 'fa fa-error',
                        'message' => 'เกิดข้อผิดพลาด บันทึกข้อมูลwไม่สำเร็จ',
                        'title' => 'การบันทึกข้อมูล',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    $transaction->rollBack();
                }
            }
        }

        $model->ref = Yii::$app->getSecurity()->generateRandomString(6);

        return $this->render('vehicle-master', [
                    'model' => $model,
                    'modelsDrivers' => (empty($modelDrivers)) ? [new Drivers] : $modelDrivers,
                    'border_start' => [],
                    'border_out' => [],
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = PermitOwner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelRequest($id) {
        if (($modelRequest = PermitRequest::findOne($id)) !== null) {
            return $modelRequest;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getOrderId() {
        $code = "R";
        $yearMonth = substr(date("Y") + 543, -2) . date("m");
        $request = PermitRequest::find()->select('REQ_REF')->orderBy('REQ_REF DESC')->one();
        $maxId = "000001";
        if (!empty($request)) {
            $maxId = substr($request->REQ_REF, -6);
            $maxId = ($maxId + 1);
            $maxId = substr("000000" . $maxId, -6);
            $nextId = $code . $yearMonth . $maxId;
        }
        $nextId = $code . $yearMonth . $maxId;
        return $nextId;
    }

    // Dependence Dropdown list
    //////////////////////////////////////////////////////////////////////  Depdrop
    public function actionGetProvince() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getProvince($province_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetProvinceNational() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getProvinceNational($province_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getDistrict($amphur_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetBorder() {
        $out = [];
        if (isset($_POST[
                        'depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getBorder($province_id);
                echo Json::encode(['output' => $out, 'เลือกรายการ' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'เลือกรายการ' =>
            '']);
    }

    protected function getBorder($id) {
        $datas = CustBorderPoint::find()->where(['PROVINCE_ID' => $id])->all();
        return $this->MapData($datas, 'BORDER_POINT_CODE', 'BORDER_POINT_NAME');
    }

    protected function getProvince($id) {
        $datas = Province::find()->where(['BORDER_COUNTRY' => $id, 'BORDER_FLAG' => 1])->all();
        return $this->MapData($datas, 'PROVINCE_CODE', 'PROVINCE_NAME');
    }

    protected function getProvinceNational($id) {
        $datas = NationalProvince::find()->where(['country_code' => $id])->all();
        return $this->MapData($datas, 'id', 'Fullprv');
    }

    protected function getAmphur($id) {
        $datas = Amphur::find()->where(['PROVINCE_ID' => $id])->all();
        return $this->MapData($datas, 'AMPHUR_ID', 'AMPHUR_NAME');
    }

    protected function getDistrict($id) {
        $datas = District::find()->where(['AMPHUR_ID' => $id])->all();
        return $this->MapData($datas, 'DISTRICT_ID', 'DISTRICT_NAME');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    // upload function  การจัดการ สร้าง โฟลเดอร์ ลบไฟล์

    public function actionDeletefile($id, $field, $fileName) {
        $status = ['success' => false];
        if (in_array($field, ['DOCS', 'ATTRACT_FILE'])) {
            $model = $this->findModel($id);
            $files = Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->REQ_REF, $fileName)) {
                    $status = ['success' => true];
                    unset($files[$fileName]);
                    $model->{$field} = Json::encode($files);
                    $model->save();
                }
            }
        }
        echo json_encode($status);
    }

    private function deleteFile($type = 'file', $ref, $fileName) {
        if (in_array($type, ['file', 'thumbnail'])) {
            if ($type === 'file') {
                $filePath = PermitRequest::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = PermitRequest::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    public function actionDownload($id, $file, $file_name) {
        $model = $this->findModel($id);
        if (!empty($model->REQ_REF) && !empty($model->ATTRACT_FILE)) {
            Yii::$app->response->sendFile($model->getUploadPath() . $model->REQ_REF . '/' . $file, $file_name);
        } else {
            $this->redirect(['/tta/request-permit/view', 'id' => $id]);
        }
    }

    /**
     * Upload & Rename file
     * @return mixed
     */
    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'docs');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(PermitRequest::UPLOAD_FOLDER . '/' . $model->REQ_REF . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }

    private function uploadMultipleFile($model, $tempFile = null) {
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model, 'ATTRACT_FILE');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(PermitRequest::UPLOAD_FOLDER . '/' . $model->REQ_REF . '/' . $newFileName);
                    $files[$newFileName] = $oldFileName;
                } catch (Exception $e) {
                    
                }
            }
            $json = json::encode(ArrayHelper::merge($tempFile, $files));
        } else {
            $json = $tempFile;
        }
        return $json;
    }

    private function getInitialPreview($ref) {
        $datas = PermitRequest::find()->where(['REQ_REF' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            // array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                //'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to(['/photo-library/deletefile-ajax']),
                    // 'key' => $value->upload_id
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    private function getTemplatePreview(Uploads $model) {
        $filePath = PermitRequest::getUploadUrl() . $model->REQ . '/thumbnail/' . $model->real_filename;
        $isImage = $this->isImage($filePath);
        if ($isImage) {
            $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
        } else {
            $file = "<div class='file-preview-other'> " .
                    "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                    "</div>";
        }
        return $file;
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = PermitRequest::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(PermitRequest::getUploadPath() . $dir);
    }

    // En Upload
}
