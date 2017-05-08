<?php

class SetupControllerBack
{
    private $schemaSetup = [
        'schema/init',
        'schema/role',
        'schema/user',
        'schema/survey',
        'schema/survey_answer',
        'schema/survey_answer_user',
        'schema/category',
        'schema/article',
        'schema/article_category',
        'schema/comment',
        'schema/config',
        'schema/media',
        'schema/media_article',
        'schema/page',
        'schema/media_page',
        'schema/menu',
        'schema/theme',
        'data/role'
    ];

    function __construct()
    {
        $step = 1;
        if (isset($_GET['step'])) {
            $step = $_GET['step'];
        }

        $function = 'step' . ucfirst($step);
        if (method_exists($this, $function)) {
            $this->$function();
        }
    }


    public function step1()
    {
        $view = new View('back', 'setup/index', 'setup');
        $view->assign('step', 1);
    }

    public function step2()
    {
        $view = new View('back', 'setup/infos', 'setup');

        $config = new Config();
        $view->assign('config', $config);
        $view->assign('step', 2);
    }

    public function step3()
    {
        $_SESSION['data_config'] = $_POST;
        if (!$this->validateSetupInformation($_SESSION['data_config'])) {
            Helpers::redirectBack();
        }

        $view = new View('back', 'setup/database', 'setup');

        $view->assign('setupFiles', $this->schemaSetup);
        $view->assign('step', 3);
    }

    private function validateSetupInformation($data)
    {
        $errors = [];

        $notEmpty = [
            'name',
            'base_path',
            'admin_path',
            'db_user',
            'db_password',
            'db_host',
            'db_port',
            'db_name'
        ];

        foreach ($notEmpty as $field) {
            if (empty($data[$field])) {
                $errors[$field] = 'Shouldn\'t be empty';
            }
        }

        if (!Db::tryCredentials($data['db_host'], $data['db_user'], $data['db_password'], $data['db_name'], $data['db_port'])) {
            $errors['global'][] = 'Fail to connect to database';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return false;
        }
        return true;
    }

    public function step4()
    {
        $view = new View('back', 'setup/files', 'setup');
        $view->assign('step', 4);

        try {
            $this->createHtaccessFile($_SESSION['data_config']);
            $this->createFileConfig($_SESSION['data_config']);
        } catch (Exception $ex) {
            $view->assign('error', $ex->getMessage());
        }
    }

    private function createHtaccessFile($params)
    {
        $sample = new File('.htaccess.sample');
        $content = $sample->getContent();

        $content = str_replace('{{CONF_BASE_PATH}}', $params['base_path'], $content);

        $newFile = new File('.htaccess', 'w+');
        $newFile->setContent($content);
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

        include 'conf.inc.php';
    }

    public function step5()
    {
        $view = new View('back', 'setup/success', 'setup');
        $view->assign('step', 5);
    }

    public function stepInstallDatabase()
    {
        define('DB_HOST', $_SESSION['data_config']['db_host']);
        define('DB_PORT', $_SESSION['data_config']['db_port']);
        define('DB_USER', $_SESSION['data_config']['db_user']);
        define('DB_PWD', $_SESSION['data_config']['db_password']);
        define('DB_NAME', $_SESSION['data_config']['db_name']);

        $jsonData = $this->getPostData();

        if (!isset($jsonData['setup'])) {
            return false;
        }
        $setupFilename = $jsonData['setup'];

        $db = Db::getInstance();

        $rowAffected = null;
        try {
            $setup = new File('app/assets/setup/' . $setupFilename . '.sql');
            $query = $setup->getContent();

            $rowAffected = $db->exec($query);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            Helpers::error500();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            Helpers::error500();
        }

        if ($rowAffected === false) {
            echo 'ERROR.';
            Helpers::error500();
        }
    }

    private function getPostData()
    {
        $jsonPost = file_get_contents('php://input');
        $jsonData = json_decode($jsonPost, true);
        if (!is_array($jsonData)) {
            return [];
        }

        return $jsonData;
    }
}
