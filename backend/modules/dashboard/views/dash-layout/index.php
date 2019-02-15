<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\dashboard\assets\LayoutAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layouts';
$this->params['breadcrumbs'][] = $this->title;
LayoutAsset::register($this);
?>
<div class="dash-layout-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Layout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($dataProvider->getModels() as $layout) : ?>
            <div class="col-sm-4">
                <div class="container-fluid layout">
                    <div class="row layout-header">
                        <div class="col-sm-6 layout-header-left">
                            <?= $layout->name ?>
                        </div>
                        <div class="col-sm-6 layout-header-right">
                            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $layout->id], [
                                'title' => Yii::t('app.global', 'view'),
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $layout->id], [
                                'title' => Yii::t('app.global', 'update'),
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $layout->id], [
                                'title' => Yii::t('app.global', 'delete'),
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-th-large"></span>', ['/dashboard/dash-cell', 'layout_id' => $layout->id], [
                                'title' => Yii::t('app.global', 'Cells'),
                            ]); ?>
                        </div>
                    </div>
                    <div class="row layout-body">
                        <?php if ($layout->cells) : ?>
                            <?php foreach($layout->cells as $cell) : ?>
                                <div class="preview col-sm-<?= $cell->span ?>"><?= $cell->name ?></div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>