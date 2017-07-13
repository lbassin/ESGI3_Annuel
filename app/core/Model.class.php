<?php

abstract class Model
{
    const PREFIX_FOREIGN = 'id_';
    protected $foreignValues = [];
    protected $hasMany = [];

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
                if (substr($method, 0, 3) != 'id_') {
                    $this->$method = $arguments[0];
                } else {
                    $className = substr($method, 3);
                    $this->$method = new $className($arguments[0]);
                }
            }  else {
                return $this->$method;
            }
        } elseif (substr($method, 0, 3) == 'get' && in_array($table = lcfirst(substr($method, 3)), $this->hasMany)){
            $this->querySet($table);
        }
    }

    public function toArray()
    {
        $array = get_object_vars($this);
        if (isset($array['foreignValues'])) {
            foreach ($array['foreignValues'] as $foreignValue) {
                $getter = 'get'.ucfirst($foreignValue);
                $array[self::PREFIX_FOREIGN.$foreignValue] = (int) $this->$getter()->getId();
                unset($array[$foreignValue]);
            }
            unset($array['foreignValues']);
        }
        return $array;
    }

    public function toClass(array $data)
    {
        foreach ($data as $column => $value) {
            $this->$column = $value;
        }
    }

    public function foreignKey(array $foreign = [])
    {
        if (!empty($foreign)) {
            foreach ($foreign as $currentForeign) {
                $this->foreignValues[] = $currentForeign;
            }
        }
    }

    public function hasMany(array $tables = [])
    {
        if (!empty($tables)) {
            foreach ($tables as $currentTable) {
                $this->hasMany[] = $currentTable;
            }
        }
    }

    /*
     * public function __call($method,$arguments){
		$array_attributes = get_object_vars($this);
		if(array_key_exists($method,$array_attributes)){
			if(!empty($arguments)){
				$this->$method = $arguments[0];
			}else{
				return $this->$method;
			}
		}
	}

	static function __callStatic($method, $arguments){
		/return QuerySetEngine::querySet(strtolower(get_called_class()), (substr($method, 0, 3) == 'get')? strtolower(substr($method, 3)) : NULLL, $arguments[0]);
	}
     * */
}