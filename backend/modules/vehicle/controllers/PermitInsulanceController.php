<?php

namespace backend\modules\vehicle\controllers;

use Yii;
use backend\modules\car\models\PermitInsulance;
use backend\modules\car\models\PermitInsulanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use bupy7\ajaxfilter\AjaxFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;

/**
 * PermitInsulanceController implements the CRUD actions for PermitInsulance model.
 */
class PermitInsulanceController extends Controller {

    /**
     * @inheritdoc
     */
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

    /**
     * Lists all PermitInsulance models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PermitInsulanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermitInsulance model.
     * @param integer $id
     * @return mixed
     */
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
    /**
     * Creates a new PermitInsulance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = new PermitInsulance();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->INSURANCE_FILE = $this->uploadSingleFile($model);
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

   public function actionCreateAjax($id) {
        $model = new PermitInsulance();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            $model->INSURANCE_FILE = $this->uploadSingleFile($model);
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

    public function actionJson($id) {
        $model = PermitInsulance::find()->where(['ID' => $id])->one();
        $initial = [];
        //var_dump($model->INSURANCE_FILE);
        $files = Json::decode($model->INSURANCE_FILE);
        foreach ($files as $key => $value) {
            $img = PermitInsulance::getUploadUrl() . $model->CAR_ID . '/' . $key;
           return $initial[] = '<img src="' . $img . '" height="auto" />';
           // echo $img;
            //return $initial = $key;
        }
    }

    /**
     * Updates an existing PermitInsulance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
   public function actionUpdate($id) {
        $model = $this->findModel($id);
        $tempCovenant = $model->INSURANCE_FILE;
        //$tempDocs = $model->DOCS;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->INSURANCE_FILE = $this->uploadSingleFile($model, $tempCovenant);

            if ($model->save()) {
                
            }
             return $this->redirect(['view', 'id' =>$model->ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }
    
       public function actionUpdateAjax($id) {
        $model = $this->findModel($id);
        $tempCovenant = $model->INSURANCE_FILE;
        //$tempDocs = $model->DOCS;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->CreateDir($model->CAR_ID);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->INSURANCE_FILE = $this->uploadSingleFile($model, $tempCovenant);

            if ($model->save()) {
                
            }
             return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PermitInsulance model.
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

        return $this->redirect(['/vehicle/car-master/view', 'id' => $model->CAR_ID, 'tab_id' => '3']);
    }

    public function actionDeletefile($id, $field, $fileName) {
        $status = ['success' => false];
        if (in_array($field, ['INSURANCE_FILE', 'covenant'])) {
            $model = $this->findModel($id);
            $files = Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->INSURANCE_FILE, $fileName)) {
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
                $filePath = PermitInsulance::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = PermitInsulance::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds the PermitInsulance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermitInsulance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PermitInsulance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'INSURANCE_FILE');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(PermitInsulance::UPLOAD_FOLDER . '/' . $model->CAR_ID . '/' . $newFileName);
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
            $basePath = PermitInsulance::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

}
