<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `meeting_time`.
 */
class m170118_121055_create_meeting_time_table extends Migration
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

        $this->createTable('{{%meeting_time}}', [
            'id' => Schema::TYPE_PK,
            'meeting_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'start' => Schema::TYPE_INTEGER .' NOT NULL',
            'suggested_by' => Schema::TYPE_BIGINT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_meeting_time_meeting', '{{%meeting_time}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_participant_suggested_by', '{{%meeting_time}}', 'suggested_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_participant_suggested_by', '{{%meeting_time}}');
        $this->dropForeignKey('fk_meeting_time_meeting', '{{%meeting_time}}');
        $this->dropTable('{{%meeting_time}}');
    }
}
