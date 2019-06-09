<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property int $service_id
 * @property string $name
 * @property string $endpoint
 * @property float $latitude
 * @property float $longitude
 * @property int $city_id
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'city_id'], 'integer'],
            [['name', 'endpoint'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'name' => 'Name',
            'endpoint' => 'Endpoint',
            'city_id' => 'City ID',
        ];
    }
}
