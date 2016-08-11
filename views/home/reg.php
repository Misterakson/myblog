<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>
<div class="home-reg">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- home-reg -->
