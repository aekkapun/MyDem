<?php

namespace backend\modules\car\controllers;

use Yii;
use backend\modules\car\models\PermitRequest;
use backend\modules\car\models\PermitCar;
use backend\modules\car\models\PermitDriver;
use backend\modules\car\models\PermitInsulance;
use backend\modules\car\models\PermitOwner;
use backend\modules\car\models\Uploads;
use backend\modules\car\models\Model;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use Image;

class LocalCarController extends \yii\web\Controller {

    public function actionIndex() {
        $model = new PermitRequest();
        $modelCar = new PermitCar();
        $model->REQ_REF = $this->getRefCode();

        if ($model->load(Yii::$app->request->post()) && $modelCar->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelCar])) {
            $this->CreateDir($model->REQ_REF);
            $modelCar->ATTACH_FILE = $this->uploadMultipleFile($modelCar);
            if ($model->save()) {
                $this->Uploads(false);
                //$modelCar->REQ_ID = $model->ID;
                $modelCar->REQ_REF = $model->REQ_REF;
                $modelCar->save();
            }
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('index', [
                        'model' => $model,
                        'modelVehicle' => $modelCar
            ]);
        }
    }

    public function actionCreate() {
        $modelRequest = new PermitRequest();
        $model = new PermitCar();

        if ($model->load(Yii::$app->request->post()) && $modelRequest->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelRequest])) {

            $this->Uploads(false);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->IMAGE_REF = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }

        return $this->render('index', [
                    'model' => $modelRequest,
                    'modelVehicle' => $model
        ]);
    }

    public function actionMasterInfo($id) {
        $model = new PermitRequest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['master-info', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findRequest($id),
        ]);
    }

    protected function findRequest($id) {
        if (($model = PermitRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // generate ref_code
    public function getRefCode() {
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

    // upload ไฟล์เดียว
    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'docs');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(PermitCar::UPLOAD_FOLDER . '/' . $model->REQ_REF . '/car/' . $newFileName);
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

    // Start Upload Ajax

    public function actionUploadAjax() {
        $this->Uploads(true);
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = PermitCar::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(PermitCar::getUploadPath() . $dir);
    }

    private function Uploads($isAjax = false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $PhotoLibrary = Yii::$app->request->post('PermitCar');
                    $ref = $PhotoLibrary['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = PermitCar::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
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
                'url' => Url::to(['/car/car-local/deletefile-ajax']),
                'key' => $value->upload_id
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath) {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model) {
        $filePath = PermitCar::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
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
        $uploadPath = PermitCar::getUploadPath() . '/' . $folderName . '/';
        $file = $uploadPath . $fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax() {

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename = PermitCar::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = PermitCar::getUploadPath() . $model->ref . '/thumbnail/' . $model->real_filename;
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

}
