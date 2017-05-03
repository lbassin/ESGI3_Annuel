<?php

class SetupControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'setup/index', 'setup');
    }

    public function infosAction()
    {
        $view = new View('back', 'setup/infos', 'setup');

        $config = new Config();
        $view->assign('config', $config);
    }

    public function saveAction($params)
    {

        $sampleConfig = new File('conf.inc.php.sample');
        $config = $sampleConfig->getContent();

        foreach ($params as $setting => $value) {
            $key = 'CONF_' . strtoupper($setting);

            if ($key == 'CONF_BASE_PATH') {
                $value = ltrim($value, '/');
                $config = str_replace('{{' . $key . '_PATTERN}}', $value, $config);
            }

            $config = str_replace('{{' . $key . '}}', $value, $config);
        }

        $newConfig = new File('conf.inc.php');
        $newConfig->setContent($config);

        die;
    }

}
