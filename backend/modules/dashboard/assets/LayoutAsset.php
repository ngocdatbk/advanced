<?php

namespace app\modules\dashboard\assets;

use yii\web\AssetBundle;

class LayoutAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@app/modules/dashboard/assets/dist';

    /**
     * @inheritdoc
     */
    public $js = [
    ];

    public $css = [
        'css/layout.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->publishOptions['forceCopy'] = YII_ENV_DEV;
    }

}