<?php

abstract class Model
{
    const PREFIX_FOREIGN = 'id_';
    const ID = 'id';
    protected $belongsTo = [];
    protected $hasMany = [];
    protected $manyMany = [];

    /**
     * Set value from array to object
     * @param mixed $aData -> contain data to be set (comes from child class)
     * @var string $sClassName name of the table
     * how to use : $class = new Class(['id' => 1', ...]);
     */
    function __construct($aData = '')
    {
        if (is_array($aData)) {
            $sClassName = get_called_class();
            foreach ($aData as $sColumnName => $iColumnValue) {
                if (property_exists($sClassName, $sColumnName)) {
                    $this->$sColumnName($iColumnValue);
                }
            }
        }
    }

    /**
     * Magic Method
     * @param string $method -> Contain method called
     * @param array $arguments -> contain parameters of the method
     * @var array $array_attributes -> contain array of the current object
     * if method called is a property of the class the method called dynamically the setter or the getter
     * how to use : (getter) $class->id(); (setter) $class->id(1);
     * if method called started from 'get' the method called dynamically the join function of the child
     */
    public function __call($method,$arguments)
    {
        $array_attributes = get_object_vars($this);
        if(array_key_exists($method, $array_attributes)) {
            if(!empty($arguments)) {
                $this->$method = $arguments[0];
            }  else {
                return $this->$method;
            }
        } elseif (substr($method, 0, 3) == 'get'){
            $table = lcfirst(substr($method, 3));
            if (in_array($table, $this->hasMany)) {
                $this->queryHasMany($table);
            } elseif (in_array($table, $this->belongsTo)) {
                $this->queryBelongsTo($table);
            } elseif (in_array($table, $this->manyMany)) {
                $this->queryManyMany($table);
            }
        }
    }

    /**
     * Magic Method
     * @var array $array -> contain array of the current object
     * if in array key belongsTo and it contains object class, set foreign key to id of the object
     * unset unused key for the array
     * @return array of the current object
     * how to use : $this->toArray();
     */
    public function toArray()
    {
        $array = get_object_vars($this);
        if (isset($array['belongsTo'])) {
            foreach ($array['belongsTo'] as $table) {
                if (isset($array[$table])) {
                    if (is_object($array[$table])) {
                        $array[self::PREFIX_FOREIGN.$table] = (int) $array[$table]->id();
                        unset($array[$table]);
                    }
                }
            }
        }
        unset($array['belongsTo']);
        unset($array['hasMany']);
        unset($array['manyMany']);
        return $array;
    }

    /**
     * @param mixed $data -> contain data to be set
     * how to use : $this->toClass(['id' => 1, ...]);
     */
    public function toClass(array $data)
    {
        foreach ($data as $column => $value) {
            $this->$column = $value;
        }
    }

    /**
     * @param array $tables
     * set $this->belongsTo[] with table indicated in child class
     * how to use : $this->belongsTo(['table1', 'table2']);
     */
    public function belongsTo(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->belongsTo[] = $currentTable;
            }
        }
    }

    /**
     * @return array $this->belongsTo
     * how to use : $array = $class->getBelongsTo();
     */
    public function getBelongsTo()
    {
        return $this->belongsTo;
    }

    /**
     * @param array $tables
     * set $this->hasMany[] with table indicated in child class
     * how to use : $this->hasMany(['table1', 'table2']);
     */
    public function hasMany(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->hasMany[] = $currentTable;
            }
        }
    }

    /**
     * @param array $tables
     * set $this->ManyMany[] with table indicated in child class
     * how to use : $this->manyMany(['table1', 'table2']);
     */
    public function manyMany(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->manyMany[] = $currentTable;
            }
        }
    }
}