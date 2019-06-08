<?php

use yii\db\Migration;

class m190608_181549_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
        $this->insert('city', [
            'name' => 'Москва',
        ]);
        $this->insert('city', [
            'name' => 'Санкт-Петербург',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }
}