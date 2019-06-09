<?php

namespace app\models;

use app\services\Waqi;
use DateTime;

/**
 * This is the model class for table "measurement".
 *
 * @property int $id
 * @property int $aqi
 * @property string $date
 * @property int $station_id
 * @property string $co
 * @property string $no2
 * @property string $o3
 * @property string $pm10
 * @property string $pm25
 * @property string $so2
 * @property double $temperature
 */
class Measurement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'measurement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aqi', 'station_id'], 'integer'],
            [['date'], 'safe'],
            [['temperature'], 'number'],
            [['co', 'no2', 'o3', 'pm10', 'pm25', 'so2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aqi' => 'Aqi',
            'date' => 'Date',
            'station_id' => 'Station ID',
            'co' => 'Co',
            'no2' => 'No2',
            'o3' => 'O3',
            'pm10' => 'Pm10',
            'pm25' => 'Pm25',
            'so2' => 'So2',
            'temperature' => 'Temperature',
        ];
    }

    public static function create(Waqi $waqi)
    {
        $model = new self();
        $model->date = $waqi->getMeasurementTime()->format('Y-m-d H:i:s');
        $model->aqi = $waqi->getAQI();
        $model->station_id = $waqi->getStationId();
        $model->co = $waqi->getCO();
        $model->no2 = $waqi->getNO2();
        $model->o3 = $waqi->getO3();
        $model->pm10 = $waqi->getPM10();
        $model->pm25 = $waqi->getPM25();
        $model->so2 = $waqi->getSO2();
        $model->temperature = $waqi->getTemperature();
        $model->save();
    }
}
