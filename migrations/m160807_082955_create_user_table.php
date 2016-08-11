<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160807_082955_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'password' => 'string NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
