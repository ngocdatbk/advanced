<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(['id' => 'contacts', 'enablePushState' => false, 'timeout' => 2000]); ?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title">Add contact</h4>
</div>
<div class="modal-body">
	<div class="row contact-view">
		<div class="col-md-12">
			<div class="box no-border">
				<div class="box-body">
					<div class="hidden" id="errors"></div>
					<div class="text-center hidden process-loading">
						<img src="images/ajaxload.info_000000_facebook.gif" alt=""> Ðang xử lý
					</div>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'grid-contacts',
                        'columns' => [
                            'name',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{add}',
                                'buttons' => [
                                    'add' => function ($url, $model,$key) use ($cell_id, $project_id)  {
                                        return Html::a('<span class="btn btn-primary">Add widget</span>', ['add-widget', 'widget_id' => $model->widget_id, 'cell_id' => $cell_id, 'project_id' => $project_id], [
                                            'title' => Yii::t('app.global', 'Cells'),
                                        ]);
                                    }
                                ],
                                'options' => [
                                    'width' => '150px',
                                    'text-align' => 'right'
                                ]
                            ],
                        ],
                    ]);
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('dashboard.layout', 'Close') ?></button>
</div>
<?php \yii\widgets\Pjax::end() ?>