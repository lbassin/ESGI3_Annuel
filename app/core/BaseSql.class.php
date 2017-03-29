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


            $pdo = new Db();
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

            $pdo = new Db();
            $query = $pdo->prepare(
                "UPDATE " . $this->table . ' SET date_updated = sysdate(), ' . implode(',',
                    $sqlSet) . ' WHERE id = :id;'
            );
            $query->execute($data);
        }
    }

    // $condition = [ "id" => 3 ]
    // La fonction va alimenter l'objet suite a une requete sql
    // Attention la requete ne doit retourner qu'une seule valeur /!\
    // Si plusieurs valeurs => Die ou laisse l'objet vide
    public function populate($condition)
    {
        echo '<pre>';
        print_r($condition);

        echo implode(' AND ', $condition);

        $query = $this->db->prepare(
            'SELECT * FROM ' . $this->table . ' WHERE '
        );


    }

}
