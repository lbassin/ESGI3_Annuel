<?php
class Media extends BaseSql implements Listable
{
    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $extension;
    protected $user;

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
}
