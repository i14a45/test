<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\CalcForm */

$this->title = 'My Yii Application';
?>
<div class="row">
    <div class="col-md-6">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'start')->textInput(); ?>

        <?= $form->field($model, 'end')->textInput(); ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <?= nl2br($model->msg); ?>
            </div>
        </div>

        <?= $form->field($model, 'result')->textInput([
            'readonly' => true,
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Calculate', ['class' => 'btn btn-primary', 'name' => 'calc-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
