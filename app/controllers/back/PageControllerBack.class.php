<?php

/**
 * Class PageControllerBack
 */
class PageControllerBack extends Controller
{
    public function saveAction($params = [])
    {
        if (!isset($params[Routing::PARAMS_POST])) {
            $params[Routing::PARAMS_POST] = [];
        }
        $data = $params[Routing::PARAMS_POST];

        $this->check((isset($data['token'])) ? $data['token'] : '');

        $this->validateNewPage($data);
        if (count(Session::getErrors()) > 0) {
            Session::setFormData($data);
            Helpers::redirectBack();
        }

        try {
            $page = new Page();
            $page->fill($data);
            $page->save();

            $order = 1;
            foreach ($data['components'] as $componentData) {
                $componentData = json_decode($componentData, true);
                $templateId = $componentData['template_id'];
                $componentId = isset($componentData['id']) ? $componentData['id'] : null;
                unset($componentData['template_id']);
                unset($componentData['id']);

                /** @var Page_Component $component */
                $component = new Page_Component();
                $component->setId($componentId);
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
        if (isset($params[Routing::PARAMS_GET]['redirectToEdit'])) {
            Helpers::redirect(Helpers::getAdminRoute('page/edit/' . $page->getId()));
        } else {
            Helpers::redirect(Helpers::getAdminRoute('page'));
        }
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
