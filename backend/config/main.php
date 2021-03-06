<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'category' => [
            'class' => 'backend\modules\category\Module',
        ],
        'attr' => [
            'class' => 'backend\modules\attr\Module',
        ],
        'product' => [
            'class' => 'backend\modules\product\Module',
        ],
        'dictionary' => [
            'class' => 'backend\modules\dictionary\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'category' => 'category/manage/index',
                'category/main-category' => 'category/manage/main-categories',
                'category/subcategory' => 'category/manage/subcategories',
                'category/create' => 'category/manage/create',
                'category/update/<id:\d+>' => 'category/manage/update',
                'category/<id:\d+>' => 'category/manage/view',
                'attribute' => 'attr/manage/index',
                'attribute/create' => 'attr/manage/create',
                'attribute/update/<id:\d+>' => 'attr/manage/update',
                'attribute/<id:\d+>' => 'attr/manage/view',
                'attribute/default-values' => 'attr/attr-default-values/index',
                'attribute/default-values/<id:\d+>' => 'attr/attr-default-values/view',
                'attribute/default-values/create' => 'attr/attr-default-values/create',
                'attribute/default-values/update/<id:\d+>' => 'attr/attr-default-values/update',
                'attribute/default-values/attribute/<id:\d+>' => 'attr/attr-default-values/attr-default-values-view',
                'product' => 'product/manage/index',
                'product/create' => 'product/manage/create',
                'product/update/<id:\d+>' => 'product/manage/update',
                'product/view/<id:\d+>' => 'product/manage/view',
                'product/set-properties/<id:\d+>' => 'product/manage/set-product-properties',
                'product/image/<id:\d+>' => 'product/manage/image',
            ],
        ],
    ],
    'params' => $params,
];
