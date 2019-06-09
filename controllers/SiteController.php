<?php

namespace app\controllers;

use app\models\Station;
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
        $stations = Station::findAll(['service_id' => 1]);
        $items = [];
        foreach ($stations as $station) {
            $items[] = [
                'latitude' => $station->latitude,
                'longitude' => $station->longitude,
                'options' => [
                    [
                        'hintContent' => 'Подсказка при наведении на маркет',
                        'balloonContentHeader' => 'Заголовок после нажатия на маркер',
                        'balloonContentBody' => 'Контент после нажатия на маркер',
                        'balloonContentFooter' => 'Футер после нажатия на маркер',
                    ],
                    [
                        'preset' => 'islands#icon',
                        'iconColor' => '#19a111',
                    ]
                ]
            ];
        }
        return $this->render('index', ['items' => $items]);
    }
}
