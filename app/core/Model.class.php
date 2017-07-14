<?php

abstract class Model
{
    const PREFIX_FOREIGN = 'id_';
    const ID = 'id';
    protected $belongsTo = [];
    protected $hasMany = [];
    protected $manyMany = [];

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

    public function toArray()
    {
        $array = get_object_vars($this);
        if (isset($array['belongsTo'])) {
            foreach ($array['belongsTo'] as $table) {
                if (is_object($array[$table])) {
                    $array[self::PREFIX_FOREIGN.$table] = (int) $array[$table]->id();
                    unset($array[$table]);
                }
            }
        }
        unset($array['belongsTo']);
        unset($array['hasMany']);
        unset($array['manyMany']);
        return $array;
    }

    public function toClass(array $data)
    {
        foreach ($data as $column => $value) {
            $this->$column = $value;
        }
    }

    public function belongsTo(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->belongsTo[] = $currentTable;
            }
        }
    }

    public function getBelongsTo()
    {
        return $this->belongsTo;
    }

    public function hasMany(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->hasMany[] = $currentTable;
            }
        }
    }

    public function ManyMany(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->manyMany[] = $currentTable;
            }
        }
    }
}