<?php

namespace backend\modules\image\controllers;

use Yii;
use backend\modules\image\models\CatalogOption;
use backend\modules\image\models\CatalogOptionSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\base\Model;
use backend\modules\image\models\Image;
use backend\modules\image\models\OptionValue;

/**

 * DynamicformDemo1Controller implements the CRUD actions for CatalogOption model.

 */
class CatalogController extends Controller {

    /**

     * Lists all CatalogOption models.

     * @return mixed

     */
    public function actionIndex() {

        $searchModel = new CatalogOptionQuery();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [

                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**

     * Displays a single CatalogOption model.

     * @param integer $id

     * @return mixed

     */
    public function actionView($id) {

        $model = $this->findModel($id);

        $optionValues = $model->optionValues;


        return $this->render('view', [

                    'model' => $model,
                    'optionValues' => $optionValues,
        ]);
    }

    /**

     * Creates a new CatalogOption model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
    public function actionCreate() {

        $modelCatalogOption = new CatalogOption;

        $modelsOptionValue = [new OptionValue];

        if ($modelCatalogOption->load(Yii::$app->request->post())) {


            $modelsOptionValue = Model::createMultiple(OptionValue::classname());

            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());

            foreach ($modelsOptionValue as $index => $modelOptionValue) {

                $modelOptionValue->sort_order = $index;

                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]img");
            }


            // ajax validation

            if (Yii::$app->request->isAjax) {

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($modelsOptionValue), ActiveForm::validate($modelCatalogOption)
                );
            }


            // validate all models

            $valid = $modelCatalogOption->validate();

            $valid = Model::validateMultiple($modelsOptionValue) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $modelCatalogOption->save(false)) {

                        foreach ($modelsOptionValue as $modelOptionValue) {

                            $modelOptionValue->catalog_option_id = $modelCatalogOption->id;


                            if (($flag = $modelOptionValue->save(false)) === false) {

                                $transaction->rollBack();

                                break;
                            }
                        }
                    }

                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['view', 'id' => $modelCatalogOption->id]);
                    }
                } catch (Exception $e) {

                    $transaction->rollBack();
                }
            }
        }


        return $this->render('create', [

                    'modelCatalogOption' => $modelCatalogOption,
                    'modelsOptionValue' => (empty($modelsOptionValue)) ? [new OptionValue] : $modelsOptionValue
        ]);
    }

    /**

     * Updates an existing CatalogOption model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */
    public function actionUpdate($id) {

        $modelCatalogOption = $this->findModel($id);

        $modelsOptionValue = $modelCatalogOption->optionValues;


        if ($modelCatalogOption->load(Yii::$app->request->post())) {


            $oldIDs = ArrayHelper::map($modelsOptionValue, 'id', 'id');

            $modelsOptionValue = Model::createMultiple(OptionValue::classname(), $modelsOptionValue);

            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsOptionValue, 'id', 'id')));


            foreach ($modelsOptionValue as $index => $modelOptionValue) {

                $modelOptionValue->sort_order = $index;

                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]img");
            }


            // ajax validation

            if (Yii::$app->request->isAjax) {

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($modelsOptionValue), ActiveForm::validate($modelCatalogOption)
                );
            }


            // validate all models

            $valid = $modelCatalogOption->validate();

            $valid = Model::validateMultiple($modelsOptionValue) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $modelCatalogOption->save(false)) {


                        if (!empty($deletedIDs)) {

                            $flag = OptionValue::deleteByIDs($deletedIDs);
                        }


                        if ($flag) {

                            foreach ($modelsOptionValue as $modelOptionValue) {

                                $modelOptionValue->catalog_option_id = $modelCatalogOption->id;

                                if (($flag = $modelOptionValue->save(false)) === false) {

                                    $transaction->rollBack();

                                    break;
                                }
                            }
                        }
                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['view', 'id' => $modelCatalogOption->id]);
                    }
                } catch (Exception $e) {

                    $transaction->rollBack();
                }
            }
        }


        return $this->render('update', [

                    'modelCatalogOption' => $modelCatalogOption,
                    'modelsOptionValue' => (empty($modelsOptionValue)) ? [new OptionValue] : $modelsOptionValue
        ]);
    }

    /**

     * Deletes an existing CatalogOption model.

     * If deletion is successful, the browser will be redirected to the 'index' page.

     * @param integer $id

     * @return mixed

     */
    public function actionDelete($id) {

        $model = $this->findModel($id);

        $optonValuesIDs = ArrayHelper::map($model->optionValues, 'id', 'id');

        OptionValue::deleteByIDs($optonValuesIDs);

        $name = $model->name;


        if ($model->delete()) {

            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }


        return $this->redirect(['index']);
    }

    /**

     * Finds the CatalogOption model based on its primary key value.

     * If the model is not found, a 404 HTTP exception will be thrown.

     * @param integer $id

     * @return CatalogOption the loaded model

     * @throws NotFoundHttpException if the model cannot be found

     */
    protected function findModel($id) {

        if (($model = CatalogOption::findOne($id)) !== null) {

            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
