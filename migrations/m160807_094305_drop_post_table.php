<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `post`.
 */
class m160807_094305_drop_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('post');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return false;
    }
}
