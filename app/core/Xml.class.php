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

        if (empty($node)) {
            return $asString ? '' : new SimpleXMLElement('');
        }

        if (is_array($node)) {
            $node = $node[0];
        }

        if ($asString) {
            return trim((string)$node);
        }
        return $node;
    }

    public function getNodeAsArray($path)
    {
        $node = $this->file->xpath($path)[0];
        $children = [];
        foreach ($node as $key => $value) {
            $children[$key] = (array)$value;
        }

        return $children;
    }

    public function xmlFormConfigToArray($xmlPath = null)
    {
        if (!$xmlPath) {
            $xmlPath = $this->filename;
        }

        $xml = new Xml($xmlPath);
        if (!$xml->open()) {
            return [];
        }

        $config = [];
        $groups = [];
        /** @var SimpleXMLElement $config */
        foreach ($xml->getNode('config/groups') as $xmlConfig) {
            $group = [];
            $group[Editable::GROUP_LABEL] = (String)$xmlConfig->xpath('label')[0];
            $group[Editable::GROUP_FIELDS] = [];

            $fields = $xmlConfig->xpath('fields')[0];
            /** @var SimpleXMLElement|array $attributes */
            foreach ($fields as $field => $attributes) {
                $fieldConfig = [];

                $fieldConfig['label'] = (string)$attributes['label'];
                $fieldConfig['type'] = (string)$attributes['type'];
                $fieldConfig['id'] = (string)$attributes['id'];
                $fieldConfig['script'] = (string)$attributes['script'];

                $group[Editable::GROUP_FIELDS][$field] = $fieldConfig;
            }

            $groups[] = $group;
        }

        $config[Editable::FORM_GROUPS] = $groups;
        $config[Editable::FORM_STRUCT] = [
            'method' => 'post',
            'action' => '#',
            'hide_header' => 1,
            'submit' => $xml->getNode('config/struct/submit', true),
            'file' => $xml->getNode('config/struct/file', true)
        ];

        return $config;
    }

}
