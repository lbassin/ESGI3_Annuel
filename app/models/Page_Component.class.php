<?php

class Page_Component extends Sql
{
    protected $id;
    protected $id_page;
    protected $position;
    protected $template_id;
    protected $config;

    public function __construct()
    {
        $this->belongsTo(['page']);

        parent::__construct();
    }

    private function getComponentXml($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id();
        }

        // TODO : Change to getCurrentThemeDirectory();
        $filePath = 'themes/templates/default/components/template' . $templateId . '.xml';

        if (!file_exists($filePath)) {
            Helpers::error404();
        }

        $xml = new Xml($filePath);
        if (!$xml->open()) {
            Helpers::error404();
        }
        return $xml;
    }

    public function getConstraints($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id();
        }

        $xml = $this->getComponentXml($templateId);
        $constraints = $xml->getNodeAsArray('validate');
        if (!$constraints) {
            return [];
        }

        return $constraints;
    }

    public function getPreview($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id();
        }

        $xml = $this->getComponentXml($templateId);
        $preview = $xml->getNode('header/preview', true);
        if (!$preview) {
            return [];
        }

        return $preview;
    }

    public function getFormConfig($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id;
        }

        $filePath = 'themes/templates/default/components/template' . $templateId . '.xml';

        $xml = new Xml($filePath);
        $config = $xml->xmlFormConfigToArray();

        return $config;
    }

    public function save()
    {
        $config = $this->config;
        $config = unserialize($config);

        if (!empty($config['path'])) {
            $name = uniqid();
            $extension = pathinfo($config['path'])['extension'];
            rename($config['path'], FILE_UPLOAD_PATH . "/" . $name . "." . $extension);
            $config['path'] = FILE_UPLOAD_PATH . "/" . $name . "." . $extension;
        }
        $this->config(serialize($config));

        return parent::save();
    }
}