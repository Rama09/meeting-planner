<?php

use yii\db\Migration;

/**
 * Handles the creation of table `template_time`.
 */
class m170118_121315_create_template_time_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('template_time', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('template_time');
    }
}
