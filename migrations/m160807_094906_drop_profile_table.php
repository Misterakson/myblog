<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `profile`.
 */
class m160807_094906_drop_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('profile');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return false;
    }
}
