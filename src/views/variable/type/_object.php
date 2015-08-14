<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\helpers\Html;

/* @var $model jlorente\config\models\VariableForm */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

foreach ($model->value as $code => $value) :
    ?>
    <div class="form-group form-field-variable-<?= $model->code ?>-<?= $code ?>">
        <?= Html::label(Yii::t('config-vars', $code)) ?>
        <?=
        Html::input('string', "{$model->formName()}[value][$code]", $value, [
            'class' => 'form-control'
        ]);
        ?>
    </div>
    <?php
endforeach;
