<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\DashCell;
use app\modules\dashboard\models\DashLayout;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DashCellController implements the CRUD actions for DashCell model.
 */
class DashCellController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all DashCell models.
     * @return mixed
     */
    public function actionIndex($layout_id)
    {
        if (!$layout_id) {

        }

        $layoutModel = DashLayout::findOne($layout_id);

        $dataProvider = new ArrayDataProvider([
            'allModels' => DashCell::find()->where(['layout_id' => $layout_id])->orderBy('order')->all(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'layoutModel' => $layoutModel
        ]);
    }

    /**
     * Creates a new DashCell model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($layout_id)
    {
        if (!$layout_id) {

        }

        $layoutModel = DashLayout::findOne($layout_id);
        $model = new DashCell();

        if ($model->load(Yii::$app->request->post())) {
            $model->layout_id = $layout_id;
            $model->save();
            return $this->redirect(['index', 'layout_id' => $layout_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'layoutModel' => $layoutModel
        ]);
    }

    /**
     * Updates an existing DashCell model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $layoutModel = DashLayout::findOne($model->layout_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'layout_id' => $model->layout_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'layoutModel' => $layoutModel
        ]);
    }

    /**
     * Deletes an existing DashCell model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $layout_id = $model->layout_id;
        $model->delete();

        return $this->redirect(['index', 'layout_id' => $layout_id]);
    }

    /**
     * Finds the DashCell model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DashCell the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DashCell::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
