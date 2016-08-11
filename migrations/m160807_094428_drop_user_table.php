<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `user`.
 */
class m160807_094428_drop_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('user');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
       return false;
    }
}
