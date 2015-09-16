<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\widgets\DetailView;
use jlorente\config\models\Variable;
use yii\helpers\Html;

/* @var $model jlorente\config\models\VariableForm */
/* @var $this yii\web\View */

$types = Variable::getTypes();
$valueFunc = function($model) {
    switch ($model->type) {
        /* case Variable::TYPE_ARRAY:
          $v = Html::encode(implode(', ', $model->value));
          break; */
        case Variable::TYPE_OBJECT:
            $v = '';
            foreach ($model->value as $c => $value) {
                $c = Html::encode($c);
                $value = Html::encode($value);
                $v .= "<p>$c => $value</p>";
            }
            break;
        default:
            $v = Html::encode($model->value);
            break;
    }
    return $v;
};
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'code',
        'name',
        'description',
        [
            'attribute' => 'type',
            'value' => $types[$model->type]
        ],
        [
            'attribute' => 'value',
            'format' => 'raw',
            'value' => $valueFunc($model)
        ],
        'created_at:datetime',
        'updated_at:datetime',
        'updated_by'
    ]
]);
?>
<div class="col-xs-12 buttons">
    <?=
    Html::a(
            Yii::t('jlorente/config', 'Return to list'), ['index'], ['class' => 'btn btn-success']
    )
    ?>
    <?=
    Html::a(
            Yii::t('jlorente/config', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']
    )
    ?>
</div>