<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Handles the creation for table `users`.
 */
class m160807_095140_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'email' => Schema::TYPE_STRING.' NOT NULL',
            'password_hash' => Schema::TYPE_STRING.' NOT NULL',
            'status' => Schema::TYPE_SMALLINT.' NOT NULL',
            'auth_key' => Schema::TYPE_STRING.' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
