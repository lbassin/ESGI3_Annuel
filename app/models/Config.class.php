<?php
class Config extends BaseSql
{
    protected $id;
    protected $name;
    protected $value;
    protected $old_value;

    public function __construct(
        $id = -1,
        $name = null,
        $value = null,
        $old_value = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setValue($value);
        $this->setOldValue($old_value);

        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getOldValue()
    {
        return $this->old_value;
    }

    public function setOldValue($old_value)
    {
        $this->old_value = $old_value;
    }

}