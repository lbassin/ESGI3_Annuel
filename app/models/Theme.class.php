<?php

/**
 * Class Theme
 */
class Theme extends Sql implements Listable, Editable
{
    protected $id;
    protected $name;
    protected $directory;
    protected $is_selected;
    protected $version;
    protected $author;
    protected $description;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }

    /**
     * @return array
     */
    public function getListConfig()
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Themes',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('theme/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('theme/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Nom',
                    'Utilisé',
                    'Description',
                    'Autheur',
                    'Version',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData($configList = null)
    {
        $limits = [
            'limit' => $configList['size'],
            'offset' => $configList['size'] * ($configList['page'] - 1)
        ];
        $themes = $this->getAll([], $limits);

        $listData = [];
        /** @var User $user */
        foreach ($themes as $theme) {
            $themeData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $theme->id()
                ],
                [
                    'type' => 'text',
                    'value' => $theme->name()
                ],
                [
                    'type' => 'text',
                    'value' => $theme->is_selected() ? 'Oui' : 'Non'
                ],
                [
                    'type' => 'text',
                    'value' => $theme->description()
                ],
                [
                    'type' => 'text',
                    'value' => $theme->author()
                ],
                [
                    'type' => 'text',
                    'value' => $theme->version()
                ],
                [
                    'type' => 'action',
                    'id' => $theme->id()
                ]
            ];
            $listData[] = $themeData;
        }
        return $listData;
    }

    public function getFormConfig()
    {
        // TODO: Implement getFormConfig() method.
    }
}