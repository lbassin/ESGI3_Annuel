<?php

class Article extends BaseSql implements Editable, Listable
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

    public function __construct()
    {
        $this->defaultValues = [
            'publish' => 0
        ];

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getContent()
    {
        return unserialize($this->content);
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getPublish()
    {
        return $this->publish;
    }

    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function setTemplateId($templateId)
    {
        $this->template_id = $templateId;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getIdSurvey()
    {
        return $this->id_user;
    }

    public function setIdSurvey($id_user)
    {
        $this->id_user = $id_user;
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
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->getId()
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

    public function getListConfig()
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
            Listable::LIST_ROWS => $this->getListData()
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
                    'value' => $article->getUrl()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getPublish() ? 'Oui' : 'Non'
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
