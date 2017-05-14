<?php

Interface Listable
{
    const LIST_STRUCT = 'struct';
    const LIST_TITLE = 'title';
    const LIST_NEW_LINK = 'newLink';
    const LIST_EDIT_LINK = 'editLink';
    const LIST_HEADER = 'header';
    const LIST_ROWS = 'rows';
    const LIST_LABEL = 'label';


    public function getListConfig();

    public function getListData();
}