<?php

use yii\db\Migration;

/**
 * Handles the creation of table `template_place`.
 */
class m170118_121326_create_template_place_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('template_place', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('template_place');
    }
}
