<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\dashboard\assets\LayoutAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cells';
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['/dashboard/dash-layout']];
$this->params['breadcrumbs'][] = ['label' => $layoutModel->name, 'url' => ['/dashboard/dash-layout/view', 'id' => $layoutModel->id]];
$this->params['breadcrumbs'][] = $this->title;
LayoutAsset::register($this);
?>
<div class="dash-cell-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cell', ['create', 'layout_id' => $layoutModel->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'order',
            'span',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model,$key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
                            'title' => Yii::t('app.global', 'update'),
                        ]);
                    },
                    'delete' => function ($url, $model,$key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'title' => Yii::t('app.global', 'delete'),
                            'data' => [
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'options' => ['width' => '50px']
            ],
        ],
    ]); ?>
</div>

<h2>Preview Layout</h2>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($dataProvider->getModels() as $cell) : ?>
            <div class="preview col-sm-<?= $cell->span ?>"><?= $cell->name ?></div>
        <?php endforeach ?>
    </div>
</div>
