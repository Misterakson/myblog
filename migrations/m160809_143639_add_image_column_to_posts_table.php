<?php

use yii\db\Migration;

/**
 * Handles adding image to table `posts`.
 */
class m160809_143639_add_image_column_to_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('posts', 'image', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('posts', 'image');
    }
}
