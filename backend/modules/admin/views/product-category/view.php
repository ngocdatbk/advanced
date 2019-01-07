<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => \Yii::t("admin.product_category",'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(\Yii::t("app.global",'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= $model->deleted_f?
                Html::a(\Yii::t("app.global",'Revert'), ['revert', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => Yii::t('app.global', 'Are you sure you want to revert this item?'),
                        'method' => 'post',
                    ],
                ])
            :
                Html::a(\Yii::t("app.global",'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app.global', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            [
                'attribute' => 'deleted_f',
                'value' => function ($model){
                    if($model->deleted_f)
                        return \Yii::t("app.global",'Deleted');
                    else
                        return '--';
                }
            ],
        ],
    ]) ?>

</div>
