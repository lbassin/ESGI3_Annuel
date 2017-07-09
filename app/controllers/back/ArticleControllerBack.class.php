<?php

class ArticleControllerBack extends Controller
{
    public function saveAction($params = [])
    {
        $this->check((isset($postData['token'])) ? $postData['token'] : '');

        if (!isset($params[Routing::PARAMS_POST])) {
            $params[Routing::PARAMS_POST] = [];
        }
        $data = $params[Routing::PARAMS_POST];

        $this->validateNewPage($data);
        if (count(Session::getErrors()) > 0) {
            Session::setFormData($data);
            Helpers::redirectBack();
        }

        try {
            $page = new Article();
            $page->fill($data);
            $page->save();

            $order = 1;
            foreach ($data['components'] as $componentData) {
                $componentData = json_decode($componentData, true);
                $templateId = $componentData['template_id'];
                unset($componentData['template_id']);

                /** @var Page_Component $component */
                $component = new Page_Component();
                $component->setPageId($page->getId());
                $component->setTemplateId($templateId);
                $component->setOrder($order);
                $component->setConfig($componentData);
                $order += 1;

                $component->save();
            }
        } catch (Exception $ex) {
            Session::addError($ex->getMessage());
            Helpers::redirectBack();
        }

        Session::addSuccess('Composant ajouté');
        Helpers::redirect(Helpers::getAdminRoute('page'));
        return true;
    }

    private function validateNewPage(array $data)
    {
        $page = new Page();

        $validator = new Validator($data, Page::class);
        $validator->validate($page->getConstraints());

        foreach ($data['components'] as $componentData) {
            $componentData = json_decode($componentData, true);

            /** @var Page_Component $component */
            $component = new Page_Component();
            $component->setTemplateId($componentData['template_id']);

            $validatorComponent = new Validator($componentData);
            $validatorComponent->validate($component->getConstraints());
        }
    }
}
