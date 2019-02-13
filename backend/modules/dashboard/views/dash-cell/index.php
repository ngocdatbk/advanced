<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dash Cells';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dash-cell-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dash Cell', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'layout_id',
            'order',
            'span',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
