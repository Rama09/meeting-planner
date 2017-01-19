<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `friend`.
 */
class m170118_121141_create_friend_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%friend}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'friend_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'number_meetings' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'is_favorite' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_friend_user_id', '{{%friend}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_friend_friend_id', '{{%friend}}', 'friend_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_friend_friend_id', '{{%friend}}');
        $this->dropForeignKey('fk_friend_user_id', '{{%friend}}');
        $this->dropTable('{{%friend}}');
    }
}
