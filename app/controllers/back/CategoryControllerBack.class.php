<?php

class CategoryControllerBack extends Controller
{
    public function saveAction($params = [], $multiple = false, $table = false)
    {
        if (isset($params[Routing::PARAMS_POST]['url'])) {
            if (!empty($params[Routing::PARAMS_POST]['url'])) {
                $params[Routing::PARAMS_POST]['url'] = Helpers::slugify($params[Routing::PARAMS_POST]['url']);
            }
        }
        return parent::saveAction($params, $multiple, $table);
    }
}
