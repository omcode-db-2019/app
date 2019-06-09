<?php

namespace app\controllers;

use app\models\Company;
use app\models\Measurement;
use app\models\Message;
use app\models\Station;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
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
        $stationIds = Station::find()->where(['service_id' => 1])->asArray()->column();
        $measurements = Measurement::find()
            ->joinWith('station')
            ->where(['station_id' => $stationIds])
            ->orderBy('date')
            ->limit(count($stationIds))->all();


        // Complaints
        $messages = Message::find()->all();
        $items = [];
        foreach ($messages as $message) {
            $items[] = [
                'latitude' => $message->longitude,
                'longitude' => $message->latitude,
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
//var_dump($messages);
        // Ecodata.
        $color = '#00FF00';
        $items = [];
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
        $items = array_merge($items, $this->buildCompanyItems());
        return $this->render('index', ['items' => $items]);
    }

    private function buildCompanyItems()
    {
        $items = [];
        $companies = Company::find()->all();
        foreach ($companies as $company) {
            $items[] = [
                'latitude' => $company->latitude,
                'longitude' => $company->longitude,
                'options' => [
                    [
                        'hintContent' => $company->short_name,
                        'balloonContentHeader' => $company->full_name,
                        'balloonContentBody' => $company->address,
                        'balloonContentFooter' => $company->category,
                    ],
                    [
                        'iconLayout' => 'default#image',
                        'iconImageHref' => Url::base() . '/images/mm_20_red.gif',
                        'iconImageSize' => [6, 10],
                        'iconImageOffset' => [-3, -5]
                    ]
                ]
            ];
        }
        return $items;
    }
}
