<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\DashCell */

$this->title = 'Update Cell: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['/dashboard/dash-layout']];
$this->params['breadcrumbs'][] = ['label' => $layoutModel->name, 'url' => ['/dashboard/dash-layout/view', 'id' => $layoutModel->id]];
$this->params['breadcrumbs'][] = ['label' => 'Cells', 'url' => ['index', 'layout_id' => $layoutModel->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dash-cell-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
