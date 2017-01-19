<?php

use yii\db\Migration;

/**
 * Handles the creation of table `template`.
 */
class m170118_121259_create_template_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('template', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('template');
    }
}
