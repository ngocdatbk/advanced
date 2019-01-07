<?php

namespace console\controllers;

abstract class CronAbstractController extends \yii\console\Controller
{
    abstract public function execute();
}
