<?php

use yii\db\Migration;

/**
 * Handles the creation for table `post`.
 */
class m160807_090333_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => 'pk',
            'text' => 'text',
            'description' => 'string',
            'user_id' => 'int'
        ]);
        $this->addForeignKey('post_user_id', 'post', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
