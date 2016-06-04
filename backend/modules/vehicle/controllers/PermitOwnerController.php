<?php

namespace backend\modules\vehicle\controllers;

use Yii;
use backend\modules\vehicle\models\PermitOwner;
use backend\modules\vehicle\models\PermitOwnerSearch;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\NationalProvince;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * PermitOwnerController implements the CRUD actions for PermitOwner model.
 */
class PermitOwnerController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-ajax' => ['POST'],
                ],
            ],
        ];
    }

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

    public function actionViewAjax($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($id) {
        $model = new PermitOwner();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTRACT_FILE = $this->uploadSingleFile($model);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 10000,
                    'icon' => 'fa fa-newspaper-o',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย',
                    'title' => 'การบันทึกข้อมูล',
                ]);
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        } else {
            return $this->render('create-ajax', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCreateAjax($id) {
        $model = new PermitOwner();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTRACT_FILE = $this->uploadSingleFile($model);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 10000,
                    'icon' => 'fa fa-newspaper-o',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย',
                    'title' => 'การบันทึกข้อมูล',
                ]);
                return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID, '#' => 'home']);
            }
        } else {
            return $this->renderAjax('create-ajax', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate_bak($id) {
        $model = $this->findModel($id);
        $province_na = ArrayHelper::map($this->getProvinceNational($model->ICC), 'id', 'name');
        // VarDumper::dump($province_na);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'province_na ' => $province_na
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $province_na = ArrayHelper::map($this->getProvinceNational($model->ICC), 'id', 'name');
        $tempCovenant = $model->ATTRACT_FILE;
        //$tempDocs = $model->DOCS;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTRACT_FILE = $this->uploadSingleFile($model, $tempCovenant);

            if ($model->save()) {
                
            }
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'province_na' => $province_na
            ]);
        }
    }

    public function actionUpdateAjax($id) {
        $model = $this->findModel($id);
        $province_na = ArrayHelper::map($this->getProvinceNational($model->ICC), 'id', 'name');
        $tempCovenant = $model->ATTRACT_FILE;
        //$tempDocs = $model->DOCS;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->REQ_REF);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTRACT_FILE = $this->uploadSingleFile($model, $tempCovenant);

            if ($model->save()) {
                
            }
             return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
                        'province_na' => $province_na
            ]);
        }
    }

    public function actionDeleteAjax($id) {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFileAjax($id) {
        $model = PermitOwner::find()->where(['ID' => $id])->one();
        if ($model->ATTRACT_FILE) {
            $files = Json::decode($model->ATTRACT_FILE);
            foreach ($files as $key => $value) {
                $img = PermitOwner::getUploadUrl() . $model->CAR_ID . '/' . $key;
                $pass2 = '<img class="img-responsive" src="' . $img . '"  />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass2,
        ]);
    }

    protected function findModel($id) {
        if (($model = PermitOwner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJson($id) {
        $model = PermitOwner::find()->where(['ID' => $id])->one();
        $initial = [];
        //var_dump($model->INSURANCE_FILE);
        $files = Json::decode($model->ATTRACT_FILE);
        foreach ($files as $key => $value) {
            $img = PermitOwner::getUploadUrl() . $model->CAR_ID . '/' . $key;
            return $initial[] = '<img src="' . $img . '" height="auto" />';
            // echo $img;
            //return $initial = $key;
        }
    }

    public function actionDeletefile($id, $field, $fileName) {
        $status = ['success' => false];
        if (in_array($field, ['ATTRACT_FILE', 'covenant'])) {
            $model = $this->findModel($id);
            $files = Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->CAR_ID, $fileName)) {
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
                $filePath = PermitOwner::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = PermitOwner::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'ATTRACT_FILE');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(PermitOwner::UPLOAD_FOLDER . '/' . $model->CAR_ID . '/' . $newFileName);
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

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = PermitOwner::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
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

    protected function getProvinceNational2($id) {
        $datas = NationalProvince::find()->where(['id' => $id])->all();
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
    
        private function getInitialPreview($ref) {
        $datas = PermitOwner::find()->where(['REQ_REF' => $ref])->all();
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

}
