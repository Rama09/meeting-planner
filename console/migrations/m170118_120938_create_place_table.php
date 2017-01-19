<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `place`.
 */
class m170118_120938_create_place_table extends Migration
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

        $this->createTable('{{%place}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'place_type' => Schema::TYPE_SMALLINT .' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'google_place_id' => Schema::TYPE_STRING .' NOT NULL', // e.g. google places id
            'created_by' => Schema::TYPE_BIGINT .' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_place_created_by', '{{%place}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_place_created_by', '{{%place}}');
        $this->dropTable('{{%place}}');
    }
}
