<?php

class Media extends BaseSql implements Listable, Editable
{
    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $extension;
    protected $user;

    public function __construct()
    {
        $this->foreignValues = ['user'];

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getUser()
    {
        if (!isset($this->user)) {
            if (!isset($this->id_user)) {
                return new User;
            }
            $user = new User;
            $user->populate(['id' => $this->id_user]);
            return $user;
        }
        return $this->user;
    }

    public function setUser($user)
    {
        if ($user instanceof User) {
            $this->user = $user;
        } else {
            $newUser = new User();
            $newUser->populate(['id' => intval($user)]);
            $this->user = $newUser;
        }
    }

    public function display()
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
            $mediaData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $media->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $media->getName()
                ],
                [
                    'type' => 'text',
                    'value' => $media->getPath()
                ],
                [
                    'type' => 'text',
                    'value' => $media->getType()
                ],
                [
                    'type' => 'text',
                    'value' => $media->getExtension()
                ],
                [
                    'type' => 'text',
                    'value' => $media->getUser()->getFirstName() . ' ' . $media->getUser()->getLastName()
                ],
                [
                    'type' => 'action',
                    'id' => $media->getId()
                ]
            ];

            $listData[] = $mediaData;
        }

        return $listData;
    }

    public function upload(array $file)
    {
        if (!file_exists(FILE_UPLOAD_PATH)) {
            if (!mkdir(FILE_UPLOAD_PATH)) {
                Session::addError('Création du fichier d\'upload impossible, vérifiez les droits !');
            }
        }

        $filePath = FILE_UPLOAD_PATH . '/' . uniqid() . "." . strtolower($this->getExensionFromFile($file['image']['name']));
        if (!move_uploaded_file($file['image']['tmp_name'], $filePath)) {
            Session::addError('Une erreur est intervenu dans le dossier de destination');
        }
        return $filePath;
    }

    public function getExensionFromFile($file)
    {
        $extension = new SplFileInfo($file);
        return $extension->getExtension();
    }

    public function validate(array $data)
    {
        // Check data given for the input name
        if (!isset($data['post']['name'])) {
            Session::addError('Veuillez remplir le champ nom');
        } elseif (strlen($data['post']['name']) > 255) {
            Session::addError('Le champ nom est trop long');
        }
        // Check error from file
        if (!isset($data['files']['image'])) {
            Session::addError('Aucun fichier renseigné');
        }
        if ($data['files']['image']['error'] != 0) {
            File::errorUpload($data['files']['image']['error']);
        }
        $allowedExtension = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'ttf'];
        if (!in_array($this->getExensionFromFile($data['files']['image']['name']), $allowedExtension)) {
            Session::addError('L\'extension du fichier n\'est pas autorisé');
        } elseif ($data['files']['image']['size'] > FILE_UPLOAD_MAX_SIZE) {
            Session::addError('Le fichier séléctionné est trop volumineux');
        }
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('media'),
                Editable::MODEL_ID => $this->getId(),
                Editable::FORM_SUBMIT => 'Sauvegarder',
                Editable::FORM_FILE => 1
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Media',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->getId()
                        ],
                        'name' => [
                            'type' => 'text',
                            'label' => 'Nom :',
                            'value' => $this->getName()
                        ],
                        'image' => [
                            'type' => 'file',
                            'label' => 'Media :',
                            'accept' => 'image/*'
                        ]
                    ]
                ]
            ]
        ];
    }
}
