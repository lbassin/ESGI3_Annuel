<?php

class RssControllerFront
{

    public function indexAction($params)
    {
        $url = $params[Routing::PARAMS_URL];
        if (isset($url[1])) {
            $rss = new Rss();
            echo $rss->GenerateRss($url[1]);
        } else {
            Helpers::error404();
        }
    }

}
