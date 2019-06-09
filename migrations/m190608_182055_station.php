<?php

use yii\db\Migration;

class m190608_182055_station extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('station', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'name' => $this->string(),
            'endpoint' => $this->string(),
            'city_id' => $this->integer(),
            'latitude' => $this->decimal(9,6),
            'longitude' => $this->decimal(9,6),
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Сухаревка',
            'endpoint' => 'moscow/suhar',
            'city_id' => 1,
            'latitude' => 55.773757,
            'longitude' => 37.627445,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Cпиридоновка',
            'endpoint' => 'moscow/spirid',
            'city_id' => 1,
            'latitude' => 55.760276,
            'longitude' => 37.591450,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Шаболовка',
            'endpoint' => 'moscow/shabol',
            'city_id' => 1,
            'latitude' => 55.726868,
            'longitude' => 37.606674,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Косино',
            'endpoint' => 'moscow/kosino',
            'city_id' => 1,
            'latitude' => 55.720970,
            'longitude' => 37.862533,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Троицк',
            'endpoint' => 'moscow/troitsk',
            'city_id' => 1,
            'latitude' => 55.473526,
            'longitude' => 37.296735,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Зеленоград 11',
            'endpoint' => 'moscow/zelen_11',
            'city_id' => 1,
            'latitude' => 55.99404,
            'longitude' => 37.172141,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Кожухово',
            'endpoint' => 'moscow/kojuhovo',
            'city_id' => 1,
            'latitude' => 55.724087,
            'longitude' => 37.903839,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Народного ополчения',
            'endpoint' => 'moscow/narod_op',
            'city_id' => 1,
            'latitude' => 55.777191,
            'longitude' => 37.472654,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Вешняки',
            'endpoint' => 'moscow/veshnyaki',
            'city_id' => 1,
            'latitude' => 55.721310,
            'longitude' => 37.791790,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Мобильная станция парковая',
            'endpoint' => 'moscow/parkovaya',
            'city_id' => 1,
            'latitude' => 55.804364,
            'longitude' => 37.839048,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Долгопрудная',
            'endpoint' => 'moscow/dolgoprud',
            'city_id' => 1,
            'latitude' => 55.894801,
            'longitude' => 37.534019,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Останкино',
            'endpoint' => 'moscow/ostankino',
            'city_id' => 1,
            'latitude' => 55.82202,
            'longitude' => 37.630405,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Гурьянова',
            'endpoint' => 'moscow/guryanova',
            'city_id' => 1,
            'latitude' => 55.680167,
            'longitude' => 37.713097,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Новокосино',
            'endpoint' => 'moscow/novokosino',
            'city_id' => 1,
            'latitude' => 55.742503,
            'longitude' => 37.533054,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Глебовская',
            'endpoint' => 'moscow/glebovskaya',
            'city_id' => 1,
            'latitude' => 55.815419,
            'longitude' => 37.712878,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Пролетарский проспект',
            'endpoint' => 'moscow/proletarskiy',
            'city_id' => 1,
            'latitude' => 55.636568,
            'longitude' => 37.653547,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Очаковская',
            'endpoint' => 'moscow/ochakovskaya',
            'city_id' => 1,
            'latitude' => 55.693546,
            'longitude' => 37.455579,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Спартаковская пл.',
            'endpoint' => 'moscow/spartakovskaya',
            'city_id' => 1,
            'latitude' => 55.775283,
            'longitude' => 37.68322,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('station');
    }
}

