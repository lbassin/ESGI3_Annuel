<?php

class BaseSql
{

    protected $foreignValues = [];
    private $db;
    private $table;
    private $columns;

    public function __construct()
    {
        $this->table = strtolower(get_called_class());

        $objectVars = get_class_vars($this->table);
        $sqlVars = get_class_vars(get_class());

        $this->columns = array_diff_key($objectVars, $sqlVars);
    }

    public function save()
    {
        $pdo = Db::getInstance();

        if (empty($this->id)) {
            $data = [];
            unset($this->columns['id']);

            $sqlCol = null;
            $sqlKey = null;
            foreach ($this->columns as $column => $value) {
                if (in_array($column, $this->foreignValues)) {
                    $id = $this->$column->getId();
                    $column = 'id_' . $column;
                    $data[$column] = $id;
                } else {
                    $data[$column] = $this->$column;
                }

                $sqlCol .= ',' . $column;
                $sqlKey .= ',:' . $column;
            }
            $sqlCol = ltrim($sqlCol, ',');
            $sqlKey = ltrim($sqlKey, ',');

            $query = $pdo->prepare(
                "INSERT INTO " . $this->table .
                " (" . $sqlCol . ")" .
                " VALUES " .
                "(" . $sqlKey . ");"
            );

            $query->execute($data);
        } else {

            $data = [];
            $sqlSet = [];
            foreach ($this->columns as $column => $key) {
                if (in_array($column, $this->foreignValues)) {
                    $id = $this->$column->getId();
                    $column = 'id_' . $column;
                    $data[$column] = $id;
                } else {
                    $data[$column] = $this->$column;
                }

                $sqlSet[] = $column . '=:' . $column;
            }

            $query = $pdo->prepare(
                "UPDATE " . $this->table . ' SET updated_at = sysdate(), ' . implode(',',
                    $sqlSet) . ' WHERE id = :id;'
            );
            $query->execute($data);
        }
    }

    public function populate($condition)
    {
        $conditionQuery = '';
        foreach ($condition as $field => $value) {
            $conditionQuery .= $field . ' = :' . $field . ' AND ';
        }
        $conditionQuery = trim($conditionQuery, ' AND ');

        $query = Db::getInstance()->prepare(
            'SELECT * FROM ' . $this->table . ' WHERE ' . $conditionQuery
        );
        $query->execute($condition);

        if ($query->rowCount() > 1) {
            return false;
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }

        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }

    public function fill(array $data)
    {
        foreach ($data as $field => $value) {
            $functionName = 'set' . ucfirst($field);

            if (!method_exists($this, $functionName)) {
                continue;
            }

            if (in_array($field, $this->foreignValues)) {
                continue;
            }

            $this->{$functionName}($value);
        }
    }

    public function getAll()
    {
        $db = Db::getInstance();

        $sql = 'SELECT * FROM ' . $this->table;

        $query = $db->query($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->table);

        $entities = $query->fetchAll();

        return $entities;
    }

    public function getPage($size, $page)
    {
        $db = Db::getInstance();

        $start = $size * ($page - 1);
        $end = $start + $size;

        $sql = 'SELECT * FROM ' . $this->table . ' LIMIT ' . $start . ',' . $end;

        $query = $db->query($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->table);

        $entities = $query->fetchAll();

        return $entities;
    }

    public function countAll()
    {
        $db = Db::getInstance();

        $sql = 'SELECT COUNT(*) FROM ' . $this->table;
        $query = $db->query($sql);

        $data = $query->fetch(PDO::FETCH_NUM);
        if (!isset($data[0])) {
            return 0;
        }

        return $data[0];
    }
}
