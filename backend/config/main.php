<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => 'en',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
//            'identityCookie' => [
//                'name' => '_backendIdentity',
//                'path' => '/admin',
//                'httpOnly' => true,
//            ],
        ],
//        'session' => [
//            'name' => 'BACKENDSESSID',
//            'cookieParams' => [
//                'httpOnly' => true,
//                'path' => '/admin',
//            ],
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
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
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/car-project/frontend/web',
            'scriptUrl' => '/car-project/frontend/web/index.php',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'site/font',
            'api',
            'admin/*',
            'user/*',
            'gii/*',
            'debug/*',
            'master/*',
            'car/*',
            'image/*',
            'vehicle/*'
        // 'configuration/*'
        ]
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation' => false,
            'cost' => 12,
            'admins' => ['aekkapun']
        ],
        'vehicle' => [
            'class' => 'backend\modules\vehicle\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    //'userClassName' => 'app\models\User', 
// fully qualified class name of your User model
// Usually you don 't need to specify it explicitly, since the module will detect it automatically
                    'idField' => 'id ', // id field of your User model that corresponds to Yii::$app->user->id
                    'usernameField' => 'username',
                // username field of your User model
//'searchClass' => 'app\models\UserSearch'    // fully qualified class name of your User model for searching
                ]
            ],
            'layout' => 'left-menu',
        ],
        'master' => [
            'class' => 'backend\modules\master\Module',
        ],
        'dlt' => [
            'class' => 'backend\modules\dlt\Module',
        ],
        'car' => [
            'class' => 'backend\modules\car\Module',
        ],
        'image' => [
            'class' => 'backend\modules\image\Module',
        ],
    ],
    'params' => $params,
];
