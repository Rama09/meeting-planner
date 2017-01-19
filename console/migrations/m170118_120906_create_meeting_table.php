<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `meeting`.
 */
class m170118_120906_create_meeting_table extends Migration
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

        $this->createTable('{{%meeting}}', [
            'id' => Schema::TYPE_PK,
            'owner_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'meeting_type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'message' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_meeting_owner', '{{%meeting}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_meeting_owner', '{{%meeting}}');
        $this->dropTable('{{%meeting}}');
    }
}
