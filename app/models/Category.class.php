<?php
class Category extends Sql implements Listable, Editable
{
    protected $id;
    protected $title;
    protected $description;

    public function __construct($data = '')
    {
        $this->manyMany(['article']);

        parent::__construct($data);
    }

    public function validate()
    {
        return [
            'title' => [
                'required' => true,
                'min' => 1,
                'max' => 255,
            ],
            'description' => [
                'required' => false,
                'min' => 1,
                'max' => 255,
            ]
        ];
    }

    public function getListConfig($configList = null)
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Categories',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('category/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('category/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Title',
                    'Description',
                    'Nb Article',
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
        $categories = $this->getAll($search, $limits);

        $listData = [];

        foreach ($categories as $category) {
            $category->getArticle();
            $countArticle = count($category->articles());
            $categoryData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $category->id()
                ],
                [
                    'type' => 'text',
                    'value' => $category->title()
                ],
                [
                    'type' => 'text',
                    'value' => $category->description()
                ],
                [
                    'type' => 'text',
                    'value' => $countArticle
                ],
                [
                    'type' => 'action',
                    'id' => $category->id()
                ]
            ];
            $listData[] = $categoryData;
        }

        return $listData;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('category'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Categories',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'title' => [
                            'type' => 'text',
                            'label' => 'Title :',
                            'class' => 'two-col',
                            'value' => $this->title()
                        ],
                        'description' => [
                            'type' => 'text',
                            'label' => 'Description :',
                            'class' => 'two-col',
                            'value' => $this->description()
                        ]
                    ]
                ]
            ]
        ];
    }
}