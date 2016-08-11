<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\posts */
/* @var $form ActiveForm */
?>
<div class="post-create">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'text')->textarea() ?>
        <?= $form->field($model, 'image')->fileInput(); ?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-default']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- post-create -->
