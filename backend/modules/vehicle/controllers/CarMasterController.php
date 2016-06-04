<?php

namespace backend\modules\vehicle\controllers;

use Yii;
use backend\modules\vehicle\models\CarMaster;
use backend\modules\vehicle\models\CarMasterSearch;
use backend\modules\car\models\PermitRequest;
use backend\modules\car\models\Uploads;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\NationalProvince;
use backend\modules\car\models\PermitDriver;
use backend\modules\car\models\PermitOwner;
use backend\modules\car\models\PermitInsulance;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\base\Security;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\modules\car\models\Model;
use yii\data\ActiveDataProvider;

/**
 * CarMasterController implements the CRUD actions for CarMaster model.
 */
class CarMasterController extends Controller {

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
     * Lists all CarMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CarMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $modelsDriver = new ActiveDataProvider([
            'query' => PermitDriver::find()->where(['CAR_ID' => $id]),
            'sort' => ['defaultOrder' => ['ID' => SORT_ASC]]
        ]);
        $modelsOwner = new ActiveDataProvider([
            'query' => PermitOwner::find()->where(['CAR_ID' => $id]),
            'sort' => ['defaultOrder' => ['ID' => SORT_DESC]]
        ]);
        $modelsIns = new ActiveDataProvider([
            'query' => PermitInsulance::find()->where(['CAR_ID' => $id]),
        ]);

