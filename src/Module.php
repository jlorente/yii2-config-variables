<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\config;

use yii\base\Module as BaseModule;

/**
 * Module class for the configuration variable module.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class Module extends BaseModule {

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jlorente\config\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        $this->setAliases([
            '@jlorenteConfig' => '@vendor/jlorente/yii2-config-variables/src',
        ]);
    }

}
