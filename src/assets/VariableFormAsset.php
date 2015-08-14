<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\config\assets;

use yii\web\AssetBundle;

/**
 * Asset for variable creation and update form.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class VariableFormAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@jlorenteConfig/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/variable-form.js'
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/variable-form.css'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];

}
