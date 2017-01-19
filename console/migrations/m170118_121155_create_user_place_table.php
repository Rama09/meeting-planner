<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `user_place`.
 */
class m170118_121155_create_user_place_table extends Migration
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

        $this->createTable('{{%user_place}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
            'place_id' => Schema::TYPE_INTEGER.' NOT NULL',
            'is_favorite' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'number_meetings' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'is_special' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'note' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_user_place_user', '{{%user_place}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_place_place', '{{%user_place}}', 'place_id', '{{%place}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_place_place', '{{%user_place}}');
        $this->dropForeignKey('fk_user_place_user', '{{%user_place}}');
        $this->dropTable('{{%user_place}}');
    }
}
