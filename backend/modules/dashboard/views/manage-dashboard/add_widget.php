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
                            [
                                'attribute' => 'name',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return html::a($model->name, Url::to(['contact/view', 'id' => $model->contact_id]), ['target' => '_blank']);
                                }
                            ],
                            [
                                'label' => Yii::t('crm.lead', 'Demand status'),
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::dropDownList('demand_status_'. $model->contact_id , null, ArrayHelper::getValue(Yii::$app->controller->module->params, 'demand_status'),['id'=>'demand_status_'. $model->contact_id, 'class' => 'form-control input-sm col-lg-*']);
                                },
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
	<?= Html::button('Luu', ['class' => 'btn btn-success', 'onclick' => 'selectLeadContact(this, "#grid-contacts", '.$model->lead_id.')']) ?>
	<button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('crm.global', 'Close') ?></button>
</div>
<?php \yii\widgets\Pjax::end() ?>