<?php
class Media extends Sql implements Listable, Editable, Uploadable
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

    public function diplay()
    {
        if ($this->type == 'image') {
            $link = Helpers::getMedia($this->path);
            return '<img src="' . $link . '">';
        }
    }

    public function getListConfig()
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
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData()
    {
        $medias = $this->getAll();

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

    public function upload(array $file)
    {
        if (!file_exists(FILE_UPLOAD_PATH)) {
            if(!mkdir(FILE_UPLOAD_PATH)) {
                Session::addError('Création du fichier d\'upload impossible, vérifiez les droits !');
            }
        }
        echo 1;
        $this->extension = strtolower($this->getExensionFromFile($file['image']['name']));
        echo $this->extension;
        $this->type = $file['image']['type'];
        $this->path = FILE_UPLOAD_PATH.'/'.uniqid().".".$this->extension;

        if(!move_uploaded_file($file['image']['tmp_name'], $this->path)) {
            Session::addError('Une erreur est intervenu dans le dossier de destination');
        }
    }

    public function getExensionFromFile($file)
    {
        $extension = new SplFileInfo($file);
        return $extension->getExtension();
    }

    public function validate()
    {
        return [
            'name' => [
                'required' => true,
                'min' => 2,
                'max' => 255
            ],
            'path' => [
                'unique' => true,
                'required' => true,
                'trueMedia' => true,
            ],
            'extension' => [
                'whiteList' => 'media',
                'required' => true,
            ],
            'type' => [
                'required' => true,
            ]
        ];
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
                        'extension' => [
                            'type' => 'hidden',
                            'value' => $this->extension()
                        ],
                        'type' => [
                            'type' => 'hidden',
                            'value' => $this->type()
                        ],
                        'path' => [
                            'type' => 'hidden',
                            'value' => $this->path()
                        ]
                    ]
                ]
            ]
        ];
    }
}
