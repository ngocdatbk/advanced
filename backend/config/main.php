<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Saotruc',
    'homeUrl' => '/admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'dashboard/dashboard',
    'layout' => 'admin_vertical',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'report' => [
            'class' => 'app\modules\report\Module',
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\Module',
        ],
        'email' => [
            'class' => 'app\modules\email\Module',
        ],
        'cronjob' => [
            'class' => 'app\modules\cronjob\Module',
        ],
        'setting' => [
            'class' => 'app\modules\setting\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'permission' => [
            'class' => 'app\modules\permission\Module',
        ],
        'core' => [
            'class' => 'app\modules\core\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
            'csrfCookie' => [
                'httpOnly' => true,
                'path' => '/admin',
            ],
        ],
        'user' => [
            'class' => 'common\components\User',
            'loginUrl' => '/admin/user/auth/login',
            'returnUrlParam' => '/admin/dashboard/dashboard',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'path' => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'cookieParams' => [
                'path' => '/admin',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'hostInfo' => 'http://saotruc.com',
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
