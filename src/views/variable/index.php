<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\data\ActiveDataProvider;
use jlorente\config\models\Variable;

$this->title = Yii::t('jlorente/config', 'Config Variables')

/* @var $model jlorente\config\models\Variable */
/* @var $this yii\web\View */
?>
<div class="config-var-container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $types = Variable::getTypes();
    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => Variable::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
                ]),
        'columns' => [
            'id',
            'code',
            'name',
            [
                'attribute' => 'type',
                'value' => function($model) use ($types) {
                    return $types[$model->type];
                }
            ],
            [
                'attribute' => 'value',
                'value' => function($model) {
                    switch ($model->type) {
                        /* case Variable::TYPE_ARRAY:
                          $v = implode(', ', $model->value);
                          break; */
                        case Variable::TYPE_OBJECT:
                            $v = 'object';
                            break;
                        default:
                            $v = $model->value;
                            break;
                    }
                    return $v;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'updated_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}'
            ],
        ]
    ]);
    ?>
</div>