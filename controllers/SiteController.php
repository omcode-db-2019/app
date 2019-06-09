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
            ->orderBy('date DESC')->distinct('station_id')
            ->limit(count($stationIds))->all();


        // Complaints
        $messages = Message::find()->orderBy('date DESC')->all();
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
                        'iconLayout' => 'default#image',
                        'iconImageHref' => Url::base() . '/images/icons/alarm.svg',
                        'iconImageSize' => [20, 20],
                        'iconImageOffset' => [-3, -5]
                    ]
                ]
            ];
        }
        // Ecodata.
        $image = '';
        foreach ($measurements as $measurement) {
            $aqi = $measurement->aqi;
            if ($aqi >= 0 && $aqi <= 50) {
                $image = Url::base() . '/images/icons/good.svg';
            }

            if ($aqi >= 51 && $aqi <= 100) {
                $image = Url::base() . '/images/icons/moderate.svg';
            }
            // AQI Level: Unhealthy for sensitive groups
            if ($aqi >= 101 && $aqi <= 150) {
                $image = Url::base() . '/images/icons/unhealthy_for_sensitive_groups.svg';
            }
            // AQI Level: Unhealthy
            if ($aqi >= 151 && $aqi <= 200) {
                $image = Url::base() . '/images/icons/unhealty.svg';
            }
            // AQI Level: Very unhealthy
            if ($aqi >= 201 && $aqi <= 300) {
                $image = Url::base() . '/images/icons/very_unhealthy.svg';
            }
            // AQI Level: Hazardous
            if ($aqi >= 300) {
                $image = Url::base() . '/images/icons/hazardous.svg';
            }
            $content = '';
            $addContent = function ($string) use (&$content) {
                if ($content !== '') {
                    $content .= '<br>';
                }
                $content .= $string;
            };

            $measurement->co === NULL ?: $addContent('CO: ' . $measurement->co);
            $measurement->so2 === NULL ?: $addContent('SO2: ' . $measurement->so2);
            $items[] = [
                'latitude' => $measurement->station->latitude,
                'longitude' => $measurement->station->longitude,
                'options' => [
                    [
                        'hintContent' => 'Индекс: <b>' . $measurement->aqi . '</b>',
                        'balloonContentHeader' => $measurement->date,
                        'balloonContentBody' => $measurement->station->name,
                        'balloonContentFooter' => $content,
                    ],
                    [
                        'iconLayout' => 'default#image',
                        'iconImageHref' => $image,
                        'iconImageSize' => [30, 30],
                        'iconImageOffset' => [-3, -5]
                    ]
                ]
            ];
        }

        return $this->render('index', ['items' => array_merge($items, $this->buildCompanyItems())]);
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
                        'iconImageHref' => Url::base() . '/images/icons/building.svg',
                        'iconImageSize' => [15, 15],
                        'iconImageOffset' => [-3, -5]
                    ]
                ]
            ];
        }
        return $items;
    }
}
