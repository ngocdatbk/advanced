<?php

namespace app\modules\dashboard\controllers;

class DashboardController extends \common\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
