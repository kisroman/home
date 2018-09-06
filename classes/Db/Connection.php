<?php

namespace classes\Db;

class Connection
{
    /**
     * Types of columns
     */
    const TYPE_BOOLEAN = 'boolean';

    const TYPE_SMALLINT = 'smallint';

    const TYPE_INTEGER = 'integer';

    const TYPE_BIGINT = 'bigint';

    const TYPE_FLOAT = 'float';

    const TYPE_NUMERIC = 'numeric';

    const TYPE_DECIMAL = 'decimal';

    const TYPE_DATE = 'date';

    const TYPE_TIMESTAMP = 'timestamp';

    // Capable to support date-time from 1970 + auto-triggers in some RDBMS
    const TYPE_DATETIME = 'datetime';

    // Capable to support long date-time before 1970
    const TYPE_TEXT = 'text';

    const TYPE_BLOB = 'blob';

    // Used for back compatibility, when query param can't use statement options
    const TYPE_VARBINARY = 'varbinary';

    /**
     * @var \mysqli
     */
    private $connection;

    /**
     * @var array
     */
    private $columns;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = 'home';
        $testDb = 'home_test';

        $this->connection = mysqli_connect($servername, $username, $password, $testDb);
        if ($this->connection->connect_error) {
            throw new \Exception("Connection failed: " . $this->connection->connect_error);
        } elseif (!$this->connection) {
            throw new \Exception("MySQL server has gone away.");

        }
    }

    public function select($table, $fields = '*', $whereCondition = '')
    {
        $query = 'SELECT ' . $fields . ' FROM ' . $table;

        if ($whereCondition !== '') {
            $query .= ' WHERE ' . $whereCondition;
        }

        return $this->connection->query($query);
    }

    public function selectMax($table, $field)
    {
        $query = 'SELECT MAX(' . $field . ') FROM ' . $table;

        return $this->connection->query($query);
    }

    public function update($table, $columnsValues, $whereCondition)
    {
        $query = 'UPDATE ' . $table . ' SET ' . $columnsValues . ' WHERE ' . $whereCondition;

        return $this->connection->query($query);
    }

    public function insert($tableName, $values, $columns = null)
    {
        $query = 'INSERT INTO ' . $tableName;

        if ($columns !== null) {
            $query .= ' (' . $columns . ')';
        }
        $query .= ' VALUES (' . $values . ');';

        return $this->connection->query($query, MYSQLI_USE_RESULT);
    }

    public function createTable($tableName)
    {
        $query = 'CREATE TABLE IF NOT EXISTS ' . $tableName . ' (';
        foreach ($this->columns as $name => $column) {
            $columnQuery = $name . ' ' . $column['type'];

            if (isset($column['size'])) {
                $columnQuery .= '(' . $column['size'] .')';
            }

            if (isset($column['options']['nullable']) && $column['options']['nullable'] == false) {
                $columnQuery .= ' NOT NULL';
            }

            if (isset($column['options']['identity']) && $column['options']['identity'] == true) {
                $columnQuery .= ' IDENTITY';
            }

            if (isset($column['options']['auto_increment']) && $column['options']['auto_increment'] == true) {
                $columnQuery .= ' AUTO_INCREMENT';
            }

            if (isset($column['options']['primary']) && $column['options']['primary'] == true) {
                $columnQuery .= ' PRIMARY KEY';
            }

            $columnQuery .= ', ';
            $query .= $columnQuery;
        }
        $query = substr($query, 0, -2);
        $query .= ')';
        $this->connection->query($query);
    }

    public function addColumn($name, $type, $size = null, $options = [], $comment = null)
    {
        $this->columns[$name] = [
            'type' => $type,
            'options' => $options,
        ];

        if ($size !== null) {
            $this->columns[$name]['size'] = $size;
        }

        if ($comment !== null) {
            $this->columns[$name]['comment'] = $comment;
        }

        return $this;
    }
}
