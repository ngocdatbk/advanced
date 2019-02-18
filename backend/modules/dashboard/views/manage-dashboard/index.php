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
                    <?php $widgets = $cell->getWidgets('frontend'); ?>
                    <div class="container-fluid">
                        <div class="row" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <?php foreach ($widgets as $widget) : ?>
                            <div class="widget col-sm-12" draggable="true" ondragstart="drag(event)" id="<?= $widget['widget_id'] ?>">
                                <div class="widget-content">
                                    <div class="widget-content-left"><?= $widget['name'] ?></div>
                                    <div class="widget-content-right">
                                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-widget', 'dasboard_id' => $widget['dasboard_id']], [
                                            'title' => Yii::t('app.global', 'delete'),
                                            'data' => [
                                                'confirm' => Yii::t('app.global', 'Are you sure you want to delete this widget?'),
                                                'method' => 'post',
                                            ],
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                            <div class="widget col-sm-12">
                                <?=
                                \yii\helpers\Html::a(Yii::t('dashboard.layout', 'Add widget'), ['select-widget', 'cell_id' => $cell->id, 'project_id' => 'frontend'], [
                                    'class' => 'btn btn-primary btn-sm pull-center ModalTrigger',
                                    'data-target' => '#add-widget',
                                    'data-toggle' => 'modal',
                                    'data-width' => '800',
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>