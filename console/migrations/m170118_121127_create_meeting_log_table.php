<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `meeting_log`.
 */
class m170118_121127_create_meeting_log_table extends Migration
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

        $this->createTable('{{%meeting_log}}', [
            'id' => Schema::TYPE_PK,
            'meeting_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'action' => Schema::TYPE_INTEGER . ' NOT NULL',
            'actor_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'extra_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_meeting_log_meeting', '{{%meeting_log}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_meeting_log_actor', '{{%meeting_log}}', 'actor_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_meeting_log_actor', '{{%meeting_log}}');
        $this->dropForeignKey('fk_meeting_log_meeting', '{{%meeting_log}}');
        $this->dropTable('{{%meeting_log}}');
    }
}
