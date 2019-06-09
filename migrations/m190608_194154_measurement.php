<?php

use yii\db\Migration;

/**
 * Class m190608_194154_measurement
 */
class m190608_194154_measurement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('measurement', [
            'id' => $this->primaryKey(),
            'aqi' => $this->integer(),
            'date' => $this->dateTime(),
            'station_id' => $this->integer(),
            'co' => $this->string(),
            'no2' => $this->string(),
            'o3' => $this->string(),
            'pm10' => $this->string(),
            'pm25' => $this->string(),
            'so2' => $this->string(),
            'temperature' => $this->float()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('measurement');
    }
}
