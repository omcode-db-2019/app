<?php

use yii\db\Migration;

/**
 * Class m190608_174414_measurement_service_create_table
 */
class m190608_174414_measurement_service_create_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('measurement_service', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
        $this->insert('measurement_service', [
            'name' => 'waqi',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('measurement_service');
    }
}
