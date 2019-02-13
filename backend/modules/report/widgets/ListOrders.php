<?php

namespace app\modules\report\widgets;

use Yii;
use yii\base\Widget;
use yii\data\ArrayDataProvider;
use app\modules\report\models\OrderSearch;

class ListOrders extends Widget
{

    // @Inherit
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['report.*'])) {
            Yii::$app->i18n->translations['report.*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en_US',
                'basePath' => __DIR__ . '/../messages',
            ];
        }
    }

    // Render Widget View
    public function run()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list-order', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}