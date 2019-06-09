<?php

namespace app\controllers;

use app\models\Message;
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
        $messages = Message::find()->limit(100)->all();
        $items = [];
        foreach ($messages as $message) {
            $items[] = [
                'latitude' => $message->latitude,
                'longitude' => $message->longitude,
                'options' => [
                    [
                        'hintContent' => $message->problem,
                        'balloonContentHeader' => $message->problem,
                        'balloonContentBody' => $message->comments,
                        'balloonContentFooter' => '',
                    ],
                    [
                        'preset' => 'islands#circleIcon',
                        'iconColor' => '#19a111',
                    ]
                ]
            ];
        }
        foreach ($stations as $station) {
            $items[] = [
                'latitude' => $station->latitude,
                'longitude' => $station->longitude,
                'options' => [
                    [
                        'hintContent' => $station->name,
//                        'balloonContentHeader' => '',
//                        'balloonContentBody' => '',
//                        'balloonContentFooter' => '',
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
