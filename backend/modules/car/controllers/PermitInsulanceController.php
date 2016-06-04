<?php

namespace backend\modules\car\controllers;

use Yii;
use backend\modules\car\models\PermitInsulance;
use backend\modules\car\models\PermitInsulanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
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
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PermitInsulance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PermitInsulance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PermitInsulance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->ID]);
//        } else {
//            return $this->renderAjax('update', [
//                        'model' => $model,
//            ]);
//        }
//    }
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
             return $this->redirect(['view', 'id' =>$model->ID, '#' => 'home']);
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

    public function actionViewAjax($id) {
//$modelsDriver = Drivers::find()->where(['appilcant_id' => $id])->all();
        $modelsDriver = new ActiveDataProvider([
            'query' => PermitInsulance::find()->where(['appilcant_id' => $id]),
        ]);
        $model = Temporarypermit::findOne(['id' => $id]);
        return $this->renderPartial('view-ajax', [
                    'model' => $model,
                    'modelsDriver' => $modelsDriver,
        ]);
    }

    public function actionCreateAjax($id) {
        $model = new PermitInsulance();
        $model->CAR_ID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->renderPartial('create', [
                        'model' => $model,
            ]);
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
