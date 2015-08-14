<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\db\Schema;
use yii\db\Migration;
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
        $this->createTable($this->getTableName(), [
            'id' => Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'value' => Schema::TYPE_BINARY,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER
        ]);

        $this->createIndex('UNIQUE_code', $this->getTableName(), 'code', true);
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

}
