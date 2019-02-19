<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\DashCell;

class DashboardController extends \common\components\Controller
{
    public function actionIndex()
    {
        $model = Yii::$app->user->identity;

        $cells = array();
        if ($model->layout_id) {
            $cells = DashCell::find()->where(['layout_id' => Yii::$app->user->identity->layout_id])->orderBy('order')->all();
        }

        return $this->render('index', [
            'model' => $model,
            'cells' => $cells
        ]);
    }

}
