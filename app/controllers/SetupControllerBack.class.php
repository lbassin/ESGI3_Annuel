<?php

class SetupControllerBack
{
    private $sqlSetup = [
        'user',
        'article',
        'category',
        'seed'
    ];

    function __construct()
    {
        $step = 1;
        if (isset($_GET['step'])) {
            $step = $_GET['step'];
        }

        $function = 'step' . $step;
        if (method_exists($this, $function)) {
            $this->$function();
        }
    }


    public function step1()
    {
        $view = new View('back', 'setup/index', 'setup');
    }

    public function step2()
    {
        $view = new View('back', 'setup/infos', 'setup');

        $config = new Config();
        $view->assign('config', $config);
    }

    public function step3()
    {
        $view = new View('back', 'setup/database', 'setup');

        $_SESSION['data_config'] = $_POST;

        $view->assign('sqlSetup', $this->sqlSetup);
        //$this->createFileConfig($params);
    }

    private function createFileConfig($params)
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

        $newConfig = new File('conf.inc.php', 'w+');
        $newConfig->setContent($config);
    }

}
