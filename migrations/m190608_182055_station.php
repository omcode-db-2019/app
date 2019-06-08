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
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Сухаревка',
            'endpoint' => 'moscow/suhar',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Cпиридоновка',
            'endpoint' => 'moscow/spirid',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Шаболовка',
            'endpoint' => 'moscow/shabol',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Косино',
            'endpoint' => 'moscow/kosino',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Троицк',
            'endpoint' => 'moscow/troitsk',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Зеленоград 11',
            'endpoint' => 'moscow/zelen_11',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Кожухово',
            'endpoint' => 'moscow/kojuhovo',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Народного ополчения',
            'endpoint' => 'moscow/narod_op',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Вешняки',
            'endpoint' => 'moscow/veshnyaki',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Мобильная станция парковая',
            'endpoint' => 'moscow/parkovaya',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Долгопрудная',
            'endpoint' => 'moscow/dolgoprud',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Останкино',
            'endpoint' => 'moscow/ostankino',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Гурьянова',
            'endpoint' => 'moscow/guryanova',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Новокосино',
            'endpoint' => 'moscow/novokosino',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Глебовская',
            'endpoint' => 'moscow/glebovskaya',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Пролетарский проспект',
            'endpoint' => 'moscow/proletarskiy',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Очаковская',
            'endpoint' => 'moscow/ochakovskaya',
            'city_id' => 1,
        ]);
        $this->insert('station', [
            'service_id' => 1,
            'name' => 'Спартаковская пл.',
            'endpoint' => 'moscow/spartakovskaya',
            'city_id' => 1,
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

