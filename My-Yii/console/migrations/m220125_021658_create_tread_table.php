<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tread}}`.
 */
class m220125_021658_create_tread_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tread}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title'=> $this->string()->notnull(),
            'body'=> $this->text(),
            'create_at' => $this->timestamp()->defaultValue(null),
            'update_at' => $this->timestamp()->defaultValue(null),
        ]);
        $this->createIndex(
            'idx-tread-user_id',
            'tread',
            'user_id',
        );
        $this->addForeignKey(
            'fk-tread-user_id',
            'tread',
            'user_id',
            'user168',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tread}}');
    }
}
