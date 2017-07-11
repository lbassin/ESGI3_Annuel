<?php

class Page_Component extends BaseSql
{
    protected $id;
    protected $page_id;
    protected $order;
    protected $template_id;
    protected $config;

    public function __construct()
    {
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

    public function getPageId()
    {
        return $this->page_id;
    }

    public function setPageId($pageId)
    {
        $this->page_id = $pageId;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    public function getConfig()
    {
        return unserialize($this->config);
    }

    public function setConfig($config)
    {
        $this->config = serialize($config);
    }

    private function getComponentXml($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id;
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
            $templateId = $this->template_id;
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
            $templateId = $this->template_id;
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

        $xml = $this->getComponentXml($templateId);

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