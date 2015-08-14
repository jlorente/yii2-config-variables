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

$this->title = Yii::t('jlorente/config', 'Variables')
/* @var $model jlorente\config\models\Variable */
/* @var $this yii\web\View */
?>
<div class="config-var-container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?=
        Html::a(Yii::t('jlorente/config', 'Create Variable'), ['create'], [
            'class' => 'btn btn-warning'
        ])
        ?>
    </p>

    <?php
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
            'type',
            'value',
            [
                'class' => ActionColumn::className(),
            ],
        ]
    ]);
    ?>
</div>