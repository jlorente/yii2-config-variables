<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\widgets\DetailView;
use custom\helpers\Html;
use backend\modules\core\models\Promo;

/* @var $model jlorente\config\models\Variable */
/* @var $this yii\web\View */

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'slug',
        'title',
        'content',
        'url',
        'image',
        [
            'attribute' => 'file',
            'format' => 'html',
            'value' => Html::img(Yii::$app->params['frontendUrl'] . $model->image, [
                'width' => Promo::IMAGE_WIDTH,
                'height' => Promo::IMAGE_HEIGHT
            ])
        ],
        'created_at:datetime',
        'created_by',
        'updated_at:datetime',
        'updated_by'
    ]
]);
