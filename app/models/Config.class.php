<?php

class Config extends Sql implements Editable
{
    protected $id;
    protected $name;
    protected $value;
    protected $old_value;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }

    public function getSetupForm()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => '?step=3',
                'hide_header' => true,
                Editable::MODEL_ID => '',
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
                Editable::MODEL_URL => '?step=5',
                'hide_header' => true,
                Editable::MODEL_ID => '',
                Editable::FORM_SUBMIT => 'Next step',
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

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('config'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Config',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'name' => [
                            'type' => 'text',
                            'label' => 'Content :',
                            'class' => 'two-col',
                            'value' => $this->name()
                        ],
                        'value' => [
                            'type' => 'text',
                            'label' => 'Value :',
                            'class' => 'two-col',
                            'value' => $this->value()
                        ],
                        'old_value' => [
                            'type' => 'hidden',
                            'value' => $this->value()
                        ],
                    ]
                ]
            ]
        ];
    }

    public function setupValidate()
    {
        return [
            'name' => [
                'required' => true,
                'min' => 2
            ],
            'base_path' => [
                'required' => true
            ],
            'admin_path' => [
                'required' => true,
                'min' => 2
            ],
            'db_user' => [
                'required' => true,
            ],
            'db_host' => [
                'required' => true,
                'min' => 2
            ],
            'db_port' => [
                'required' => true,
            ]
        ];
    }

    public function validate()
    {
        return [
            'name' => [
                'required' => true,
            ],
            'value' => [
                'required' => true,
            ],
            'old_value' => [
                'required' => true,
            ],
        ];
    }
}