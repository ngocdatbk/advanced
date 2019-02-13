<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\DashCell */

$this->title = 'Create Dash Cell';
$this->params['breadcrumbs'][] = ['label' => 'Dash Cells', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dash-cell-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
