<?php

class Sql extends Model
{
    const ID = 'id';
    const PREFIX_ID = 'id_';
    const DEFAULT_LIMIT = 1;
    const DEFAULT_OFFSET = 0;
    const TABLE = '';
    private $pdo;
    private $query;
    private $table;
    private $data = [];
    private $condition = ' WHERE 1 = 1 ';
    private $limit;
    private $order;

    function __construct($data = '')
    {
        $this->pdo = Db::getInstance();
        $this->table = lcfirst(get_called_class());
        parent::__construct($data);
    }

    public function querySet($table){
        $destinationTable = Helpers::renameValuePlural($table);
        $array = [$this->table, ucfirst($table)];
        sort($array);
        $joinTable = implode('_', $array);
        $classJoin = new $joinTable([self::PREFIX_FOREIGN.$this->table => $this->id]);

        $tmpStock = $classJoin->getAll([self::PREFIX_FOREIGN.$this->table => $this->id]);
        foreach ($tmpStock as $tmp) {
            $id = self::PREFIX_FOREIGN.$table;
            $class = new $table([self::ID => $tmp->$id]);
            $class->populate();
            $this->$destinationTable[] = $class;
        }
    }

    public function count(array $condition = [])
    {
        $this->where($condition);
        $this->query = $this->pdo->prepare('SELECT count(*) as count FROM ' . $this->table . $this->condition);
        $this->query->execute($this->data);
        return $this->query->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getAll(array $condition = [])
    {
        $this->where($condition);
        $this->query = $this->pdo->prepare('SELECT * FROM ' . $this->table . $this->condition);
        $this->query->execute($this->data);
        $this->query->setFetchMode(PDO::FETCH_CLASS, ucfirst($this->table));
        $listObject = $this->query->fetchAll();
        foreach ($listObject as $key => $currentObject) {
            if (!empty($currentObject->foreignValues) && $currentObject->foreignValues != 'user') {
                foreach ($currentObject->foreignValues  as $foreignValue) {
                    $currentObject->$foreignValue($this->getForeignKey($currentObject, $foreignValue));
                }
            }
        }
        return $listObject;
    }

    private function getForeignKey($object, $foreignValue)
    {
        $className = ucfirst($foreignValue);
        $class = new $className();
        $champId = self::PREFIX_FOREIGN . $foreignValue;
        $id = $object->$champId;
        $class->populate([self::ID => $id]);
        return $class;
    }

    public function populate(array $condition = [])
    {
        $this->where($condition);
        $this->query = $this->pdo->prepare('SELECT * FROM ' . $this->table . $this->condition);
        $this->query->execute($this->data);
        $data = $this->query->fetch(PDO::FETCH_ASSOC);
        $this->toClass($data);
    }

    public function save()
    {
        $this->data = $this->toArray();
        if (empty($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
        try {
            $this->query->execute($this->data);
            return ($this->pdo->lastInsertId() != null) ? (int) $this->pdo->lastInsertId() : null;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function insert()
    {
        $this->query = $this->pdo->prepare(
            'INSERT INTO ' . $this->table . ' (' .
                implode(', ', array_keys($this->data)) .
            ' ) VALUES (:' .
                implode(', :', array_keys($this->data)) .
            ')'
        );
    }

    private function update()
    {
        $queryString = 'UPDATE ' . $this->table . ' SET ';
        foreach ($this->data as $column => $value) {
            if ($column != self::ID) {
                $queryString .= $column. ' =:'.$column . ',';
            }
        }
        $queryString .= ' updated_at = sysdate()' . $this->condition . ' AND ' . self::ID . ' =:' . self::ID;
        $this->query = $this->pdo->prepare($queryString);
    }

    public function delete(array $conditionQuery)
    {
        $this->where($conditionQuery);
        $this->query = $this->pdo->prepare('DELETE FROM ' . $this->table . $this->condition);
        try {
            $this->query->execute($this->data);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function where(array $conditionQuery)
    {
        foreach ($conditionQuery as $column => $value) {
            $this->condition .= ' AND ' . $column . '=:' . $column;
            $this->data[$column] = $value;
        }
    }

    private function setLimit(array $limitQuery = [])
    {
        if (!empty($limitQuery)) {
            $this->limit = ' LIMIT ' . (isset($limitQuery['limit']) ? $limitQuery['limit'] : self::DEFAULT_LIMIT) . ' OFFSET ' . (isset($limitQuery['offset']) ? $limitQuery['offset'] : self::DEFAULT_OFFSET);
        }
    }

    private function setOrder(array $orderQuery = [])
    {
        if (!empty($orderQuery)) {
            $orderString = ' ORDER BY ';
            foreach ($orderQuery as $column => $order) {
                $orderString .= $column . ' ' . $order . ',';
            }
            $this->order = substr($orderString, 0, -1);
        }
    }
}