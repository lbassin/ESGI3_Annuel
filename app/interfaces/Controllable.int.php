<?php

Interface Controllable
{
    public function indexAction();

    public function newAction();

    public function editAction($params = []);

    public function saveAction($params = [], $multiple = false);

    public function deleteAction($params = []);
}