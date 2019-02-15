<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\dashboard\assets\LayoutAsset;

/* @var $this yii\web\View */
/* @var $model app\modules\dashboard\models\DashLayout */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
LayoutAsset::register($this);
?>
<div class="dash-layout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Cells', ['/dashboard/dash-cell', 'layout_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="container-fluid">
        <div class="row">
            <?php foreach ($cells as $cell) : ?>
                <div class="preview col-sm-<?= $cell->span ?>"><?= $cell->name ?></div>
            <?php endforeach ?>
        </div>
    </div>

</div>