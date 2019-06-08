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
        $this->delete('measurement_service');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190608_174414_measurement_service_create_table cannot be reverted.\n";

        return false;
    }
    */
}
