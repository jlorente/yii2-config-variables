<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
namespace jlorente\config\migrations;

use yii\db\Schema;
use custom\db\Migration;
use jlorente\config\models\Variable;

/**
 * Configuration variables table creation.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class m150813_162711_configuration_variables_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable($this->getTableName(), $this->getFields());
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable($this->getTableName());
    }

    /**
     * Returns the table name of the variable model. You can override this 
     * method in order to provide a custom table name.
     * 
     * @return string
     */
    protected function getTableName() {
        return Variable::tableName();
    }

    /**
     * Returns the fields that compose the Variable model table. You can 
     * override this method to provide additional fields. Make sure to use 
     * a merge function with the parent::getFields() method to add new fields.
     * 
     * @return array Fields that should be created in the table.
     */
    protected function getFields() {
        return [
            'id' => Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_SMALLINT,
            'value' => Schema::TYPE_BINARY
        ];
    }

}
