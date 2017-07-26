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

    public function __construct($data = '')
    {
        if (!isset($data['publish'])) {
            $this->publish = 0;
        }

        $this->manyMany(['category']);
        $this->belongsTo(['user', 'survey']);

        parent::__construct($data);
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('article'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Choix du template',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
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

    public function getListConfig($configList = null)
    {
        return [
            'struct' => [
                Listable::LIST_TITLE => 'Articles',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('article/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('article/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Title',
                    'Url',
                    'Publié',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData($configList)
        ];
    }

    public function getListData($configList = null)
    {
        $limits = [
            'limit' => $configList['size'],
            'offset' => $configList['size'] * ($configList['page'] - 1)
        ];
        $search = isset($configList['search']) ? ['search' =>  $configList['search']] : [];
        $articles = $this->getAll($search, $limits);

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
                    'value' => $article->id()
                ],
                [
                    'type' => 'text',
                    'value' => $article->title()
                ],
                [
                    'type' => 'text',
                    'value' => $article->url()
                ],
                [
                    'type' => 'text',
                    'value' => $article->publish() ? 'Oui' : 'Non'
                ],
                [
                    'type' => 'action',
                    'id' => $article->id()
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

    public function validate(){
        return [];
    }
}
