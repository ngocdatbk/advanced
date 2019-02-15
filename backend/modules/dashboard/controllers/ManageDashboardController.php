<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\DashLayout;
use app\modules\dashboard\models\DashCell;
use app\modules\dashboard\models\Widget;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * DashLayoutController implements the CRUD actions for DashLayout model.
 */
class ManageDashboardController extends Controller
{

    /**
     * Lists all DashLayout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Yii::$app->user->identity;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Change layout success!');
        }

        $layouts = DashLayout::getAllLayouts();

        $cells = array();
        if ($model->layout_id) {
            $cells = DashCell::find()->where(['layout_id' => Yii::$app->user->identity->layout_id])->orderBy('order')->all();
        }

        return $this->render('index', [
            'model' => $model,
            'layouts' => $layouts,
            'cells' => $cells
        ]);
    }

    public function actionAddWidget($cell_id)
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => Widget::find()->all(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->renderAjax('add_widget', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
