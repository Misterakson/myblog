<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation for table `posts`.
 */
class m160807_100544_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING.' NOT NULL',
            'description' => Schema::TYPE_STRING.' NOT NULL',
            'text' => Schema::TYPE_STRING.' NOT NULL',
            'date' => Schema::TYPE_DATETIME.' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER.' NOT NULL',
        ]);
        $this->addForeignKey('post_user_id','posts','user_id','users','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('posts');
    }
}
