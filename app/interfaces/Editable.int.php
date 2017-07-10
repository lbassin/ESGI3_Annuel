<?php

Interface Editable
{
    const FORM_STRUCT = 'struct';
    const FORM_GROUPS = 'groups';
    const FORM_METHOD = 'method';
    const FORM_ACTION = 'action';
    const FORM_SUBMIT = 'submit';
    const FORM_FILE = 'file';
    const GROUP_LABEL = 'label';
    const GROUP_FIELDS = 'fields';
    const MODEL_URL = 'model_url';
    const MODEL_ID = 'model_id';

    public function getFormConfig();
}