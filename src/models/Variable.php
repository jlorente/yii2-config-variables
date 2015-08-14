<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\config\models;

use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Model class for the configuration variable table. Call the static method 
 * Variable::get('YOUR_VARIABLE_CODE') to get values of configuration variables. 
 * The method caches the values to avoid querying continuously.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class Variable extends ActiveRecord {

    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;
    const TYPE_ARRAY = 4;

    /**
     * Store for the already loaded variables.
     * 
     * @var array
     */
    protected static $cached;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cnf_variable';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 255],
            ['code', 'unique'],
            ['code', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/u'],
            ['value', 'validateValue']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('XXXXXX::i18nFileName()', 'ID'),
            'code' => Yii::t('XXXXXX::i18nFileName()', 'Slug'),
            'type' => Yii::t('XXXXXX::i18nFileName()', 'Type'),
            'value' => Yii::t('XXXXXX::i18nFileName()', 'Value')
        ];
    }

    /**
     * Validates the value of the variable.
     * 
     * @return boolean
     */
    public function validateValue() {
        $errorMessage = Yii::t('jlorente/config', 'Invalid value for type "' . $this->type . '"');
        switch ($this->type) {
            case TYPE_INT:
                if (is_numeric($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (int) $this->value;
                break;
            case TYPE_FLOAT:
                if (is_numeric($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (float) $this->value;
                break;
            case TYPE_STRING:
                if (is_string($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (string) $this->value;
                break;
            case TYPE_ARRAY:
                if (is_array($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (array) $this->value;
                break;
            default:
                $this->addError('type', 'Unrecognized type');
                return false;
        }
        return true;
    }

    /**
     * Gets the value of the configuration variable.
     * 
     * @param string $config
     * @return mixed
     * @throws InvalidParamException
     */
    public static function get($config) {
        if (is_string($config) === false) {
            throw new InvalidParamException('$config must be a string');
        }
        if (isset(static::$cached[$config]) === false) {
            $c = static::findOne(['slug' => $config]);
            if ($c === null) {
                throw new InvalidParamException('Configuration not found');
            }
            static::$cached[$config] = unserialize($c);
        }
        return static::$cached[$config];
    }

    /**
     * Returns the allowed variable types.
     * 
     * @return array
     */
    public static function getTypes() {
        return [
            self::TYPE_INT => Yii::t('jlorente/config', 'INT'),
            self::TYPE_FLOAT => Yii::t('jlorente/config', 'FLOAT'),
            self::TYPE_STRING => Yii::t('jlorente/config', 'STRING'),
            self::TYPE_ARRAY => Yii::t('jlorente/config', 'ARRAY')
        ];
    }

}
