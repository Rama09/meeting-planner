<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `place_gps`.
 */
class m170118_120959_create_place_gps_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%place_gps}}', [
            'id' => Schema::TYPE_PK,
            'place_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'gps' => 'POINT NOT NULL',
        ], $tableOptions);

        $this->execute('create spatial index place_gps_gps on '.'{{%place_gps}}(gps);');
        $this->addForeignKey('fk_place_gps','{{%place_gps}}' , 'place_id', '{{%place}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_place_gps','{{%place_gps}}');
        $this->dropTable('{{%place_gps}}');
    }
}
