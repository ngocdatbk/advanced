<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\dashboard\models\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('dashboard.global', 'Widgets');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row widget-index">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?= Html::a(Yii::t('dashboard.global', 'Create Widget'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
                'columns' => [
					[
						'class' => 'yii\grid\CheckboxColumn',
						'options' => ['style' => 'width:30px;'],
					],

                    'name',
                    'class',

					[
						'class' => 'yii\grid\ActionColumn',
						'options' => ['style' => 'width:65px;'],
						'contentOptions' => ['class' => 'text-center'],
					],
				],
				'options' => ['class' => 'grid-view table-responsive'],
				'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
			]); ?>
			
            </div>
        </div>
    </div>
</div>
