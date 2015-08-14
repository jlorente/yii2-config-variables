<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\config;

use yii\base\Module as BaseModule;
use Yii;

/**
 * Module class for the configuration variable module.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class Module extends BaseModule {

    /**
     *
     * @var string 
     */
    public $messageConfig = [];

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

        Yii::$app->i18n->translations['jlorente/config'] = $this->getMessageConfig();
    }

    protected function getMessageConfig() {
        return array_merge([
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@jlorenteConfig/messages',
            'forceTranslation' => true
                ], $this->messageConfig);
    }

}
