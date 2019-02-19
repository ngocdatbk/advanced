<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\Dashboard;
use app\modules\dashboard\models\DashLayout;
use app\modules\dashboard\models\DashCell;
use app\modules\dashboard\models\Widget;
use yii\data\ArrayDataProvider;
use common\components\Controller;
use yii\db\Exception;
use yii\helpers\Json;


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

    public function actionSelectWidget($cell_id, $project_id)
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => Widget::find()->all(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->renderAjax('select_widget', [
            'dataProvider' => $dataProvider,
            'cell_id' => $cell_id,
            'project_id' => $project_id
        ]);
    }

    public function actionAddWidget($widget_id, $cell_id, $project_id)
    {
        $dashboardModel = new Dashboard();
        $dashboardModel->widget_id = $widget_id;
        $dashboardModel->user_id = Yii::$app->user->id;
        $dashboardModel->cell_id = $cell_id;
        $dashboardModel->project_id = $project_id;
        $dashboardModel->order = Dashboard::find()
        ->where([
            'user_id' => Yii::$app->user->id,
            'project_id' => $project_id,
            'cell_id' => $cell_id
        ])
        ->max('dashboard.order') + 1;

        if ($dashboardModel->save()) {
            Yii::$app->session->setFlash('success', 'Add widget success!');
        } else {
            Yii::$app->session->setFlash('error', 'Add widget unsuccess!');
        }

        return $this->redirect(['/dashboard/manage-dashboard/index']);
    }

    public function actionDeleteWidget($dasboard_id)
    {
        if (Dashboard::findOne($dasboard_id)->delete()) {
            Yii::$app->session->setFlash('success', 'Delete widget success!');
        } else {
            Yii::$app->session->setFlash('error', 'Delete widget unsuccess!');
        }

        return $this->redirect(['/dashboard/manage-dashboard/index']);
    }

    public function actionSortWidget()
    {
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $cur_dasboard_id = $data['cur_dasboard_id'];
            $next_dasboard_id = $data['next_dasboard_id'];

            $transaction = Yii::$app->getDb()->beginTransaction();
            try {
                $model = Dashboard::findOne($cur_dasboard_id);
                $display_before = 0;
                if ($next_dasboard_id) {
                    $model_next = Dashboard::findOne($next_dasboard_id);
                    $display_before = $model_next->order;
                } else {
                    $display_before = Dashboard::find()
                            ->where([
                                'user_id' => Yii::$app->user->id,
                                'project_id' => $model->project_id,
                                'cell_id' =>  $model->cell_id
                            ])
                            ->max('dashboard.order') + 1;
                }

                if ($model->order < $display_before) {
                    Dashboard::updateAllCounters(
                        ['order' => -1],
                        [
                            'AND',
                            ['cell_id' => $model->cell_id, 'project_id' => $model->project_id, 'user_id' => Yii::$app->user->id],
                            ['>', 'order', $model->order],
                            ['<', 'order', $display_before],
                        ]
                    );
                    $model->order = $display_before-1;
                } elseif ($model->order > $display_before) {
                    Dashboard::updateAllCounters(
                        ['order' => 1],
                        [
                            'AND',
                            ['cell_id' => $model->cell_id, 'project_id' => $model->project_id, 'user_id' => Yii::$app->user->id],
                            ['>=', 'order', $display_before],
                            ['<', 'order', $model->order],
                        ]
                    );
                    $model->order = $display_before;
                } else {
                    Dashboard::updateAllCounters(
                        ['order' => 1],
                        [
                            'AND',
                            ['cell_id' => $model->cell_id, 'project_id' => $model->project_id, 'user_id' => Yii::$app->user->id],
                            ['>=', 'order', $display_before],
                            ['!=', 'id', $model->id]
                        ]
                    );
                }

                $model->save();
                $transaction->commit();
                return Json::encode('success');
            } catch (Exception $e) {
                $transaction->rollBack();
                return Json::encode('fail');
            }
        }
    }
}
