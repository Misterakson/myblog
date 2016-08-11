<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation for table `profile`.
 */
class m160807_101703_create_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'user_id' => Schema::TYPE_PK,
            'avatar' => Schema::TYPE_STRING,
            'first_name' => Schema::TYPE_STRING,
            'second_name' => Schema::TYPE_STRING,
            'middle_name' => Schema::TYPE_STRING,
            'birthday' => Schema::TYPE_INTEGER,
            'gender' => Schema::TYPE_SMALLINT
        ]);
        $this->addForeignKey(
            'profile_users',
            'profile',
            'user_id',
            'users',
            'id',
            'cascade'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('profile_user','profile');
        $this->dropTable('profile');

    }
}
