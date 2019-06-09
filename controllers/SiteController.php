<?php

namespace app\controllers;

use app\models\Measurement;
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
        $stationIds = Station::find('id')->where(['service_id' => 1])->asArray()->column();
        $measurements = Measurement::find()->joinWith('station')->where(['station_id' => $stationIds])->orderBy('date')->all();


//        $messages = Message::find()->limit(100)->all();
//        $items = [];
//        foreach ($messages as $message) {
//            $items[] = [
//                'latitude' => $message->latitude,
//                'longitude' => $message->longitude,
//                'options' => [
//                    [
//                        'hintContent' => $message->problem,
//                        'balloonContentHeader' => $message->problem,
//                        'balloonContentBody' => $message->comments,
//                        'balloonContentFooter' => '',
//                    ],
//                    [
//                        'preset' => 'islands#circleIcon',
//                        'iconColor' => '#19a111',
//                    ]
//                ]
//            ];
//        }
        $color = '#00FF00';
        foreach ($measurements as $measurement) {
            $aqi = $measurement->aqi;
            if ($aqi >= 0 && $aqi <= 50) {
                $color = '#00FF00';
            }

            if ($aqi >= 51 && $aqi <= 100) {
                $color = '#88FF00';
            }
            // AQI Level: Unhealthy for sensitive groups
            if ($aqi >= 101 && $aqi <= 150) {
                $color = '#FFFF00';
            }
            // AQI Level: Unhealthy
            if ($aqi >= 151 && $aqi <= 200) {
                $color = '#FF7700';
            }
            // AQI Level: Very unhealthy
            if ($aqi >= 201 && $aqi <= 300) {
                $color = '#FF3300';
            }
            // AQI Level: Hazardous
            if ($aqi >= 300) {
                $color = '#FF0000';
            }
            $items[] = [
                'latitude' => $measurement->station->latitude,
                'longitude' => $measurement->station->longitude,
                'options' => [
                    [
                        'hintContent' => $measurement->station->name,
//                        'balloonContentHeader' => 'a',
                        'balloonContentBody' => $measurement->date,
//                        'balloonContentFooter' => 's',
                    ],
                    [
                        'preset' => 'islands#icon',
                        'iconColor' => $color,
                    ]
                ]
            ];
        }
        return $this->render('index', ['items' => $items]);
    }
}
