<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `meeting_note`.
 */
class m170118_121212_create_meeting_note_table extends Migration
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

        $this->createTable('{{%meeting_note}}', [
            'id' => Schema::TYPE_PK,
            'meeting_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'posted_by' => Schema::TYPE_BIGINT . ' NOT NULL DEFAULT 0',
            'note' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_meeting_note_meeting', '{{%meeting_note}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_meeting_note_posted_by', '{{%meeting_note}}', 'posted_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_meeting_note_meeting', '{{%meeting_note}}');
        $this->dropForeignKey('fk_meeting_note_posted_by', '{{%meeting_note}}');
        $this->dropTable('{{%meeting_note}}');
    }
}
