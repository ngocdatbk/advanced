<?php

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\widget */

$this->title = Yii::t('dashboard.global', 'Update {modelClass}: ', [
    'modelClass' => 'Widget',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('dashboard.global', 'Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->widget_id]];
$this->params['breadcrumbs'][] = Yii::t('dashboard.global', 'Update');
?>

<div class="row widget-update">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">

                <?= $this->render('_form', [
                'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
