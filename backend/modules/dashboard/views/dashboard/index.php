<?php

use app\modules\dashboard\assets\LayoutAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Dashboards';
$this->params['breadcrumbs'][] = $this->title;
LayoutAsset::register($this);
?>

<div class="container-fluid">
    <div class="row">
        <?php foreach ($cells as $cell) : ?>
            <?php $widgets = $cell->getWidgets('frontend'); ?>
            <?php if (count($widgets) > 0) : ?>
            <div class="preview col-sm-<?= $cell->span ?>">
                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($widgets as $widget) : ?>
                            <div class="widget col-sm-12" data-dasboard_id="<?= $widget['dasboard_id'] ?>">
                                <div class="">
                                    <?= (new $widget['class']())->widget(); ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>
