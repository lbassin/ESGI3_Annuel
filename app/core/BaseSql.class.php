<?php

class BaseSql
{

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

        if ($this->id == -1) {
            $data = [];
            unset($this->columns['id']);

            $sqlCol = null;
            $sqlKey = null;
            foreach ($this->columns as $column => $value) {
                $data[$column] = $this->$column;
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
                $data[$column] = $this->$column;
                $sqlSet[] = $column . '=:' . $column;
            }

            $query = $pdo->prepare(
                "UPDATE " . $this->table . ' SET date_updated = sysdate(), ' . implode(',',
                    $sqlSet) . ' WHERE id = :id;'
            );
            $query->execute($data);
        }
    }

    public function delete()
    {
        $pdo = Db::getInstance();
        $query = $pdo->prepare(
            "DELETE FROM " . $this->table . ' WHERE id = :id;'
        );
        $data = ['id' => $this->id];
        $query->execute($data);
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
            die('Trop de resultat');
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }

        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }

}
