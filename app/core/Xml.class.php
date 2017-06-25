<?php

/**
 * Class Xml
 */
class Xml
{
    /** @var String $filename */
    private $filename;
    /** @var SimpleXMLElement */
    private $file;

    /**
     * Xml constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return bool
     */
    public function open()
    {
        if (!file_exists($this->filename)) {
            return false;
        }

        $this->file = simplexml_load_file($this->filename);
        return true;
    }


    /**
     * @param $path
     * @param bool $asString
     *
     * @return SimpleXMLElement|string|false
     */
    public function getNode($path, $asString = false)
    {
        /** @var SimpleXMLElement $node */
        $node = $this->file->xpath($path);

        if (is_array($node)) {
            $node = $node[0];
        }

        if ($asString) {
            return trim((string)$node);
        }
        return $node;
    }

}
