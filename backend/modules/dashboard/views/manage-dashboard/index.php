<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\modules\dashboard\assets\LayoutAsset;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\DashLayout */

$this->title = 'Manage Dashboard';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
LayoutAsset::register($this);
?>
<div class="dash-layout-view">
    <?= Alert::widget() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'manage_dashboard',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'layout_id')->widget(Select2::classname(), [
        'data' => $layouts,
        'options' => ['placeholder' => Yii::t('dashboard.layout', 'Select a layout')],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            "change" => "function() { jQuery('#manage_dashboard').submit(); }",
        ],
    ])->label('Layout') ?>

    <?php ActiveForm::end(); ?>

    <h2>Dashboar frontend</h2>
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($cells as $cell) : ?>
                <div class="preview col-sm-<?= $cell->span ?>">
                    <?=
                    \yii\helpers\Html::a(Yii::t('dashboard.layout', 'Add widget'), ['add-widget', 'cell_id' => $cell->id], [
                        'class' => 'btn btn-primary btn-sm pull-right ModalTrigger',
                        'data-target' => '#add-widget',
                        'data-toggle' => 'modal',
                        'data-width' => '800',
                    ]);
                    ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>