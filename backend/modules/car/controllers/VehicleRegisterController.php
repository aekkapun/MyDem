<?php

namespace backend\modules\car\controllers;

use Yii;
use backend\modules\car\models\PermitCar;
use backend\modules\car\models\PermitCarSearch;
use backend\modules\car\models\Vehicle;
use backend\modules\car\models\Uploads;
use backend\modules\car\models\PermitRequest;
use backend\modules\car\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class VehicleRegisterController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new PermitCarSearch();
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

    public function actionCreate() {
        $model = new Vehicle();
        $modelRequest = new PermitRequest();

        if ($model->load(Yii::$app->request->post()) && $modelRequest->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelRequest])) {

            $this->CreateDir($model->IMAGE_REF);
            $model->ATTACH_FILE = $this->uploadMultipleFile($model);
            $this->Uploads(false);

            if ($model->save()) {
                $modelRequest->CAR = $model->ID;
                $modelRequest->REQ_REF = $model->REQ_REF;
                $modelRequest->save();

                echo \yii2mod\alert\Alert::widget([
                    'type' => \yii2mod\alert\Alert::TYPE_SUCCESS,
                    'options' => [
                        'title' => 'Success message',
                        'text' => "You will not be able to recover this imaginary file!",
                        'confirmButtonText' => "Yes, delete it!",
                        'cancelButtonText' => "No, cancel plx!"
                    ]
                ]);

                return $this->redirect(['view', 'id' => $model->ID]);
            }
        } else {
            $model->IMAGE_REF = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        //$tempCovenant = $model->covenant;
        $tempDocs = $model->ATTACH_FILE;
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->IMAGE_REF);

        if ($model->load(Yii::$app->request->post())) {
            $this->CreateDir($model->IMAGE_REF);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->ATTACH_FILE = $this->uploadMultipleFile($model, $tempDocs);
            $this->Uploads(false);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    public function actionDelete($id) {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->IMAGE_REF);
        Uploads::deleteAll(['ref' => $model->IMAGE_REF]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhotoLibrary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhotoLibrary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vehicle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelRequest($id) {
        if (($model = PermitRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // Generate OrderNumber
    public function getReqRef() {
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

    /* |*********************************************************************************|
      |================================ Upload Ajax ====================================|
      |*********************************************************************************| */

    public function actionUploadAjax() {
        $this->Uploads(true);
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = Vehicle::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(Vehicle::getUploadPath() . $dir);
    }

    private function Uploads($isAjax = false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $PhotoLibrary = Yii::$app->request->post('Vehicle');
                    $ref = $PhotoLibrary['IMAGE_REF'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = Vehicle::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
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
                'url' => Url::to(['/car/vehicle-register/deletefile-ajax']),
                'key' => $value->upload_id
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath) {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model) {
        $filePath = Vehicle::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
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
        $uploadPath = Vehicle::getUploadPath() . '/' . $folderName . '/';
        $file = $uploadPath . $fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax() {

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename = Vehicle::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = Vehicle::getUploadPath() . $model->ref . '/thumbnail/' . $model->real_filename;
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
                $UploadedFile->saveAs(Vehicle::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
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
                    $file->saveAs(Vehicle::UPLOAD_FOLDER . '/' . $model->IMAGE_REF . '/' . $newFileName);
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
                if ($this->deleteFile('file', $model->IMAGE_REF, $fileName)) {
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
                $filePath = Vehicle::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = Vehicle::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

}
