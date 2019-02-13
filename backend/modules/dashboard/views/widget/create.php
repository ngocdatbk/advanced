<?php

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\widget */

$this->title = Yii::t('dashboard.global', 'Create Widget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('dashboard.global', 'Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row widget-create">
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
