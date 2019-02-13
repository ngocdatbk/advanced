<?php

/* @var $this yii\web\View */
$this->title = 'Dashboards';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= app\modules\report\widgets\ListOrders::widget() ?>
