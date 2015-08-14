<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\widgets\ActiveForm;
use jlorente\config\models\Variable;
use jlorente\config\assets\VariableFormAsset;

/* @var $model jlorente\config\models\Variable */
/* @var $this yii\web\View */

$form = ActiveForm::begin([
            'id' => 'config-variable-form'
        ]);
VariableFormAsset::register($this);
echo $form->field($model, 'code');
echo $form->field($model, 'type')->dropDownList(Variable::getTypes());
echo $form->field($model, 'value')->hiddenInput();

echo $form->field($model, 'children[]');
echo $form->field($model, 'children[]');

ActiveForm::end();