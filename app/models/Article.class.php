<?php

class Article extends Sql implements Editable, Listable
{
    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $url;
    protected $publish;
    protected $template_id;
    protected $id_user;
    protected $id_survey;

    public function __construct($data = '')
    {
        $this->ManyMany(['category']);

        parent::__construct($data);
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('article'),
                Editable::MODEL_ID => $this->getId(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Choix du template',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'article/new',
                            'data' => '',
                            'script' => 'wysiwyg.js'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getListConfig()
    {
        return [
            'struct' => [
                'title' => 'Articles',
                'newLink' => Helpers::getAdminRoute('article/new'),
                'header' => [
                    '',
                    'ID',
                    'Title',
                    'Content',
                    'Url',
                    'Action'
                ]
            ],
            'rows' => $this->getListData()
        ];
    }

    public function getListData()
    {
        $articles = $this->getAll();

        $listData = [];

        /** @var Article $article */
        foreach ($articles as $article) {
            $articleData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $article->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getTitle()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getContent()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getUrl()
                ],
                [
                    'type' => 'action',
                    'id' => $article->getId()
                ]
            ];

            $listData[] = $articleData;
        }

        return $listData;
    }

    public function getTemplates()
    {
        $templates = [];
        $directoryPath = 'themes/templates/default/articles/'; // TODO : Change to getCurrentThemeDirectory();
        $directory = opendir($directoryPath);

        while ($file = readdir($directory)) {
            if ($file == '.' || $file == '..' || pathinfo($file)['extension'] != 'xml') {
                continue;
            }

            $templatePath = $directoryPath . $file;
            $xml = new Xml($templatePath);
            if (!$xml->open()) {
                continue;
            }

            $templates[] = [
                Page::TEMPLATE_ID => $xml->getNode('header/id', true),
                Page::TEMPLATE_NAME => $xml->getNode('header/name', true),
                Page::TEMPLATE_PREVIEW => $xml->getNode('header/example', true)
            ];
        }

        return $templates;
    }

    public function getTemplateFormConfig($templateId = null)
    {
        if (!$templateId) {
            $templateId = $this->template_id;
        }

        $filePath = 'themes/templates/default/articles/template' . $templateId . '.xml';
        $xml = new Xml($filePath);
        $config = $xml->xmlFormConfigToArray();

        return $config;
    }
}
