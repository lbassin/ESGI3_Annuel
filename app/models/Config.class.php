<?php

class Config extends BaseSql
{
    protected $id;
    protected $name;
    protected $value;
    protected $old_value;

    public function __construct(
        $id = -1,
        $name = null,
        $value = null,
        $old_value = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setValue($value);
        $this->setOldValue($old_value);

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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getOldValue()
    {
        return $this->old_value;
    }

    public function setOldValue($old_value)
    {
        $this->old_value = $old_value;
    }

    public function getSetupForm()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => '?step=3',
                Editable::FORM_SUBMIT => 'Next step',
                'submit-class' => 'button'
            ],
            Editable::FORM_GROUPS => [
                'general' => [
                    Editable::GROUP_LABEL => 'General',
                    Editable::GROUP_FIELDS => [
                        'name' => [
                            'type' => 'text',
                            'label' => 'Nom :'
                        ],
                        'base_path' => [
                            'type' => 'text',
                            'label' => 'Base Path :'
                        ],
                        'admin_path' => [
                            'type' => 'text',
                            'label' => 'Admin URL :'
                        ]
                    ]

                ],
                'database' => [
                    Editable::GROUP_LABEL => 'Base de données',
                    Editable::GROUP_FIELDS => [
                        'db_host' => [
                            'type' => 'text',
                            'label' => 'Host :'
                        ],
                        'db_port' => [
                            'type' => 'text',
                            'label' => 'Port :',
                            'value' => 3306
                        ],
                        'db_user' => [
                            'type' => 'text',
                            'label' => 'User :'
                        ],
                        'db_password' => [
                            'type' => 'password',
                            'label' => 'Password :'
                        ],
                        'db_name' => [
                            'type' => 'text',
                            'label' => 'Database :'
                        ]
                    ]
                ],
                'smtp' => [
                    Editable::GROUP_LABEL => 'SMTP',
                    Editable::GROUP_FIELDS => [
                        'smtp_host' => [
                            'type' => 'text',
                            'label' => 'Host :'
                        ],
                        'smtp_user' => [
                            'type' => 'text',
                            'label' => 'User :'
                        ],
                        'smtp_password' => [
                            'type' => 'text',
                            'label' => 'Password :'
                        ],
                        'smtp_secure' => [
                            'type' => 'select',
                            'label' => 'Secure :',
                            'options' => $this->getSmtpSecureMethods()
                        ],
                        'smtp_port' => [
                            'type' => 'text',
                            'label' => 'Port :'
                        ],
                        'smtp_sender' => [
                            'type' => 'text',
                            'label' => 'Sender :'
                        ],
                    ]
                ]
            ]
        ];
    }

    public function getAdminUserForm()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => '?step=5',
                Editable::FORM_SUBMIT => 'Next Step',
                'submit-class' => 'button'
            ],
            Editable::FORM_GROUPS => [
                'user' => [
                    Editable::GROUP_LABEL => 'Admin',
                    Editable::GROUP_FIELDS => [
                        'firstname' => [
                            'type' => 'text',
                            'label' => 'Firstname :'
                        ],
                        'lastname' => [
                            'type' => 'text',
                            'label' => 'Lastname :'
                        ],
                        'pseudo' => [
                            'type' => 'text',
                            'label' => 'Pseudo :'
                        ],
                        'email' => [
                            'type' => 'text',
                            'label' => 'Email :'
                        ],
                        'password' => [
                            'type' => 'password',
                            'label' => 'Password :'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getSmtpSecureMethods()
    {
        return [
            'Unsecure' => 0,
            'TLS' => 1,
            'SSL' => 2
        ];
    }

}