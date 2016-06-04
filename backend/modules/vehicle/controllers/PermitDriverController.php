<?php

namespace backend\modules\vehicle\controllers;

use Yii;
use backend\modules\vehicle\models\PermitDriver;
use backend\modules\vehicle\models\PermitDriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/**
 * PermitDriverController implements the CRUD actions for PermitDriver model.
 */
class PermitDriverController extends Controller {

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
     * Lists all PermitDriver models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PermitDriverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermitDriver model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewAjax($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PermitDriver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new PermitDriver();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->ID]);
//        } else {
//            return $this->render('create', [
//                        'model' => $model,
//            ]);
//        }
//    }
    public function actionCreateAjax($id) {
        $model = new PermitDriver();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTACHFILE_PASSPORT = $this->uploadSingleFile($model);
            $model->ATTACHFILE_DRIVERLC = $this->uploadMultipleFile($model);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 10000,
                    'icon' => 'fa fa-newspaper-o',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย',
                    'title' => 'การบันทึกข้อมูล',
                ]);
                return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
            }
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCreate() {
        $model = new PermitDriver();
        $model->CAR_ID = 12;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTACHFILE_PASSPORT = $this->uploadSingleFile($model);
            $model->ATTACHFILE_DRIVERLC = $this->uploadMultipleFile($model);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 10000,
                    'icon' => 'fa fa-newspaper-o',
                    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย',
                    'title' => 'การบันทึกข้อมูล',
                ]);
                return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID . '#driver']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PermitDriver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $tempCovenant = $model->ATTACHFILE_PASSPORT;
        $tempDocs = $model->ATTACHFILE_DRIVERLC;
        if ($model->load(Yii::$app->request->post())) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTACHFILE_PASSPORT = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTACHFILE_DRIVERLC = $this->uploadMultipleFile($model, $tempDocs);
            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->ID]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdateAjax($id) {
        $model = $this->findModel($id);
        $tempCovenant = $model->ATTACHFILE_PASSPORT;
        $tempDocs = $model->ATTACHFILE_DRIVERLC;
        if ($model->load(Yii::$app->request->post())) {
            $this->CreateDir($model->CAR_ID);
            $model->ATTACHFILE_PASSPORT = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTACHFILE_DRIVERLC = $this->uploadMultipleFile($model, $tempDocs);
            if ($model->save()) {

                return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
            }
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PermitDriver model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAjax($id) {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
    }

    /**
     * Finds the PermitDriver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermitDriver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PermitDriver::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJson($id) {
        $model = PermitDriver::find()->where(['ID' => $id])->one();
        if ($model->ATTACHFILE_PASSPORT) {
            $files = Json::decode($model->ATTACHFILE_PASSPORT);
            foreach ($files as $key => $value) {
                $img = PermitDriver::getUploadUrl() . $model->CAR_ID . '/' . $key;
                return $pass = '<img src="' . $img . '" height="auto" />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass2,
        ]);
    }

    public function actionJsonDrl($id) {
        $model = PermitDriver::find()->where(['ID' => $id])->one();
        if ($model->ATTACHFILE_DRIVERLC) {
            $files = Json::decode($model->ATTACHFILE_DRIVERLC);
            foreach ($files as $key => $value) {
                $img = PermitDriver::getUploadUrl() . $model->CAR_ID . '/' . $key;
                return $pass2 = '<img src="' . $img . '" height="auto" />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass2,
        ]);
    }

    public function actionFileAjax($id) {
        $model = PermitDriver::find()->where(['ID' => $id])->one();
        if ($model->ATTACHFILE_DRIVERLC) {
            $files = Json::decode($model->ATTACHFILE_DRIVERLC);
            foreach ($files as $key => $value) {
                $img = PermitDriver::getUploadUrl() . $model->CAR_ID . '/' . $key;
                $pass2 = '<img class="img-responsive" src="' . $img . '"  />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass2,
        ]);
    }

    public function actionPassAjax($id) {
        $model = PermitDriver::find()->where(['ID' => $id])->one();
        if ($model->ATTACHFILE_PASSPORT) {
            $files = Json::decode($model->ATTACHFILE_PASSPORT);
            foreach ($files as $key => $value) {
                $img = PermitDriver::getUploadUrl() . $model->CAR_ID . '/' . $key;
                $pass = '<img class="img-responsive" src="' . $img . '" height="auto" />';
            }
        }
        return $this->renderAjax('file-ajax', [
                    'pass2' => $pass,
        ]);
    }

    public function actionDeletefile($id, $field, $fileName) {
        $status = ['success' => false];
        if (in_array($field, ['ATTACHFILE_DRIVERLC', 'ATTACHFILE_PASSPORT'])) {
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
                $filePath = PermitDriver::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = PermitDriver::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    public function actionDownload($id, $file, $file_name) {
        $model = $this->findModel($id);
        if (!empty($model->ref) && !empty($model->covenant)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->ref . '/' . $file, $file_name);
        } else {
            $this->redirect(['/freelance/view', 'id' => $id]);
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
            $UploadedFile = UploadedFile::getInstance($model, 'ATTACHFILE_PASSPORT');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(PermitDriver::UPLOAD_FOLDER . '/' . $model->CAR_ID . '/' . $newFileName);
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
        $UploadedFiles = UploadedFile::getInstances($model, 'ATTACHFILE_DRIVERLC');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(PermitDriver::UPLOAD_FOLDER . '/' . $model->CAR_ID . '/' . $newFileName);
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

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = PermitDriver::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(PermitDriver::getUploadPath() . $dir);
    }

}
