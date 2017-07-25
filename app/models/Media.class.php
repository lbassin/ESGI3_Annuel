<?php
class Media extends Sql implements Listable, Editable
{
    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $extension;

    public function __construct($data = '')
    {
        $this->belongsTo(['user']);

        parent::__construct($data);
    }

    public function display()
    {
        if ($this->type == 'image') {
            $link = Helpers::getMedia($this->path);
            return '<img src="' . $link . '">';
        }
    }

    public function getListConfig($configList = null)
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Medias',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('media/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('media/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Name',
                    'Path',
                    'Type',
                    'Extension',
                    'User',
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
        $medias = $this->getAll($search, $limits);

        $listData = [];

        foreach ($medias as $media) {
            $media->getUser();
            $mediaData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $media->id()
                ],
                [
                    'type' => 'text',
                    'value' => $media->name()
                ],
                [
                    'type' => 'text',
                    'value' => $media->path()
                ],
                [
                    'type' => 'text',
                    'value' => $media->type()
                ],
                [
                    'type' => 'text',
                    'value' => $media->extension()
                ],
                [
                    'type' => 'text',
                    'value' => $media->user()->firstname() . ' ' . $media->user()->lastname()
                ],
                [
                    'type' => 'action',
                    'id' => $media->id()
                ]
            ];

            $listData[] = $mediaData;
        }

        return $listData;
    }

    public function getExensionFromFile($file)
    {
        $extension = new SplFileInfo($file);
        return $extension->getExtension();
    }

    public function validate()
    {
        return [];
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('media'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save',
                Editable::FORM_FILE => 1,
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Media',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'name' => [
                            'type' => 'text',
                            'label' => 'Nom :',
                            'value' => $this->name()
                        ],
                        'image' => [
                            'type' => 'file',
                            'label' => 'Media :',
                            'accept' => 'image/*'
                        ],
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'media/new'
                        ]
                    ]
                ]
            ]
        ];
    }
}
