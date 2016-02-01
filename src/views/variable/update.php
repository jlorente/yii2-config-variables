<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use jlorente\config\models\Variable;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model jlorente\config\models\Variable */
/* @var $this yii\web\View */

$this->title = Yii::t('jlorente/config', 'Update Variable') . ' #' . $model->id;
?>
<div class="backend-container variable-model variable-update clearfix">
    <?php
    $form = ActiveForm::begin([
                'id' => 'config-variable-form'
    ]);
    echo $form->field($model, 'code', [
        'inputOptions' => [
            'class' => 'form-control',
            'disabled' => 'disabled'
        ]
    ]);
    echo $form->field($model, 'type')->dropDownList(Variable::getTypes(), [
        'disabled' => 'disabled'
    ]);

    $types = Variable::getTypes();
    echo $this->render('type/_' . strtolower($types[$model->type]), ['form' => $form, 'model' => $model]);
    ?>
    <div class="col-xs-12 buttons">
        <?=
        Html::a(
                Yii::t('jlorente/config', 'Return to list'), ['index'], ['class' => 'btn btn-success']
        );
        ?>
        <?=
        Html::a(
                Yii::t('jlorente/config', 'Return'), ['view', 'id' => $model->id], ['class' => 'btn btn-info']
        );
        ?>
        <?=
        Html::submitButton(
                Yii::t('jlorente/config', 'Update'), ['class' => 'btn btn-primary']
        );
        ?>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>