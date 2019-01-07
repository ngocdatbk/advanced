<?php

namespace app\modules\email\controllers;

class EmailQueueController extends \common\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
