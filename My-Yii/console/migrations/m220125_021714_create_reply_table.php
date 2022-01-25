<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reply}}`.
 */
class m220125_021714_create_reply_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reply}}', [
            'id' => $this->primaryKey(),
            'tread_id'=> $this->integer()->notNull(),
            'user_id'=> $this->integer()->notnull(),
            'body'=>$this->text(),
            'create_at' => $this->timestamp()->defaultValue(null),
            'update_at' => $this->timestamp()->defaultValue(null),
        ]);
        $this->createIndex(
            'idx-reply-user_id',
            'reply',
            'user_id',
        );
        $this->addForeignKey(
            'fk-reply-user_id',
            'reply',
            'user_id',
            'user168',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-reply-tread_id',
            'reply',
            'tread_id',
        );
        $this->addForeignKey(
            'fk-reply-tread_id',
            'reply',
            'tread_id',
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
        $this->dropTable('{{%reply}}');

        $this->dropIndex(
            'idx-reply-tread_id',
            'reply'
        );
        $this->dropForeign(
            'fk-reply-tread_id',
            'reply'
        );
        $this->dropIndex(
            'idx-reply-user_id',
            'reply'
        );
        $this->dropForeign(
            'fk-reply-user_id',
            'reply'
        );
    }
}
