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

        $view->assign('setupFiles', $this->schemaSetup);
        //$this->createFileConfig($params);
    }

    public function stepInstallDatabase()
    {
        $_SESSION['data_config']['db_host'] = 'mysql-server';
        $_SESSION['data_config']['db_port'] = '3306';
        $_SESSION['data_config']['db_user'] = 'root';
        $_SESSION['data_config']['db_password'] = 'root_password!';


        define('DB_HOST', $_SESSION['data_config']['db_host']);
        define('DB_PORT', $_SESSION['data_config']['db_port']);
        define('DB_USER', $_SESSION['data_config']['db_user']);
        define('DB_PWD', $_SESSION['data_config']['db_password']);
        define('DB_NAME', 'demo');

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