        $security = new Security();
        $string = Yii::$app->request->post('string');
        $stringHash = '';
        if (!is_null($string)) {
            $stringHash = $security->generatePasswordHash($string);
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelsDriver' => $modelsDriver,
                    'modelsOwner' => $modelsOwner,
                    'modelsInsulance' => $modelsIns,
                    'stringHash' => $stringHash,
        ]);
    }

    /**
     * Creates a new CarMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CarMaster();
        $modelRequest = new PermitRequest();
        $model->REQ_REF = $this->getReqRef();

        if ($model->load(Yii::$app->request->post()) && $modelRequest->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelRequest])) {
            $this->CreateDir($model->IMAGE_REF);
            // $model->covenant = $this->uploadSingleFile($model);
            $model->ATTACH_FILE = $this->uploadMultipleFile($model);
            $this->Uploads(false);

            if ($model->save()) {
                $modelRequest->REQ_REF = $model->REQ_REF;
                $modelRequest->CAR_ID = $model->ID;
                $modelRequest->save();
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 10000,
                    'icon' => 'fa fa-bus',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย ผู้ขออนุญาต -  ' . $model->REQ_REF,
                    'title' => 'การบันทึกข้อมูล',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        } else {
            $model->IMAGE_REF = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelRequest' => $modelRequest,
        ]);
    }

    public function actionFileAjax($id) {
        $model = CarMaster::find()->where(['ID' => $id])->one();
        if ($model->ATTACH_FILE) {
            $files = Json::decode($model->ATTACH_FILE);
            foreach ($files as $key => $value) {
                $img = CarMaster::getUploadUrl() . $model->IMAGE_REF . '/' . $key;
                $pass2 = '<img class="img-responsive" src="' . $img . '"  />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass2,
        ]);
    }

    /**
     * Updates an existing CarMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelRequest = $this->findModelRequest($model->ID);
        $model->CORCDE = $model->getArray($model->CORCDE);
        $tempDocs = $model->ATTACH_FILE;
        $province_th = ArrayHelper::map($this->getProvince($modelRequest->COUNTRY), 'id', 'name');
        $border_th = ArrayHelper::map($this->getBorder($modelRequest->ROUTE_PROVINCE), 'id', 'name');
        $province_na = ArrayHelper::map($this->getProvinceNational($modelRequest->COUNTRY), 'id', 'name');
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->IMAGE_REF);

        if (
                $model->load(Yii::$app->request->post()) &&
                $modelRequest->load(Yii::$app->request->post()) &&
                Model::validateMultiple([$model, $modelRequest])
        ) {
            $this->CreateDir($model->IMAGE_REF);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTACH_FILE = $this->uploadMultipleFile($model, $tempDocs);
            $this->Uploads(false);

            if ($model->save()) {
                $modelRequest->save();
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'info',
                    'duration' => 10000,
                    'icon' => 'fa fa-bus',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย ผู้ขออนุญาต -  ' . $model->REQ_REF,
                    'title' => 'การบันทึกข้อมูล',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'modelRequest' => $modelRequest,
                    'province_th' => $province_th,
                    'province_na' => $province_na,
                    'border_th' => $border_th
        ]);
    }

    public function actionCarMaster($id) {
        $model = $this->findModel($id);
        $modelRequest = $this->findModelRequest($model->ID);

        return $this->render('car-master', [
                    'model' => $model,
                    'modelRequest' => $modelRequest
        ]);
    }

    /**
     * Deletes an existing CarMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CarMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CarMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CarMaster::findOne($id)) !== null) {
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

    /* |*********************************************************************************|
      |================================ Upload Ajax ====================================|
      |*********************************************************************************| */

    public function actionUploadAjax() {
        $this->Uploads(true);
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = CarMaster::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(CarMaster::getUploadPath() . $dir);
    }

    private function Uploads($isAjax = false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $PhotoLibrary = Yii::$app->request->post('CarMaster');
                    $ref = $PhotoLibrary['IMAGE_REF'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = CarMaster::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if ($this->isImage(Url::base(true) . '/' . $savePath)) {
                            $this->createThumbnail($ref, $realFileName);
                        }

                        $model = new Uploads;
                        $model->ref = $ref;
                        $model->file_name = $fileName;
                        $model->real_filename = $realFileName;
                        $model->save();

                        if ($isAjax === true) {
                            echo json_encode(['success' => 'true']);
                        }
                    } else {
                        if ($isAjax === true) {
                            echo json_encode(['success' => 'false', 'eror' => $file->error]);
                        }
                    }
                }
            }
        }
    }

    private function getInitialPreview($ref) {
        $datas = Uploads::find()->where(['ref' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to(['/vehicle/car-master/deletefile-ajax']),
                'key' => $value->upload_id
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath) {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model) {
        $filePath = CarMaster::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
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

    private function createThumbnail($folderName, $fileName, $width = 250) {
        $uploadPath = CarMaster::getUploadPath() . '/' . $folderName . '/';
        $file = $uploadPath . $fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax() {

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename = CarMaster::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = CarMaster::getUploadPath() . $model->ref . '/thumbnail/' . $model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

    /**
     * Upload & Rename file   Not Ajax
     * @return mixed
     */
    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'covenant');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(CarMaster::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
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
        $UploadedFiles = UploadedFile::getInstances($model, 'ATTACH_FILE');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(CarMaster::UPLOAD_FOLDER . '/' . $model->IMAGE_REF . '/' . $newFileName);
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

    public function actionDeletefile($id, $field, $fileName) {
        $status = ['success' => false];
        if (in_array($field, ['ATTACH_FILE', 'covenant'])) {
            $model = $this->findModel($id);
            $files = Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->ATTACH_FILE, $fileName)) {
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
                $filePath = CarMaster::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = CarMaster::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    public function actionDownload($id, $file, $file_name) {
        $model = $this->findModel($id);
        if (!empty($model->ref) && !empty($model->ATTACH_FILE)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->IMAGE_REF . '/' . $file, $file_name);
        } else {
            $this->redirect(['/vehicle/car-master/view', 'id' => $id]);
        }
    }

    public function getReqRef() {
        $code = "R";
        $yearMonth = substr(date("Y") + 543, -2) . date("m");
        $request = CarMaster::find()->select('REQ_REF')->orderBy('REQ_REF DESC')->one();
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


}
