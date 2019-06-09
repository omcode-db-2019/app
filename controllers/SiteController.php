<?php

namespace app\controllers;

use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $items = [
            [
                'latitude' => 52.906386,
                'longitude' => 59.954092,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#icon',
                        'iconColor' => '#19a111'
                    ]
                ]
            ],
            [
                'latitude' => 55.751812,
                'longitude' => 37.599292,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#circleIcon',
                        'iconColor' => '#19aa8d',
                        'draggable' => true
                    ]
                ]
            ],
            [
                'latitude' => 47.250534,
                'longitude' => 39.682889,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#blueCircleDotIconWithCaption',
                        'iconColor' => '#19aa8d'
                    ]
                ]
            ],
            [
                'latitude' => 58.091523,
                'longitude' => 57.805861,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#redSportIcon',
                        'iconColor' => '#19aa8d'
                    ]
                ]
            ],
            [
                'latitude' => 60.091523,
                'longitude' => 75.805861,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#governmentCircleIcon',
                        'iconColor' => '#3b5998'
                    ]
                ]
            ],
        ];
        return $this->render('index', ['items' => $items]);
    }
}
