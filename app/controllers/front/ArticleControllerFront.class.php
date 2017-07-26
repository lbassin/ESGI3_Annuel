<?php

class ArticleControllerFront extends Front
{
    public function indexAction($params = [])
    {
        parent::indexAction($params);
        $url = $params[Routing::PARAMS_URL];
        if (isset($url[1])) {
            if (isset($params[Routing::PARAMS_POST]['content'])) {
                $params[Routing::PARAMS_POST]['url'] = $url[1];
                $this->commentAction($params[Routing::PARAMS_POST]);
            }
            if (isset($params[Routing::PARAMS_GET]['report'])) {
                $this->reportAction($params[Routing::PARAMS_GET]['report']);
            }
            $this->displayArticle($url[1]);
        } else if (isset($url[0])) {
            $this->displayArticles();
        } else {
            Helpers::error404();
        }
    }

    public function displayArticle($url)
    {
        $article = new Article();
        $article->populate(['url' => $url, 'publish' => 1]);
        if ($article->id() != null) {
            $article->content(unserialize($article->content()));
            $article->getCategory();
            $article->getComment();
            $article->getUser();
            $this->view->setView('article' . $article->template_id());
            $this->view->assign('article', $article);
        } else {
            Helpers::error404();
        }
    }

    public function displayArticles()
    {
        $article = new Article();
        $articles = $article->getAll(['publish' => 1], ['limit' => 9], ['updated_at' => 'DESC', 'created_at' => 'DESC']);
        if (!empty($articles)) {
            $this->view->setView('list_article');
            $this->view->assign('articles', $articles);
        }
    }

    public function commentAction($postData)
    {
        //$this->check((isset($postData['token'])) ? $postData['token'] : '');
        $comment = new Comment();
        $validator = new Validator($postData, 'Comment');
        $validator->validate($comment->validate());

        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        $comment->content($postData['content']);
        $comment->user = new User(['id' => $_SESSION['id']]);
        $article = new article();
        $article->populate(['url' => $postData['url']]);
        $comment->article = new Article(['id' => $article->id()]);

        $comment->save();
    }

    public function reportAction($id)
    {
        if (isset($_SESSION['id'])) {
            $comment_user = new Comment_User();
            if($comment_user->populate(['id_comment' => $id, 'id_user' => $_SESSION['id']]) == null) {
                $comment_user->id_user($_SESSION['id']);
                $comment_user->id_comment($id);
            }
            $comment_user->save();
            Session::addSuccess("Le commentaire a bien été reporté !");
        } else {
            Helpers::error404();
        }
    }
}
