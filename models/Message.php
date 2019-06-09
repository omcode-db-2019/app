<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property double $latitude
 * @property double $longitude
 * @property string $region
 * @property string $city
 * @property string $problem
 * @property string $comments
 * @property string $date
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude', 'region', 'city', 'problem', 'comments'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['region', 'city', 'problem', 'comments'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'region' => 'Region',
            'city' => 'City',
            'problem' => 'Problem',
            'comments' => 'Comments',
        ];
    }
}
