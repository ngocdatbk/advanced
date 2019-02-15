<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\DashCell */

$this->title = 'Create Cell';
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['/dashboard/dash-layout']];
$this->params['breadcrumbs'][] = ['label' => $layoutModel->name, 'url' => ['/dashboard/dash-layout/view', 'id' => $layoutModel->id]];
$this->params['breadcrumbs'][] = ['label' => 'Cells', 'url' => ['index', 'layout_id' => $layoutModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dash-cell-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
