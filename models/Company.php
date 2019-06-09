<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $global_id
 * @property string $full_name
 * @property string $short_name
 * @property string $inn
 * @property string $okpo
 * @property string $adm_area
 * @property string $district
 * @property string $address
 * @property string $category
 * @property string $specialization
 * @property string $okved
 * @property string $okved_description
 * @property string $geoData
 * @property string $latitude
 * @property string $longitude
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['global_id'], 'string', 'max' => 10],
            [['full_name', 'short_name', 'okpo', 'adm_area', 'district', 'address', 'category', 'specialization', 'okved', 'okved_description', 'geoData'], 'string', 'max' => 255],
            [['inn'], 'string', 'max' => 25],
            [['latitude', 'longitude'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'global_id' => 'Global ID',
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'inn' => 'Inn',
            'okpo' => 'Okpo',
            'adm_area' => 'Adm Area',
            'district' => 'District',
            'address' => 'Address',
            'category' => 'Category',
            'specialization' => 'Specialization',
            'okved' => 'Okved',
            'okved_description' => 'Okved Description',
            'geoData' => 'Geo Data',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
