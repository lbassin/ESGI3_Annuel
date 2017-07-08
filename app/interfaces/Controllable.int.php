<?php

Interface Controllable
{
    public function indexAction($params = []);

    public function newAction();

    public function editAction($params = []);

    public function saveAction($params = []);

    public function deleteAction($params = []);
}