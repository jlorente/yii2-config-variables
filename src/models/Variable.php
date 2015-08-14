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
use yii\behaviors\TimestampBehavior,
    yii\behaviors\BlameableBehavior;

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
    const TYPE_BOOLEAN = 4;
    const TYPE_OBJECT = 5;

    //const TYPE_ARRAY = 6;

    /**
     * Store for the already loaded variables.
     * 
     * @var array
     */
    protected static $cached;

    /**
     *
     * @var array
     */
    public $object;

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
            [['type', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            ['description', 'string'],
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
            'id' => Yii::t('jlorente/config', 'ID'),
            'code' => Yii::t('jlorente/config', 'Code'),
            'name' => Yii::t('jlorente/config', 'Name'),
            'description' => Yii::t('jlorente/config', 'Description'),
            'type' => Yii::t('jlorente/config', 'Type'),
            'value' => Yii::t('jlorente/config', 'Value')
        ];
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => false
            ]
        ]);
    }

    /**
     * Validates the value of the variable.
     * 
     * @return boolean
     */
    public function validateValue() {
        $errorMessage = Yii::t('jlorente/config', 'Invalid value for type "{type}"', [
                    'type' => $this->type
        ]);
        switch ($this->type) {
            case self::TYPE_INT:
                if (is_numeric($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (int) $this->value;
                break;
            case self::TYPE_FLOAT:
                if (is_numeric($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (float) $this->value;
                break;
            case self::TYPE_BOOLEAN:
                $this->value = (int) boolval($this->value);
                break;
            case self::TYPE_STRING:
                if (is_string($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (string) $this->value;
                break;
            case self::TYPE_OBJECT:
                if (is_array($this->value) === false) {
                    $this->addError('value', $errorMessage);
                    return false;
                }
                $this->value = (object) $this->value;
                break;
            /*           case self::TYPE_ARRAY:
              if (is_array($this->value) === false) {
              $this->addError('value', $errorMessage);
              return false;
              }
              $this->value = array_values((array) $this->value);
              break; */
            default:
                $this->addError('type', Yii::t('jlorente/config', 'Unrecognized type'));
                return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null) {
        if ($runValidation && !$this->validate($attributeNames)) {
            return false;
        }
        $this->value = serialize($this->value);
        return parent::save(false, $attributeNames);
    }

    /**
     * @inheritdoc
     */
    public static function populateRecord($record, $row) {
        parent::populateRecord($record, $row);
        $record->value = unserialize($record->value);
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
            $c = static::findOne(['code' => $config]);
            if ($c === null) {
                throw new InvalidParamException('Configuration not found');
            }
            static::$cached[$config] = $c;
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
            self::TYPE_INT => 'INT',
            self::TYPE_FLOAT => 'FLOAT',
            self::TYPE_STRING => 'STRING',
            self::TYPE_BOOLEAN => 'BOOLEAN',
            self::TYPE_OBJECT => 'OBJECT',
                //self::TYPE_ARRAY => 'ARRAY'
        ];
    }

}
