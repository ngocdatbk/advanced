<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\widget */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('dashboard.global', 'Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row widget-view">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?= Html::a(Yii::t('dashboard.global', 'Update'), ['update', 'id' => $model->widget_id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a(Yii::t('dashboard.global', 'Delete'), ['delete', 'id' => $model->widget_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('dashboard.global', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>
            <div class="box-body">

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'class',
                    ],
                ])
                ?>

            </div>
        </div>
    </div>
</div>
